@extends('includes.navbar')

@section('title', 'Comprar Billete de Lotería')

@section('content')
<div class="container">
    <h1>Selecciona tus Números</h1>
    <form method="POST" action="{{ route('tickets.pre_confirmation') }}">
        @csrf
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
        <button type="submit">Calcular Total</button>
        @error('numbers')
        {{$message}}
        @enderror
    </form>
</div>
@endsection