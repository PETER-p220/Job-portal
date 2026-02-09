<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->paginate(15);
        $activeJobs = Job::active()->count();
        $expiredJobs = Job::expired()->count();
        
        return view('admin.jobs.index', compact('jobs', 'activeJobs', 'expiredJobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'type' => 'required|string|in:Full-time,Part-time,Remote,Contract,Freelance',
            'experience_level' => 'nullable|string|in:Entry Level,Mid Level,Senior Level,Executive',
            'deadline' => 'required|date|after:today',
            'application_method' => 'required|in:email,whatsapp,external_site,phone',
            'email' => 'nullable|email|required_if:application_method,email',
            'whatsapp_number' => 'nullable|string|required_if:application_method,whatsapp',
            'application_link' => 'nullable|url|required_if:application_method,external_site',
            'phone_number' => 'nullable|string|required_if:application_method,phone',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_active'] = $request->has('is_active') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/jobs'), $imageName);
            $validated['image'] = $imageName;
        }

        Job::create($validated);

        // Send WhatsApp message if application method is WhatsApp
        if (isset($validated['application_method']) && $validated['application_method'] === 'whatsapp' && !empty($validated['whatsapp_number'])) {
            $whatsappData = $this->sendWhatsAppMessage($validated);
            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job created successfully! WhatsApp message sent to ' . $validated['whatsapp_number'])
                ->with('whatsapp_url', $whatsappData['message_url'])
                ->with('image_url', $whatsappData['image_url'])
                ->with('image_path', $whatsappData['image_path']);
        }

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Send WhatsApp message for job
     */
    private function sendWhatsAppMessage($jobData)
    {
        // Format the WhatsApp message with proper styling
        $message = $this->formatJobMessage($jobData);
        $whatsappNumber = $jobData['whatsapp_number'];
        
        // Remove any non-digit characters from phone number
        $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
        
        // Create WhatsApp URL with message
        $whatsappUrl = "https://wa.me/{$cleanNumber}?text=" . urlencode($message);
        
        // If there's an image, we'll create a separate WhatsApp URL for the image
        if (!empty($jobData['image'])) {
            $imageUrl = url('uploads/jobs/' . $jobData['image']);
            // Log both URLs for debugging
            \Log::info('WhatsApp URL: ' . $whatsappUrl);
            \Log::info('Image URL: ' . $imageUrl);
            
            // For now, we'll return the message URL. In production, you might want to use WhatsApp API
            // to send the image as a file attachment along with the message
            return [
                'message_url' => $whatsappUrl,
                'image_url' => $imageUrl,
                'image_path' => public_path('uploads/jobs/' . $jobData['image'])
            ];
        }
        
        // Log the WhatsApp URL for debugging
        \Log::info('WhatsApp URL: ' . $whatsappUrl);
        
        // For now, we'll just log it. In production, you might want to use WhatsApp API
        // You could also use cURL to automatically open this or use WhatsApp Business API
        return [
            'message_url' => $whatsappUrl,
            'image_url' => null,
            'image_path' => null
        ];
    }

    /**
     * Format job message with proper styling
     */
    private function formatJobMessage($jobData)
    {
        $message = "💼 *NEW JOB OPPORTUNITY*\n\n";
        $message .= "📋 *Position:* {$jobData['title']}\n";
        $message .= "🏢 *Company:* {$jobData['company']}\n";
        $message .= "📍 *Location:* {$jobData['location']}\n";
        $message .= "🏷️ *Type:* {$jobData['type']}\n";
        
        if (!empty($jobData['salary'])) {
            $message .= "💰 *Salary:* {$jobData['salary']}\n";
        }
        
        if (!empty($jobData['experience_level'])) {
            $message .= "📊 *Experience Level:* {$jobData['experience_level']}\n";
        }
        
        $message .= "📅 *Deadline:* {$jobData['deadline']}\n";
        
        // Add company image if available
        if (!empty($jobData['image'])) {
            $imageUrl = url('uploads/jobs/' . $jobData['image']);
            $message .= "🖼️ *Company Image:* {$imageUrl}\n";
        }
        
        // Add application link based on application method
        if ($jobData['application_method'] === 'external_site' && !empty($jobData['application_link'])) {
            $message .= "🔗 *Apply Here:* {$jobData['application_link']}\n";
        } elseif ($jobData['application_method'] === 'email' && !empty($jobData['email'])) {
            $message .= "📧 *Apply via Email:* {$jobData['email']}\n";
        } elseif ($jobData['application_method'] === 'phone' && !empty($jobData['phone_number'])) {
            $message .= "📞 *Apply via Phone:* {$jobData['phone_number']}\n";
        } elseif ($jobData['application_method'] === 'whatsapp' && !empty($jobData['whatsapp_number'])) {
            $message .= "💬 *Apply via WhatsApp:* {$jobData['whatsapp_number']}\n";
        }
        
        // Add a short description preview
        $description = strip_tags($jobData['description']);
        if (strlen($description) > 150) {
            $description = substr($description, 0, 150) . "...";
        }
        $message .= "📝 *Description:* {$description}\n";
        
        $message .= "\n💼 *How to Apply*\n";
        
        if ($jobData['application_method'] === 'external_site' && !empty($jobData['application_link'])) {
            $message .= "Click the link above to apply directly on the company website!\n\n";
            $message .= "🌟 *Apply now before deadline!*";
        } elseif ($jobData['application_method'] === 'email' && !empty($jobData['email'])) {
            $message .= "Send your resume and cover letter to the email above!\n\n";
            $message .= "🌟 *Apply now before deadline!*";
        } elseif ($jobData['application_method'] === 'phone' && !empty($jobData['phone_number'])) {
            $message .= "Call the number above to apply!\n\n";
            $message .= "🌟 *Apply now before deadline!*";
        } elseif ($jobData['application_method'] === 'whatsapp' && !empty($jobData['whatsapp_number'])) {
            $message .= "Reply to this message to apply for the job!\n\n";
            $message .= "🌟 *Apply now before deadline!*";
        }
        
        return $message;
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'type' => 'required|string|in:Full-time,Part-time,Remote,Contract,Freelance',
            'experience_level' => 'nullable|string|in:Entry Level,Mid Level,Senior Level,Executive',
            'deadline' => 'nullable|date|after:today',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? true : false;

        // If deadline is provided, update it
        if ($request->filled('deadline')) {
            $validated['deadline'] = $request->deadline;
        }

        $job->update($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Extend deadline for a job
     */
    public function extendDeadline(Request $request, Job $job)
    {
        $validated = $request->validate([
            'deadline' => 'required|date|after:today',
        ]);

        $job->update([
            'deadline' => $validated['deadline'],
            'is_active' => true, // Reactivate if expired
        ]);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job deadline extended successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
}
