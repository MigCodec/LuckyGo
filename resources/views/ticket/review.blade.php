@extends('includes.navbar')

@section('title', 'Revisar Ticket')
@php
    use Carbon\Carbon;
@endphp

@section('content')
<title>Ver Billetes</title>
<div style="width: 80%; margin: 0 auto; text-align: center;">
    <h1>Verificador de Billetes</h1>
    
    <form method="POST" action="{{ route('tickets.show') }}" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
        @csrf
        <label for="ticket_code" style="font-weight: bold;">Ingresa el código de tu billete:</label>
        <input type="text" id="ticket_code" name="ticket_code" required style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; width: 200px;">
        <button type="submit" style="padding: 5px 10px; background-color:#FFD700; border: 1px solid #FFD700; border-radius: 4px; cursor: pointer;font-weight: bold;">Verificar</button>
        </form>
        @if(session('lottery_error'))
        <p style="background-color: #f56558; color: #fff; border-radius: 0.375rem; font-size: 1rem; padding: 0.25rem; margin-top: 1rem; text-align: center; max-width: 100%; display: inline-block;">{{ session('lottery_error') }}</p>
        @endif
        @if(session('ticket_error'))
        <p style="background-color: #f56558; color: #fff; border-radius: 0.375rem; font-size: 1rem; padding: 0.25rem; margin-top: 1rem; text-align: center; max-width: 100%; display: inline-block;">{{ session('ticket_error') }}</p>
        @endif
   
    @if(isset($ticket))
        <div>
            <h2>Detalles de tu Billete</h2>
            <table style="margin: 0 auto; border-collapse: collapse; width: 100%;text-align: center;">
                <tr> 
                    <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Fecha del Billete</th>
                    <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Números Jugados</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 10px;text-align: center;"><b>{{Carbon::parse($ticket->created_at)->format('d/m/Y H:i:s')}}</b></td>
                    <td style="border: 1px solid #ccc; padding: 10px;">
                        <b>
                            <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $ticket->number_1 }}</span>
                            <span style="display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $ticket->number_2 }}</span>
                            <span style="display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $ticket->number_3 }}</span>
                            <span style="display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $ticket->number_4 }}</span>
                            <span style="display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $ticket->number_5 }}</span>
                        </b>
                    </td>
                </tr>
            </table>

            <h2>Detalles del Sorteo</h2>
            <table style="margin: 20px auto; border-collapse: collapse; width: 100%;text-align: center;">
                <tr>
                    <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Fecha del Sorteo</th>
                    <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Números Ganadores</th>
                    <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Números Ganadores "Tendré Suerte"</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #ccc; padding: 20px;text-align: center;"> 
                        <b>{{Carbon::parse($lottery->date)->format('d/m/Y H:i') }}</b></td>
                    <td style="border: 1px solid #ccc; padding: 20px;text-align: center;">
                       <b> 
                        <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->winner_num_1 }} </span>
                        <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;"> {{ $lottery->winner_num_2 }} </span>
                        <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->winner_num_3 }} </span>
                        <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->winner_num_4 }} </span>
                        <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->winner_num_5 }} </span> </b>
                    </td>
                    <td style="border: 1px solid #ccc; padding: 20px;text-align: center;">
                        @if($lottery->lucky_num_1!=0)
                        <b>
                         <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->lucky_num_1 }} </span>
                         <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->lucky_num_2 }} </span>
                         <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->lucky_num_3 }} </span>
                         <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->lucky_num_4 }} </span>
                         <span style= "display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;">{{ $lottery->lucky_num_5 }} </span>
                        </b>
                        @endif
                    </td>
                </tr>
            </table>
            @if($ticket->win || $ticket->win_im_feeling_lucky )
            <h3 style="text-align: center; color: #7D3C98; font-weight: bold;">¡Tienes Premio!</h3>
            <table style="margin: 0 auto; border-collapse: collapse; width: 100%;text-align: center;">
                        <tr>
                            <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Sorteo principal</th>
                            <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">"Tendré Suerte"</th>
                        </tr>
                        <tr>
                            @if($ticket->win)
                            <td style="border: 1px solid #ccc; padding: 10px;">${{number_format($jackpot,0,',','.')}}</td>
                            @else
                            <td style="border: 1px solid #ccc; padding: 10px;font-weight: bold;">Sin Premio</td>
                            @endif
                            @if( $ticket->win_im_feeling_lucky )
                                <td style="border: 1px solid #ccc; padding: 10px;text-align: center;">${{number_format($lucky_jackpot,0,',','.')}}</td>
                            @else
                                <td style="border: 1px solid #ccc; padding: 10px; font-weight: bold;text-align: center;">Sin Premio</td>
                            @endif
                        </tr>
            </table>
            @else
            <h3 style="text-align: center; color: #7D3C98; font-weight: bold;">Sin Premio</h3>
            @endif
        </div>
    @endif
    @if(session('error'))
        <div style="text-align: center; color: red; font-weight: bold; margin-top: 20px;">{{ session('error') }}</div>
    @endif
</div>
@endsection