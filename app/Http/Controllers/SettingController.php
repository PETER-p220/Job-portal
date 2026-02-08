<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Get current settings - in a real app, these would come from database or config
        $settings = [
            'site_name' => config('app.name', 'Job Board'),
            'site_email' => 'admin@OBY.com',
            'auto_approve_jobs' => false,
            'allow_remote_jobs' => true,
            'require_moderation' => false,
            'allow_registration' => true,
            'require_email_verification' => true,
            'default_user_role' => 'user'
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            'auto_approve_jobs' => 'boolean',
            'allow_remote_jobs' => 'boolean',
            'require_moderation' => 'boolean',
            'allow_registration' => 'boolean',
            'require_email_verification' => 'boolean',
            'default_user_role' => 'required|in:user,admin'
        ]);

        // In a real app, save to database or config files
        // Setting::updateOrCreate(['key' => 'site_name'], ['value' => $validated['site_name']]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}
