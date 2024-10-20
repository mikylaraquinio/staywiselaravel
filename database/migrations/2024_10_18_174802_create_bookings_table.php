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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Foreign key referencing the 'id' in 'users' table
            $table->foreignId('room_id')->constrained('room');  // The user sending the booking request  
            $table->foreignId('owner_id')->constrained('users');
            $table->date('move_in_date'); 
            $table->date('move_out_date');
            $table->integer('number_of_occupants');
            $table->string('status')->default('pending');
            $table->string('duration');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
