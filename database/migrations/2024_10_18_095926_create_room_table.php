<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('room_title'); // Column for room title
            $table->text('description'); // Column for room description
            $table->decimal('price', 8, 2); // Column for room price
            $table->string('amenities'); // Column for room amenities
            $table->string('room_type'); // Column for room type
            $table->string('image')->nullable(); // Column for image path (optional)
            $table->boolean('status')->default(false); // Approval status
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('room'); // Drop the rooms table if it exists
    }
}
