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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('code')->unique(); 
            $table->boolean('im_feeling_lucky')->default(false);
            $table->integer('number_1');
            $table->integer('number_2'); 
            $table->integer('number_3'); 
            $table->integer('number_4'); 
            $table->integer('number_5');  
            $table->integer('price'); 
            $table->date('date');
            $table->unsignedBigInteger('lottery_id');
            $table->foreign('lottery_id')->references('id')->on('lotteries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
