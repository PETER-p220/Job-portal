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
        Schema::table('interviews', function (Blueprint $table) {
            // Only add columns if they don't already exist
            if (!Schema::hasColumn('interviews', 'type')) {
                $table->string('type')->nullable()->default(null);
            }
            if (!Schema::hasColumn('interviews', 'duration')) {
                $table->integer('duration')->nullable()->default(null);
            }
            if (!Schema::hasColumn('interviews', 'application_method')) {
                $table->string('application_method')->nullable()->default(null);
            }
            if (!Schema::hasColumn('interviews', 'application_link')) {
                $table->string('application_link')->nullable()->default(null);
            }
            if (!Schema::hasColumn('interviews', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->default(null);
            }
            if (!Schema::hasColumn('interviews', 'phone_number')) {
                $table->string('phone_number')->nullable()->default(null);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->string('type')->nullable()->change();
            $table->integer('duration')->nullable()->change();
            $table->string('application_method')->nullable()->change();
            $table->string('application_link')->nullable()->change();
            $table->string('whatsapp_number')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
        });
    }
};
