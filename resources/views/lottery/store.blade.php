@extends('includes.navbar')

@section('title', 'Comprar Billete de Lotería')

@section('content')
<title>Registrar Sorteo</title>
<!--This view allows users to select their numbers to buy lottery tickets.-->
<div style="text-align: center;">
    <h1>Registrar Sorteo</h1>
    <div style="justify-content: center; align-items: center; display: flex;">
        <table class="lottery_table">
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
                    {{ ucfirst(\Carbon\Carbon::parse($lottery->date)->translatedFormat('l d \d\e F')) }}
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
                    ${{number_format($lottery->sum_total_tickets,0,',','.')}}
                </td>
            </tr>
        </table>
    </div>

    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <form method="POST" action="{{route('lotteries.store')}}" class="confirmedform" style="text-align: center;">
            @csrf
            <input name="lottery_id" type="hidden" value="{{$lottery->id}}"/>
            <!-- Select lucky numbers -->
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <div class="tooltip" style="width: 45%;">
                    <div class="form-group">
                        <label for="numbers"><b>Sorteo</b></label>
                        <table style="margin-top: 10px;">
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    @for ($j = 1; $j <= 6; $j++)
                                        @php
                                            $number = $i * 6 + $j;
                                        @endphp
                                        <td style="padding: 5px;">
                                            <input type="checkbox" id="number_{{ $number }}" name="normal_numbers[]" value="{{ $number }}" style="display: none">
                                            <label for="number_{{ $number }}" style="display: inline-block; width: 65px; height: 40px; line-height: 40px; text-align: center; background-color: #F2F2F2; cursor: pointer;">{{ $number }}</label>
                                            <style>
                                                #number_{{$number}}:checked + label {
                                                    background-color: #F4B700 !important;
                                                }
                                            </style>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </table>
                      <span class="tooltip_text">Seleccione números ganadores</span>  
                    </div>
                </div>
                @if($lottery->sum_price_lucky_tickets!=0)
                <div style="width: 1px; background-color: black; margin: 20px; margin-left: 40px; margin-top: 35px; margin-bottom: 5px;"></div>
                <div class="tooltip" style="width: 45%">
                    <div class="form-group">
                        <label for="lucky_numbers"><b>Tendré Suerte</b></label>
                        <table style="margin-top: 10px;">
                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    @for ($j = 1; $j <= 6; $j++)
                                        @php
                                            $number = $i * 6 + $j;
                                        @endphp
                                        <td style="padding: 5px;">
                                            <input type="checkbox" id="lucky_number_{{ $number }}" name="lucky_numbers[]" value="{{ $number }}" style="display: none">
                                            <label for="lucky_number_{{ $number }}" style="display: inline-block; width: 65px; height: 40px; line-height: 40px; text-align: center; background-color: #F2F2F2; cursor: pointer;">{{ $number }}</label>
                                            <style>
                                                #lucky_number_{{$number}}:checked + label {
                                                    background-color: #F4B700 !important;
                                                }
                                            </style>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </table> 
                    </div>
                    <span class="tooltip_text">Seleccione números con suerte ganadores</span> 
                </div>
                @endif
            </div>
            @if(session("normal_numbers_len"))
            <div style="background-color: #f56558; border: 10px solid #f56558; color: white; padding: 10px; border-radius: 5px; max-width: 300px; margin: 10px auto;">
                {{session("normal_numbers_len")}}
            </div>
            @endif
            <!-- Submit and cancel buttons -->
            <button class="tooltip" type="submit" style="margin: 15px; background-color: #317C00; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; text-decoration: none; cursor: pointer;">
                Confirmar
                <span class="tooltip_text">Confirme números seleccionados</span> 
            </button>
            <a class="tooltip" href="{{ route('lotteries.index') }}" style="margin: 15px; background-color: #EC2C00; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; text-decoration: none;">
                Cancelar
                <span class="tooltip_text">Cancelar y volver atrás</span> 
            </a>
            @error('numbers')
            {{$message}}
            @enderror
        </form>
    </div>
    <!-- Display error message if user doesn't select exactly 5 numbers -->
    @if ($errors->has('numbers_only_normal'))
        <div style="background-color: #f56558; border: 10px solid #f56558; color: white; padding: 10px; border-radius: 5px; max-width: 300px; margin: 10px auto;">
            Debe seleccionar exactamente 5 números
        </div>
    @endif
    @if ($errors->has('numbers_normal_lucky'))
        <div style="background-color: #f56558; border: 10px solid #f56558; color: white; padding: 10px; border-radius: 5px; max-width: 300px; margin: 10px auto;">
            Debe seleccionar exactamente 5 números para el sorteo normal y 5 en tendré suerte
        </div>
    @endif
    
</div>
<!-- JavaScript for checkbox functionality -->
<script>
    if(false){ //aqui tiene que ir la condicion para cuando no hay 'tendre suerte'
        document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checkedCount = 0;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked && !checkbox.getAttribute('id').includes('im_feeling_lucky')) {
                checkedCount++;
            }

            checkbox.addEventListener('change', function () {
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
    });
    }else{
        document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checkedCount = 0;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked && !checkbox.getAttribute('id').includes('im_feeling_lucky')) {
                checkedCount++;
            }

            checkbox.addEventListener('change', function () {
                if (this.checked && !this.getAttribute('id').includes('im_feeling_lucky')) {
                    if (checkedCount >= 10) {
                        this.checked = false;
                    } else {
                        checkedCount++;
                    }
                } else if (!this.checked && !this.getAttribute('id').includes('im_feeling_lucky')) {
                    checkedCount--;
                }
            });
        });
    });
    }
    
</script>

<style>
        .lottery_table {
            border-collapse: collapse; margin-top: 20px;
        }

        .lottery_table th, .lottery_table td {
            border: 1px solid #ddd; padding: 12px; text-align: left;
        }

        .lottery_table th {
            background-color: #f2f2f2;
        }

        .lottery_table tr:hover {
            background-color: #f5f5f5;
        }

        .lottery_table table{
            table-layout: auto;
        }
</style>
@endsection