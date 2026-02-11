<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('job_postings', 'deadline')) {
                $table->date('deadline')->nullable()->after('description');
            }
            if (!Schema::hasColumn('job_postings', 'apply_url')) {
                $table->string('apply_url')->nullable()->after('deadline');
            }
            if (!Schema::hasColumn('job_postings', 'image')) {
                $table->string('image')->nullable()->after('apply_url');
            }
            if (!Schema::hasColumn('job_postings', 'email')) {
                $table->string('email')->nullable()->after('image');
            }
            if (!Schema::hasColumn('job_postings', 'application_method')) {
                $table->enum('application_method', ['email', 'whatsapp', 'external_site', 'phone'])->default('email')->after('description');
            }
            if (!Schema::hasColumn('job_postings', 'application_link')) {
                $table->string('application_link')->nullable()->after('application_method');
            }
            if (!Schema::hasColumn('job_postings', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('application_link');
            }
            if (!Schema::hasColumn('job_postings', 'phone_number')) {
                $table->string('phone_number')->nullable()->after('whatsapp_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $columns = ['deadline', 'apply_url', 'image', 'email', 'application_method', 'application_link', 'whatsapp_number', 'phone_number'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('job_postings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
