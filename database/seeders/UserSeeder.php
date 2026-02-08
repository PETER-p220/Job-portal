<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Job;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create test job postings
        Job::create([
            'title' => 'Senior Laravel Developer',
            'company' => 'Tech Corp',
            'location' => 'New York, NY',
            'description' => 'We are looking for an experienced Laravel developer to join our team.',
            'salary' => '$80,000 - $120,000',
            'type' => 'Full-time',
            'experience_level' => 'Senior Level',
            'apply_url' => 'https://example.com/apply',
            'email' => 'careers@techcorp.com',
            'user_id' => $regularUser->id,
            'is_active' => true,
        ]);

        Job::create([
            'title' => 'Frontend Developer',
            'company' => 'Design Studio',
            'location' => 'Remote',
            'description' => 'Join our creative team as a frontend developer.',
            'salary' => '$60,000 - $90,000',
            'type' => 'Remote',
            'experience_level' => 'Mid Level',
            'apply_url' => 'https://designstudio.com/jobs',
            'email' => 'jobs@designstudio.com',
            'user_id' => $regularUser->id,
            'is_active' => true,
        ]);
    }
}
