<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade', function (Blueprint $table) {
            $table->id();
            $table->string('trade_type', 10)->default('Sell'); // buy/sell
            $table->string('instrument_name', 25); // symbol:exchange
            $table->unsignedTinyInteger('lot'); // from config
            $table->time('signal_start_time'); // buy/sell created time only 
            $table->decimal('option_start_price'); // kite response data 23
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade');
    }
};
