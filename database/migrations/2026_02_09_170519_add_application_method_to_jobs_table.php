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
            $table->enum('application_method', ['email', 'whatsapp', 'external_site', 'phone'])->default('email')->after('description');
            $table->string('application_link')->nullable()->after('application_method');
            $table->string('whatsapp_number')->nullable()->after('application_link');
            $table->string('phone_number')->nullable()->after('whatsapp_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn(['application_method', 'application_link', 'whatsapp_number', 'phone_number']);
        });
    }
};
