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
        Schema::create('lotteries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->integer('status');
            $table->integer('winner_num_1');
            $table->integer('winner_num_2');
            $table->integer('winner_num_3');
            $table->integer('winner_num_4');
            $table->integer('winner_num_5');
            $table->integer('lucky_num_1');
            $table->integer('lucky_num_2');
            $table->integer('lucky_num_3');
            $table->integer('lucky_num_4');
            $table->integer('lucky_num_5');
            $table->unsignedBigInteger('sorter_id')->nullable(true);
            $table->foreign('sorter_id')->references('id')->on('sorters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotteries');
    }
};
