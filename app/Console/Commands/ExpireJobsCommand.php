<?php

namespace App\Console\Commands;

use App\Models\Job;
use Illuminate\Console\Command;

class ExpireJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically deactivate expired job postings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredJobs = Job::expired()->where('is_active', true)->get();
        
        $count = 0;
        foreach ($expiredJobs as $job) {
            $job->update(['is_active' => false]);
            $count++;
        }
        
        $this->info("Successfully deactivated {$count} expired job postings.");
        
        return 0;
    }
}
