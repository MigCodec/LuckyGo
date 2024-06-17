@extends('includes.navbar')

@section('title', 'Comprar Billete de Lotería')

@section('content')
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
            </tr>
        </table>
    </div>

    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <form method="POST" action="{{ route('lotteries.store') }}" style="text-align: center;">
            @csrf
            <input name="lottery_id" type="hidden" value="{{$lottery->id}}"/>
            <!-- Select lucky numbers -->
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <div style="width: 45%;">
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
                    </div>
                </div>

                <div style="width: 1px; background-color: black; margin: 20px; margin-left: 40px; margin-top: 35px; margin-bottom: 5px;"></div>
            
                <div style="width: 45%">
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
                </div>
            </div>
            <!-- Submit and cancel buttons -->
            <button type="submit" style="margin: 15px; background-color: #317C00; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; text-decoration: none; cursor: pointer;">Confirmar</button>
            <a href="{{ route('lotteries.index') }}" style="margin: 15px; background-color: #EC2C00; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; text-decoration: none;">Cancelar</a>
            @error('numbers')
            {{$message}}
            @enderror
        </form>
    </div>
</div>

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