<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNumberColumnTypeInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('number')->change(); // Change 'number' to string
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('number')->change(); // Revert back if needed
        });
    }
}