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
            $table->date('deadline')->nullable()->after('description');
            $table->string('apply_url')->nullable()->after('deadline');
            $table->string('image')->nullable()->after('apply_url');
            $table->string('email')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn(['deadline', 'apply_url', 'image', 'email']);
        });
    }
};
