<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->string('room_title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('amenities');
            $table->string('room_type');
            $table->string('image')->nullable();
            $table->boolean('approved')->default(false); // New approved column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('room'); // Drop the rooms table if it exists
    }
}
