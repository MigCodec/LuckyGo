@extends('includes.navbar')
@section('content')

<!--
This view displays a list of lotteries in a table format.-->
<h1>
    Listado de Sorteos
</h1>
<table>
    <tr>
        <th>
            Fecha del sorteo
        </th>
        <th>
            Cantidad de Billetes
        </th>
        <th>
            Subtotal de Billetes
        </th>
        <th>
            "Tendre Suerte"
        </th>
        <th>
            Total
        </th>
        <th>
            Estado
        </th>
        <th>
            Ingresado por
        </th>
    </tr>
    @foreach($lotteries as $lottery)
    <tr>
    <td>
        {{$lottery->date}}
    </td>
    <td>
        {{$lottery->count_total_tickets}}
    </td>
    <td>
        {{$lottery->sum_price_normal_tickets}}
    </td>
    <td>
        {{$lottery->sum_price_lucky_tickets}}
    </td>
    <td>
        {{$lottery->sum_total_tickets   }}
    </td>
    <td>
        @if($lottery->status==0)
        Abierto
        @endif
        @if($lottery->status==1)
        No Realizado
        <form method="GET" action="{{ route('lotteries.register',$lottery->id) }}">
            <button type="submit">Ingresar</button>
        </form>
        @endif
        @if($lottery->status==2)
        Realizado
        @endif
    </td>
    <td>
        {{$lottery->register_by}}
    </td>
    </tr>
    @endforeach
@endsection