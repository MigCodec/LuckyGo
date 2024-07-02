<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Lottery;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreLotteryRequest;
use App\Http\Requests\UpdateLotteryRequest;
use Illuminate\Support\Facades\Auth;
class LotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lotteries = Lottery::with("sorter")->get();
        foreach($lotteries as $lottery){
            if($lottery->sorter!=null){
                $lottery->sorter_name = $lottery->sorter->name;
            }
        }
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
        $validated = $request->validated(["lottery_id"=>"required","normal_numbers"=>"required","lucky_numbers"=>"required"]);
        $normal_numbers = $request->normal_numbers;
        $lucky_numbers = $request->lucky_numbers;
        $sorter = Auth::guard("sorter")->user();
        $lottery = Lottery::where("id",$request->lottery_id)->first();
        $lottery->winner_num_1=$normal_numbers[0];
        $lottery->winner_num_2=$normal_numbers[1];
        $lottery->winner_num_3=$normal_numbers[2];
        $lottery->winner_num_4=$normal_numbers[3];
        $lottery->winner_num_5=$normal_numbers[4];
        if(isset($lucky_numbers)){
            $lottery->lucky_num_1=$lucky_numbers[0];
            $lottery->lucky_num_2=$lucky_numbers[1];
            $lottery->lucky_num_3=$lucky_numbers[2];
            $lottery->lucky_num_4=$lucky_numbers[3];
            $lottery->lucky_num_5=$lucky_numbers[4];
        }
        $lottery->sorter_id=$sorter->id;
        $lottery->save();
        return redirect()->route('lotteries.index')->with('successfully', 'Sorteo Ingresado');
        
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
