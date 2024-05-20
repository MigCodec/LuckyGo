<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Lottery;
use App\Http\Requests\StoreLotteryRequest;
use App\Http\Requests\UpdateLotteryRequest;

class LotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dates = $this->getMondayAndSundayOfThisWeek();
        $lottery = Lottery::All();
        $test = Ticket::All()->where('');
        return view("lottery.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLotteryRequest $request)
    {
        //
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
    private function getMondayAndSundayOfThisWeek() {
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
