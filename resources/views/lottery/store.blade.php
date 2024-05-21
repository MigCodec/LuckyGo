@extends('includes.navbar')

@section('title', 'Comprar Billete de Lotería')

@section('content')
<div class="container">
    <h1>Selecciona tus Números</h1>
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
        </tr>
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
        </table>
    <form method="POST" action="{{ route('lotteries.store') }}">
        @csrf
        <input name="lottery_id" type="hidden" value="{{$lottery->id}}"/>
        <div class="form-group">
            <label for="numbers">Sorteo</label>
            <table>
                @for ($i = 0; $i < 5; $i++)
                    <tr>
                        @for ($j = 1; $j <= 6; $j++)
                            @php
                                $number = $i * 6 + $j;
                            @endphp
                            <td>
                                <input type="checkbox" id="number_{{ $number }}" name="normal_numbers[]" value="{{ $number }}">
                                <label for="number_{{ $number }}">{{ $number }}</label>
                            </td>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
        <div class="form-group">
            <label for="numbers">Tendre Suerte</label>
            <table>
                @for ($i = 0; $i < 5; $i++)
                    <tr>
                        @for ($j = 1; $j <= 6; $j++)
                            @php
                                $number = $i * 6 + $j;
                            @endphp
                            <td>
                                <input type="checkbox" id="number_{{ $number }}" name="lucky_numbers[]" value="{{ $number }}">
                                <label for="number_{{ $number }}">{{ $number }}</label>
                            </td>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
        <button type="submit">Confirmar</button>
        <a href="{{ route('lotteries.index') }}" style="margin: 15px; background-color: #EC2C00; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; text-decoration: none;">Cancelar</a>
        @error('numbers')
        {{$message}}
        @enderror
    </form>
</div>
@endsection