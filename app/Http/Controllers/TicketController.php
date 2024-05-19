<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
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
        $price = $request->im_felling_lucky ? 3000 : 2000;
        return view('ticket.confirmation', [
            'numbers' => json_encode($request->numbers),
            'im_felling_lucky'=>$request->im_felling_lucky,
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
        }
        $code_number = intval($code_number)+1;
        $code_number =  strval($code_number);
        for($i=0;$i<strlen($code_number);$i++)
        {
            if($code_number[$i]=="0"){
                $code_number[$i] = "1";
            }
        }
        $sorter = auth()->guard("sorter")->user();
        $ticket = $sorter->tickets()->create([
            'numbers' => json_decode($request->numbers),
            'im_feeling_lucky' => $request->im_feeling_lucky?true:false,
            'price' => $request->price,
            'code'=> $code_number,
        ]);
        return view('ticket.index')->with("success","ticket generado")->with("code",$code_number);
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
