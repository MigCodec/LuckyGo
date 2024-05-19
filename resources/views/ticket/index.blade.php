@extends('includes.navbar')

@section('title', 'Comprar Billete de Lotería')

@section('content')
<div class="container">
    <h1>Selecciona tus Números</h1>
    <form method="POST" action="{{ route('tickets.pre_confirmation') }}">
        @csrf
        <div class="form-group">
            <label for="numbers">Selecciona 5 Números</label>
            <table>
                @for ($i = 0; $i < 5; $i++)
                    <tr>
                        @for ($j = 1; $j <= 6; $j++)
                            @php
                                $number = $i * 6 + $j;
                            @endphp
                            <td>
                                <input type="checkbox" id="number_{{ $number }}" name="numbers[]" value="{{ $number }}">
                                <label for="number_{{ $number }}">{{ $number }}</label>
                            </td>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
        <div>
            <input type="checkbox"  id="im_feeling_lucky" name="im_feeling_lucky" value="1">
            <label for="im_feeling_lucky">Tendré Suerte</label>
        </div>
        <button type="submit">Calcular Total</button>
        @error('numbers')
        {{$message}}
        @enderror
    </form>
</div>
@endsection