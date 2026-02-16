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
        Schema::create('fishlogs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name'); // name
            $table->string('location'); //location
            $table->string('species');//species
            $table->string('method');//method
            $table->unsignedTinyInteger('rating');//rating
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fishlogs');
    }
};
