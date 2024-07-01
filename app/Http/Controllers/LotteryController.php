<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Lottery;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreLotteryRequest;
use App\Http\Requests\UpdateLotteryRequest;

class LotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$lotteries = Lottery::select(
            'lotteries.id',
            'lotteries.date',
            DB::raw('IFNULL(COUNT(tl.id),0)+IFNULL(COUNT(tn.id),0) AS tickets_count'),
            DB::raw('IFNULL(SUM(tn.price),0) AS sum_normal_ticket'),
            DB::raw('IFNULL(SUM(tl.price),0) AS sum_lucky_ticket'),
            DB::raw('IFNULL(SUM(tn.price),0) + IFNULL(SUM(tl.price),0) AS total'),
            DB::raw('IFNULL(a.id," ") AS register_by'),
            DB::raw('IF(NOW()<lotteries.date,0,IF(a.id IS NULL,1,0)) AS state'),
        )->leftjoin('tickets as tn', function ($join) {
            $join->on('lotteries.id', '=', 'tn.lottery_id')
                 ->where('tn.im_feeling_lucky', '=', 0);
        })->leftjoin('tickets as tl', function ($join) {
            $join->on('lotteries.id', '=', 'tl.lottery_id')
                 ->where('tl.im_feeling_lucky', '=', 1);
        })->leftjoin('administrators as a',function($join){
            $join->on('lotteries.admin_id','=','a.id');
        })->groupBy('lotteries.id','lotteries.date','lotteries.state','a.id')->get();
        */
        
        /*$lotteries = Lottery::withCount('tickets','normal_tickets','lucky_tickets')
        ->withSum('normal_tickets','price')
        ->withSum('lucky_tickets','price')
        ->withSum('tickets','price')->get();
        */
        $lotteries = Lottery::All();
        $lottery = Lottery::firstOrFail();
    
        return view("lottery.index",["lotteries"=> $lotteries]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function register(Lottery $lottery){
        return view('lottery.store',['lottery'=> $lottery]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLotteryRequest $request)
    {
        dd($request);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Lottery $lottery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lottery $lottery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLotteryRequest $request, Lottery $lottery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lottery $lottery)
    {
        //
    }

     /**
     * Get the dates for the Monday and Sunday of the current week.
     * 
     * @return array An associative array with the keys 'monday' and 'sunday', containing the dates for Monday and Sunday of this week in 'Y-m-d' format.
     */
    public static function getMondayAndSundayOfThisWeek() {
        // Set the timezone to avoid discrepancies
        date_default_timezone_set('America/New_York');
    
        // Get the day of the week (0 for Sunday, 1 for Monday, etc.)
        $dayOfWeek = date('w');
    
        // Calculate the date for Monday of this week
        $monday = date('Y-m-d', strtotime('-' . $dayOfWeek . ' days'));
    
        // Calculate the date for Sunday of this week
        $sunday = date('Y-m-d', strtotime('+' . (6 - $dayOfWeek) . ' days'));
    
        return ['monday' => $monday, 'sunday' => $sunday];
    }
    
}
