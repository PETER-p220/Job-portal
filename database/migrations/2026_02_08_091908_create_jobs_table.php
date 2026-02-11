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
        // Only create table if it doesn't exist
        if (!Schema::hasTable('job_postings')) {
            Schema::create('job_postings', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('company');
                $table->string('location')->nullable();
                $table->text('description');
                $table->string('salary')->nullable();
                $table->string('type')->default('Full-time'); // Full-time, Part-time, Remote, Contract...
                $table->string('experience_level')->nullable(); // Entry, Mid, Senior...
                $table->string('apply_url')->nullable();
                $table->string('email')->nullable();
                $table->boolean('is_active')->default(true);
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
