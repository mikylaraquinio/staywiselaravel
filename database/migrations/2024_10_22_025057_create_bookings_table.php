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
            $table->foreign('renter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('room')->onDelete('cascade');
            $table->string('name');
            $table->date('move_in_date'); 
            $table->date('move_out_date');
            $table->integer('number_of_occupants');
            $table->boolean('approved')->default(0);
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
