<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;

class AdminInterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::with(['user', 'job'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        $stats = [
            'total' => Interview::count(),
            'upcoming' => Interview::where('status', 'upcoming')->count(),
            'completed' => Interview::where('status', 'completed')->count(),
            'cancelled' => Interview::where('status', 'cancelled')->count(),
            'today' => Interview::whereDate('date', today())->count(),
            'this_week' => Interview::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count()
        ];

        return view('admin.interviews.index', compact('interviews', 'stats'));
    }

    public function create()
    {
        return view('admin.interviews.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'job_title' => 'required|string|max:255',
                'company' => 'required|string|max:255',
                'company_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required|date_format:H:i',
                'meeting_link' => 'required|string|max:500',
                'status' => 'required|in:upcoming,completed,cancelled,pending',
                'notes' => 'nullable|string|max:1000',
                'application_method' => 'required|in:email,whatsapp,external_site,phone',
                'email' => 'nullable|email|required_if:application_method,email',
                'whatsapp_number' => 'nullable|string|required_if:application_method,whatsapp',
                'application_link' => 'nullable|url|required_if:application_method,external_site',
                'phone_number' => 'nullable|string|required_if:application_method,phone',
            ]);

            // Handle company image upload
            if ($request->hasFile('company_image')) {
                $image = $request->file('company_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/company-images'), $imageName);
                $validated['company_image'] = 'uploads/company-images/' . $imageName;
            }

            // Set user_id to 1 (admin user) since we're not assigning to specific users
            $validated['user_id'] = 1;

            // Save WhatsApp number if provided
            if ($request->filled('whatsapp_number')) {
                $validated['whatsapp_number'] = $request->whatsapp_number;
            }

            $interview = Interview::create($validated);

            // Send WhatsApp message if application method is WhatsApp
            if ($interview->application_method === 'whatsapp' && $interview->whatsapp_number) {
                $whatsappData = $this->sendWhatsAppMessage($interview);
                return redirect()->route('admin.interviews.index')
                    ->with('success', 'Interview scheduled successfully! WhatsApp message sent to ' . $interview->whatsapp_number)
                    ->with('whatsapp_url', $whatsappData['message_url'])
                    ->with('image_url', $whatsappData['image_url'])
                    ->with('image_path', $whatsappData['image_path']);
            }

            return redirect()->route('admin.interviews.index')
                ->with('success', 'Interview scheduled successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Interview creation failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to create interview: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Interview $interview)
    {
        $interview->load(['user', 'job']);
        return view('admin.interviews.show', compact('interview'));
    }

    public function edit(Interview $interview)
    {
        $interview->load(['user', 'job']);
        return view('admin.interviews.edit', compact('interview'));
    }

    public function update(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_id' => 'nullable|exists:job_postings,id',
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'type' => 'required|in:Video Call,Phone Call,In-Person',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:15|max:480',
            'meeting_link' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:upcoming,completed,cancelled,pending'
        ]);

        $interview->update($validated);

        return redirect()->route('admin.interviews.index')
            ->with('success', 'Interview updated successfully!');
    }

    public function destroy(Interview $interview)
    {
        $interview->delete();

        return redirect()->route('admin.interviews.index')
            ->with('success', 'Interview deleted successfully!');
    }

    /**
     * Send WhatsApp message for interview
     */
    private function sendWhatsAppMessage($interview)
    {
        // Format the WhatsApp message with proper styling
        $message = $this->formatInterviewMessage($interview);
        $whatsappNumber = $interview->whatsapp_number;
        
        // Remove any non-digit characters from phone number
        $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
        
        // Create WhatsApp URL with message
        $whatsappUrl = "https://wa.me/{$cleanNumber}?text=" . urlencode($message);
        
        // If there's an image, we'll create a separate WhatsApp URL for the image
        if ($interview->company_image) {
            $imageUrl = url($interview->company_image);
            // Log both URLs for debugging
            \Log::info('WhatsApp URL: ' . $whatsappUrl);
            \Log::info('Image URL: ' . $imageUrl);
            
            // For now, we'll return the message URL. In production, you might want to use WhatsApp API
            // to send the image as a file attachment along with the message
            return [
                'message_url' => $whatsappUrl,
                'image_url' => $imageUrl,
                'image_path' => public_path($interview->company_image)
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
     * Format interview message with proper styling
     */
    private function formatInterviewMessage($interview)
    {
        $message = "🎯 *NEW INTERVIEW OPPORTUNITY*\n\n";
        $message .= "📋 *Position:* {$interview->job_title}\n";
        $message .= "🏢 *Company:* {$interview->company}\n";
        $message .= "📅 *Date:* {$interview->date->format('D, M j, Y')}\n";
        $message .= "⏰ *Time:* {$interview->time->format('g:i A')}\n";
        $message .= "🔗 *Meeting Link:* {$interview->meeting_link}\n";
        $message .= "📊 *Status:* " . ucfirst($interview->status) . "\n";
        
        // Add company image if available
        if ($interview->company_image) {
            $imageUrl = url($interview->company_image);
            $message .= "🖼️ *Company Image:* {$imageUrl}\n";
        }
        
        // Add application link based on application method
        if ($interview->application_method === 'external_site' && !empty($interview->application_link)) {
            $message .= "� *Apply Here:* {$interview->application_link}\n";
        } elseif ($interview->application_method === 'email' && !empty($interview->email)) {
            $message .= "📧 *Apply via Email:* {$interview->email}\n";
        } elseif ($interview->application_method === 'phone' && !empty($interview->phone_number)) {
            $message .= "📞 *Apply via Phone:* {$interview->phone_number}\n";
        } elseif ($interview->application_method === 'whatsapp' && !empty($interview->whatsapp_number)) {
            $message .= "💬 *Apply via WhatsApp:* {$interview->whatsapp_number}\n";
        }
        
        if ($interview->notes) {
            $message .= "�� *Notes:* {$interview->notes}\n";
        }
        
        $message .= "\n💼 *How to Apply*\n";
        
        if ($interview->application_method === 'external_site' && !empty($interview->application_link)) {
            $message .= "Click the link above to apply directly on the company website!\n\n";
            $message .= "🌟 *Don't miss this opportunity!*";
        } elseif ($interview->application_method === 'email' && !empty($interview->email)) {
            $message .= "Send your resume and cover letter to the email above!\n\n";
            $message .= "🌟 *Don't miss this opportunity!*";
        } elseif ($interview->application_method === 'phone' && !empty($interview->phone_number)) {
            $message .= "Call the number above to apply!\n\n";
            $message .= "🌟 *Don't miss this opportunity!*";
        } elseif ($interview->application_method === 'whatsapp' && !empty($interview->whatsapp_number)) {
            $message .= "Reply to this message to apply for the interview!\n\n";
            $message .= "🌟 *Don't miss this opportunity!*";
        }
        
        return $message;
    }
}
