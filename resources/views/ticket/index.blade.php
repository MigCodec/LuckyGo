@extends('includes.navbar')

@section('title', 'Comprar Billete de Lotería')

@section('content')

<div style="text-align: center; font-family: Arial, sans-serif;">
    <h1>Compra de billetes de lotería</h1>
    <form method="POST" action="{{ route('tickets.pre_confirmation') }}">
        @csrf
        <div class="form-group">
            <label for="numbers">Seleccione 5 Números del 1 al 30:</label>
            <table style="margin: 15px auto;">
                @for ($i = 0; $i < 5; $i++)
                    <tr>
                        @for ($j = 1; $j <= 6; $j++)
                            @php
                                $number = $i * 6 + $j;
                            @endphp
                            <td style="padding: 5px;">
                                <input type="checkbox" id="number_{{ $number }}" name="numbers[]" value="{{ $number }}" style="display: none">
                                <label style="display: inline-block; width: 50px; height: 50 px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;" for="number_{{ $number }}">{{ $number }}</label>
                                <style>
                                    #number_{{$number}}:checked + label{
                                        background-color: #8fef90 !important;
                                    }
                                </style>
                            </td>
                        @endfor
                    </tr>
                @endfor
            </table>
        </div>
        <div>
            <p>Billete: $2000</p>
            <input type="checkbox"  id="im_feeling_lucky" name="im_feeling_lucky" value="1">
            <label for="im_feeling_lucky">Categoría "Tendré Suerte" (+$1.000)</label>
        </div>
        <button type="submit" style="margin: 15px; background-color: #328000; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;">Jugar</button>
        @error('numbers')
        {{$message}}
        @enderror
    </form>
    @if(isset($success))
    <div style="display: inline-block; margin: 0 auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);">
    <p>¡Compra realizada exitosamente!</p>
    <p>Tu número de billete es el <b>{{$ticket_code}}</b></p>
    <p>Fecha <b>{{$date}}</b></p>
    <b style="color: #46a952;">Juega con responsabilidad en LuckyGo</b>
    </div>
    @endif
</div>
@endsection