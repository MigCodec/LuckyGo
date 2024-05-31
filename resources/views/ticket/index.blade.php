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
                                <label style="display: inline-block; width: 50px; height: 50px; line-height: 50px; text-align: center; border-radius: 50%; background-color: #ffffff; border: 1px solid; cursor: pointer;" for="number_{{ $number }}">{{ $number }}</label>
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
            <p>Billete: $2.000</p>
            <input type="checkbox"  id="im_feeling_lucky" name="im_feeling_lucky" value="1">
            <label for="im_feeling_lucky">Categoría "Tendré Suerte" (+$1.000)</label>
        </div>
        <div style="background-color: #add8e5; border-radius: 8px; margin: 15px auto; display: inline-block; padding: 5px;">
            <p>
                Para participar en el sorteo de cada domingo, asegúrate de realizar la compra de tus<br>
                billetes antes de las 23:59 horas de ese mismo día. Todas las compras efectuadas<br>
                dentro de este plazo serán incluidas en el sorteo correspondiente.
            </p>
        </div>
        <div style="margin: 5px auto">
            <button type="submit" style="margin: 15px; background-color: #328000; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;">Jugar</button>
        </div>
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            @error('numbers')
            <div style="background-color: #f56558; border: 1px solid #f56558; color: white; padding: 5px; border-radius: 5px; max-width: 300px;">Debe seleccionar exactamente 5 números</div>
            @enderror
        </div>
    </form>
    
    @if(isset($success))
    <div style="display: block; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
        <span style="cursor: pointer; position: absolute; top: 10px; right: 15px;" onclick="this.parentElement.style.display = 'none';">x</span>
        <p>¡Compra realizada exitosamente!</p>
        <p>Tu número de billete es el <b>{{$ticket_code}}</b></p>
        <p>Fecha <b>{{$date}}</b></p>
        <b style="color: #46a952;">Juega con responsabilidad en LuckyGo</b>
    </div>
    @endif

</div>

<script>
    function limitCheckboxSelection() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checkedCount = 0;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked && !checkbox.getAttribute('id').includes('im_feeling_lucky')) {
                checkedCount++;
            }

            checkbox.addEventListener('change', function() {
                if (this.checked && !this.getAttribute('id').includes('im_feeling_lucky')) {
                    if (checkedCount >= 5) {
                        this.checked = false;
                    } else {
                        checkedCount++;
                    }
                } else if (!this.checked && !this.getAttribute('id').includes('im_feeling_lucky')) {
                    checkedCount--;
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', limitCheckboxSelection);
</script>

@endsection
