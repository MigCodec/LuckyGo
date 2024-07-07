<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Lottery;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreLotteryRequest;
use App\Http\Requests\UpdateLotteryRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class LotteryController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lotteries = Lottery::with("sorter")->get();
        foreach($lotteries as $lottery){
            $date_carbon = Carbon::parse($lottery->date);
            $lottery->date_created = $date_carbon->format('d/m/Y');
            if($lottery->sorter!=null){
                $lottery->sorter_name = $lottery->sorter->name;
                Carbon::setLocale('es');
                $fechaCarbon = Carbon::parse($lottery->updated_at);
                $formateada = $fechaCarbon->format('d/m/Y H:i');
                $lottery->formated_date = $formateada;

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
        if(isset($normal_numbers)){
            if(count($normal_numbers)==5){
                $lottery->winner_num_1=$normal_numbers[0];
                $lottery->winner_num_2=$normal_numbers[1];
                $lottery->winner_num_3=$normal_numbers[2];
                $lottery->winner_num_4=$normal_numbers[3];
                $lottery->winner_num_5=$normal_numbers[4];
            }else{
                return back()->with('normal_numbers_len', 'Ingrese solo 5 números');
            }
        }else{
            return back()->with('normal_numbers_len', 'Debe ingresar los números del pozo normal');
        }
        if($lottery->sum_price_lucky_tickets!=0){
            if(isset($lucky_numbers)){
                if(count($lucky_numbers)==5){
                    $lottery->lucky_num_1=$lucky_numbers[0];
                    $lottery->lucky_num_2=$lucky_numbers[1];
                    $lottery->lucky_num_3=$lucky_numbers[2];
                    $lottery->lucky_num_4=$lucky_numbers[3];
                    $lottery->lucky_num_5=$lucky_numbers[4];
                }else{
                    return back()->with('normal_numbers_len', 'Ingrese solo 5 números');
                }
            }else{
                return back()->with('normal_numbers_len', 'Debe ingresar los números del pozo tendré suerte');
            } 
        }
        $lottery->sorter_id=$sorter->id;
        $lottery->save();
        return redirect()->route("lotteries.index")->with('successfully', 'Sorteo Ingresado');
        
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
            // Obtén la fecha actual
        $today = Carbon::now();
        $monday = $today->startOfWeek(Carbon::MONDAY)->toDateString();
        $sunday = $today->endOfWeek(Carbon::SUNDAY)->toDateString();
        return ['monday' => $monday, 'sunday' => $sunday];  
    }
    
}
