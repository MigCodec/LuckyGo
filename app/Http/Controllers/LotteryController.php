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
        date_default_timezone_set('America/Santiago');
    
        // Get the day of the week (0 for Sunday, 1 for Monday, etc.)
        $dayOfWeek = date('w');
    
        // Calculate the date for Monday of this week
        $monday = date('Y-m-d', strtotime('-' . $dayOfWeek . ' days'));
    
        // Calculate the date for Sunday of this week
        $sunday = date('Y-m-d', strtotime('+' . (6 - $dayOfWeek) . ' days'));
    
        return ['monday' => $monday, 'sunday' => $sunday];
    }
    
}
