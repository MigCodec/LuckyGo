@extends('includes.navbar')
@section('content')
<!--
This view displays a list of lotteries in a table format.-->
<title>Sorteos</title>
<div style="text-align: center;">
    <h1>Listado de Sorteos</h1>
    <div style="justify-content: center; align-items: center; display: flex;">
        @if(count($lotteries) > 0)
        <table>
            <tr>
                <th>Fecha del sorteo</th>
                <th>Cantidad de Billetes</th>
                <th>Subtotal de Billetes</th>
                <th>"Tendré Suerte"</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Ingresado por</th>
            </tr>
            @foreach($lotteries as $lottery)
            <tr>
                <td>{{ ucfirst(\Carbon\Carbon::parse($lottery->date)->translatedFormat('l d \d\e F')) }}</td>
                <td>${{ number_format($lottery->count_total_tickets, 0, ',', '.') }}</td>
                <td>${{ number_format($lottery->sum_price_normal_tickets, 0, ',', '.') }}</td>
                <td>${{ number_format($lottery->sum_price_lucky_tickets, 0, ',', '.') }}</td>
                <td>${{ number_format($lottery->sum_total_tickets, 0, ',', '.') }}</td>
                <td>
                    @if($lottery->status == 0)
                    Abierto
                    @elseif($lottery->status == 1)
                    <div style="display:flex; text-align:center; align-items:center;">
                        No realizado
                        <form class="tooltip" method="GET" action="{{ route('lotteries.register',$lottery->id) }}">
                            <button type="submit" style="margin: 15px; background-color: #59D45C; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;">Ingresar</button>
                            <span class="tooltip_text">Ingrese nuevo sorteo</span>
                        </form>
                    </div>
                    @elseif($lottery->status == 2)
                    Realizado
                    @endif
                </td>
                <td>
                    @if($lottery->sorter_name)
                    {{ $lottery->sorter_name . " " . $lottery->formated_date }}
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <p style="background-color: #f56558; color: #fff; border-radius: 0.375rem; font-size: 1rem; padding: 0.25rem; margin-top: 1rem; text-align: center; max-width: 100%; display: inline-block;">No hay registros de compra de billetes o sorteos realizados.</p>
        @endif
    </div>
</div>

<style>
        table {
            border-collapse: collapse; margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd; padding: 12px; text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        table{
            table-layout: auto;
        }
</style>
@endsection