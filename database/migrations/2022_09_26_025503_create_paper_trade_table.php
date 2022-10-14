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
        Schema::create('paper_trade', function (Blueprint $table) {
            $table->id();
            $table->string('signal_type', 10); // buy or sell
            $table->unsignedTinyInteger('chart_time_frame'); // 3M or 1M or 15M
            $table->string('instrument_name', 25); // exchange
            $table->decimal('current_price', 8, 2); // request->amount(price)
            $table->date('expiry_date'); //  thursday date
            $table->string('option_selected', 50); // symbol:exchange
            $table->unsignedTinyInteger('lot'); // from config
            $table->unsignedInteger('lot_size'); // quantity -- from matertable nifty(50) and bank nifty(25) -- Master Table
            $table->time('signal_start_time'); // buy/sell created time only 
            $table->decimal('option_start_price'); // kite response data 23
            $table->time('signal_end_time')->nullable(); // order closing request time
            $table->decimal('option_end_price')->nullable(); // update when receive sell req
            $table->decimal('diff_in_price', 8, 2)->nullable(); // option_start_price - option_end_price
            $table->decimal('brokage_cost', 8, 2)->nullable(); // refer API to calculate brokage
            $table->decimal('profit_or_loss_amount', 8, 2)->nullable(); // lot * lot_size * diff_in_price
            $table->decimal('profit_or_loss_after_brokage', 8, 2)->nullable(); // profit_or_loss_amount - brokage_cost
            $table->boolean('profit_or_loss')->nullable(); // based on profit_or_loss_after_brokage { -ve Loss false/ +ve Profit true}
            $table->string('adjustment', 25)->default('3M');
            $table->boolean('status')->default(true); //
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
        Schema::dropIfExists('paper_trade');
    }
};
