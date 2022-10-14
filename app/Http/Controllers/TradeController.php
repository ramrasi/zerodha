<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Exchange;
use App\Models\PaperTrade;
use Illuminate\Http\Request;
use KiteConnect\KiteConnect;

class TradeController extends Controller
{
    private static $BUY = 'BUY';
    private  static $SELL = 'SELL';
    protected $kite = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->kite = new KiteConnect(env('API_KEY'));
        $this->kite->setAccessToken(env('ACCESS_TOKEN'));
        // return $this->kite->getLoginURL();
        // $user = $this->kite->generateSession(env('REQUEST_TOKEN'), env('API_SECRET'));
        // return $user->access_token;
    }

    public function buyThreeM(Request $request) {

        $price = 17933 ; //$request->price;
        $roundoff = 50;
        $threashold = 100;

        $today = Carbon::today();
        $last_thursday = new Carbon('last thursday of this month');
        $this_thursday = new Carbon('this thursday');
        $startofcurrentweek = $last_thursday->copy()->startOfWeek();
        $endofcurrentweek = $last_thursday->copy()->endOfWeek();
        
        if(($price % $roundoff) >= ($roundoff/2))
            $price =  $price + ($roundoff -  $price % $roundoff) + $threashold;
        else 
            $price =  ($price -  $price % $roundoff) + $threashold;

        $exchange = 'NIFTY'.strtoupper($today->format('y').$today->format('M')[0].$last_thursday->format('d')).$price.'PE';
        if( $startofcurrentweek <= $today && $today <= $endofcurrentweek) {
            $exchange = 'NIFTY'.strtoupper($today->format('yM')).$price.'PE';
        }

        try {
            // return $exchange;
            return $trade = $this->kite->getQuote(['NFO:'.$exchange]);
            $paperTrade = PaperTrade::create([
                'signal_type'       => self::$BUY,
                'chart_time_frame'  => 3, 
                'instrument_name'   => $exchange, 
                'current_price'     => $price, 
                'expiry_date'       => $this_thursday->format('Y-m-d'), 
                'option_selected'   => 'NFO'.$exchange, 
                'lot'               => '', 
                'lot_size'          => Exchange::where('exchange', 'NIFTY')->first()->quantity??0,
                'signal_start_time' => carbon::now()->format('H:i:s'), 
                'option_start_price'=> $trade['NFO:'.$exchange]['last_price'], 
            ]);
        }
        catch(Throwable $e)
        {
            return $e->getMessage();
        }

    }

    public function sellThreeM(Request $request) {

    }
}
