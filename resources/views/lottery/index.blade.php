@extends('includes.navbar')
@section('content')

<!--
This view displays a list of lotteries in a table format.-->
<title>Sorteos</title>
<div style="text-align: center;">
    <h1>Listado de Sorteos</h1>
    <div style="justify-content: center; align-items: center; display: flex;">
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
                    "Tendré Suerte"
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
                {{number_format($lottery->count_total_tickets,0,',','.')}}
            </td>
            <td>
                ${{ number_format($lottery->sum_price_normal_tickets,0,',','.')}}
            </td>
            <td>
                ${{number_format($lottery->sum_price_lucky_tickets,0,',','.')}}
            </td>
            <td>
                ${{number_format($lottery->sum_total_tickets,0,',','.')   }}
            </td>
            <td>
                @if($lottery->status==0)
                Abierto
                @endif
                @if($lottery->status==1)
                <div style="display:flex; text-align:center; align-items:center;">
                    No realizado
                    <form class="tooltip" method="GET" action="{{ route('lotteries.register',$lottery->id) }}">
                        <button type="submit" style="margin: 15px; background-color: #59D45C; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;">Ingresar</button>
                        <span class="tooltip_text">Ingrese nuevo sorteo</span>
                    </form>
                </div>
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
        </table>
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