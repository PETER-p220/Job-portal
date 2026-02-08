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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('job_title');
            $table->string('company');
            $table->enum('type', ['Video Call', 'Phone Call', 'In-Person']);
            $table->date('date');
            $table->time('time');
            $table->integer('duration'); // in minutes
            $table->string('meeting_link');
            $table->enum('status', ['upcoming', 'completed', 'cancelled', 'pending'])->default('upcoming');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
