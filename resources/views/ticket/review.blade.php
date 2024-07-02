@extends('includes.navbar')

@section('title', 'Revisar Ticket')



@section('content')
<title>Ver Billetes</title>
<div style="width: 80%; margin: 0 auto; text-align: center;">
    <h1>Verificador de Billetes</h1>
    
    <form method="POST" action="{{ route('tickets.show') }}" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
        @csrf
        <label for="ticket_code" style="font-weight: bold;">Ingresa el código de tu billete:</label>
        <input type="text" id="ticket_code" name="ticket_code" required style="padding: 5px; border: 1px solid #ccc; border-radius: 4px; width: 200px;">
        <button type="submit" style="padding: 5px 10px; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">Verificar</button>
    </form>

    @if(session('error'))
        <div style="text-align: center; color: red; font-weight: bold; margin-top: 20px;">{{ session('error') }}</div>
    @endif
    @if(isset($ticket))
    <div>
        <h2>Detalles de tu Billete</h2>
        <table style="margin: 0 auto; border-collapse: collapse; width: 80%;">
            <tr> 
                <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Fecha del Billete</th>
                <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Números Jugados</th>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $ticket->date }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    {{ $ticket->number_1 }},
                    {{ $ticket->number_2 }},
                    {{ $ticket->number_3 }},
                    {{ $ticket->number_4 }},
                    {{ $ticket->number_5 }}
                </td>
            </tr>
        </table>

        <h2>Detalles del Sorteo</h2>
        <table style="margin: 20px auto; border-collapse: collapse; width: 80%;">
            <tr>
                <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Fecha del Sorteo</th>
                <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Números Ganadores</th>
                <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Números Ganadores "Tendré Suerte"</th>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 10px;">{{ $ticket->lottery->date }}</td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    {{ $ticket->lottery->winner_num_1 }},
                    {{ $ticket->lottery->winner_num_2 }},
                    {{ $ticket->lottery->winner_num_3 }},
                    {{ $ticket->lottery->winner_num_4 }},
                    {{ $ticket->lottery->winner_num_5 }}
                </td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    {{ $ticket->lottery->lucky_num_1 }},
                    {{ $ticket->lottery->lucky_num_2 }},
                    {{ $ticket->lottery->lucky_num_3 }},
                    {{ $ticket->lottery->lucky_num_4 }},
                    {{ $ticket->lottery->lucky_num_5 }}
                </td>
            </tr>
        </table>

        @if($ticket->gano)
            <div style="text-align: center; margin-top: 20px;">
                <h3 style="color: green;">¡Tienes premio!</h3>
                <table style="margin: 0 auto; border-collapse: collapse; width: 80%;">
                    <tr>
                        <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">Sorteo principal</th>
                        <th style="border: 1px solid #ccc; padding: 10px; background-color: #f0f0f0;">"Tendré Suerte"</th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc; padding: 10px;">400.000</td>
                        @if($ticket->ticket_gano_tendre_suerte)
                            <td style="border: 1px solid #ccc; padding: 10px;">400.000</td>
                        @else
                            <td style="border: 1px solid #ccc; padding: 10px; color: purple; font-weight: bold;">Sin premio</td>
                        @endif
                    </tr>
                </table>
            </div>
        @else
            <h3 style="text-align: center; color: purple; font-weight: bold;">Sin Premio</h3>
        @endif
    </div>
    @endif
</div>
@endsection