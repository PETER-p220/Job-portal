<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // This migration will output the current table structure
        $columns = DB::select("DESCRIBE job_postings");
        
        echo "Current job_postings table columns:\n";
        foreach ($columns as $column) {
            echo "- {$column->Field} ({$column->Type})\n";
        }
        
        // Check for specific columns
        $requiredColumns = ['deadline', 'apply_url', 'image', 'email', 'application_method', 'application_link', 'whatsapp_number', 'phone_number'];
        
        echo "\nMissing columns:\n";
        foreach ($requiredColumns as $column) {
            if (!Schema::hasColumn('job_postings', $column)) {
                echo "- {$column} (MISSING)\n";
            } else {
                echo "- {$column} (EXISTS)\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No changes to reverse
    }
};
