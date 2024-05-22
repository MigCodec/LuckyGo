<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function pre_confirmation(StoreTicketRequest $request){
        
        $price = $request->im_feeling_lucky ? 3000 : 2000;
        return view('ticket.confirmation', [
            'numbers' => json_encode($request->numbers),
            'im_feeling_lucky'=>$request->im_feeling_lucky?true:false,
            'price'=> $price,
            'date' => Carbon::now()->format('d-m-Y H:i:s'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $code_number = Ticket::max('code');
        if($code_number == null){
            $code_number = "000";
        }else{
            $code_number = intval($code_number)+1;
        }
        $code_number =  strval($code_number);
        for($i=0;$i<strlen($code_number);$i++)
        {
            if($code_number[$i]=="0"){
                $code_number[$i] = "1";
            }
        }
        $now = now();
        $sorter = auth()->guard("sorter")->user();
        $restrict_dates = LotteryController::getMondayAndSundayOfThisWeek();
        $lottery = Lottery::where('date',$restrict_dates['sunday'])->first();
        if($lottery==null){
            $lottery = Lottery::firstOrCreate([
                'date'=>$restrict_dates['sunday'],
                'state'=>0,
            ]);
        }
        $ticket = $lottery->tickets()->create([
            'numbers' => json_decode($request->numbers),
            'im_feeling_lucky' => $request->im_feeling_lucky?true:false,
            'price' => $request->price,
            'code'=> $code_number,
            'date'=>$now,'lottery_id'=>$lottery->id,
        ]);

        return view('ticket.index')->with("success","ticket generado")->with("ticket_code","LG".$code_number)->with("date", $now->format("d/m/Y H:i:s"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
