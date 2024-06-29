@extends('includes.navbar')

@section('title', 'Revisar Ticket')

@section('content')
<form method="POST" action="{{ route('tickets.show') }}">
    @csrf
    Numero de ticket:
    <input name="ticket_id"></input>
    <button type="submit">Buscar</button>
</form>
@if(isset($ticket))
{{$ticket->id}}
@endif

@extends('includes.navbar')

@section('title', 'Revisar Ticket')

@section('content')
<form method="POST" action="{{ route('tickets.show') }}">
    @csrf
    <h1>Verificador de Billetes</h1>
    <label for= "ticket_id">Ingresa el código de tu billete:</label>
    <input type="text" id="ticket_id" name="ticket_id" required>
    <button type="submit">Verificar</button>
</form>

<!--poner if-->
<div>
    <h2>Detalles de tu Billete</h2>
    <table border ="1">
        <tr> 
            <th>Fecha del billete</th>
            <th>Números Jugados</th>
        </tr>
        
        <tr>
            <td>
               {{ticket->date}}
         
            </td>
            <td>
                {{ticket->number_1}}
                {{ticket->number_2}}
                {{ticket->number_3}}
                {{ticket->number_4}}
                {{ticket->number_5}}

            </td>
        </tr>

    </table>
   
    <h2>Detalles del sorteo</h2>
    
    <table border ="1">
        <tr>
            <th>Fecha del Sorteo </th>
            <th>Números Ganadores </th>
            <th>Números Ganadores "Tendré suerte" </th>

        </tr>
        <tr>
            <td>
                {{ticket->lottery->date}}
            </td>    
            <td>
                {{ticket->lottery->winner_num_1}}
                {{ticket->lottery->winner_num_2}}
                {{ticket->lottery->winner_num_3}}
                {{ticket->lottery->winner_num_4}}
                {{ticket->lottery->winner_num_5}}

            </td>  
            <td> 
                {{ticket->lottery->lucky_num_1}}
                {{ticket->lottery->lucky_num_2}}
                {{ticket->lottery->lucky_num_3}}
                {{ticket->lottery->lucky_num_4}}
                {{ticket->lottery->lucky_num_5}}

            </td>
        </tr>
    </table>

    @if($ticket->gano())
        <h3>¡Tienes premio!</h3>
        <div class="mensaje-premio">
            <table>
                <tr>
                    <th>
                        Sorteo principal
                    </th>
                    <th>
                        "Tendré Suerte"
                    </th>
                </tr>    
                <tr>
                    <td>
                        <p> 400.000 </p>
                    </td>

                    @if(ticket_gano_tendre_suerte())
                    <td>
                         <p> 400.000 </p>
                    </td>
                    @else     
                    <td>
                        <h3>Sin premio</h3>
                    </td>
                    @endif
                </tr>    
                
            </table>    
        </div>    

    @else     
        <h3> Sin Premio</h3>
    @endif
</div>            

<!--@if(isset($ticket))-->
@endif

@endsection
