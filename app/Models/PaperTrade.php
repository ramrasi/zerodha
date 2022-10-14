<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperTrade extends Model
{
    protected $table = 'paper_trade'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'signal_type', 'chart_time_frame', 'instrument_name', 'current_price', 'expiry_date', 'option_selected', 
        'lot', 'lot_size', 'signal_start_time', 'option_start_price', 'signal_end_time', 'option_end_price', 
        'diff_in_price', 'brokage_cost', 'profit_or_loss_amount', 'profit_or_loss', 'profit_or_loss_after_brokage', 
        'adjustment', 'status'
    ];
}
