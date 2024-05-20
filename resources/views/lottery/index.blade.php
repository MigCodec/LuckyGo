@extends('includes.navbar')
@section('content')
<style>
    table {
    width: 100%;
    border-collapse: collapse;
}

/* Estilo para las celdas de la tabla */
th, td {
    padding: 8px;
    border: 1px solid #dddddd;
    text-align: left;
}

/* Estilo para las filas pares */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Estilo para el encabezado de la tabla */
th {
    background-color: #dddddd;
    font-weight: bold;
}
</style>
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
        {{$lottery->tickets_count}}
    </td>
    <td>
        {{$lottery->sum_normal_ticket}}
    </td>
    <td>
        {{$lottery->sum_lucky_ticket}}
    </td>
    <td>
        {{$lottery->total}}
    </td>
    <td>
        @if($lottery->state==0)
        Abierto
        @endif
        @if($lottery->state==1)
        No Realizado
        @endif
        @if($lottery->state==2)
        Realizado
        @endif
    </td>
    <td>
        {{$lottery->register_by}}
    </td>
    </tr>
    @endforeach
@endsection