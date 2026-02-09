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
            $table->string('type')->nullable()->default(null);
            $table->integer('duration')->nullable()->default(null);
            $table->string('application_method')->nullable()->default(null);
            $table->string('application_link')->nullable()->default(null);
            $table->string('whatsapp_number')->nullable()->default(null);
            $table->string('phone_number')->nullable()->default(null);
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
