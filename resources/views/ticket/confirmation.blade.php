@extends('includes.navbar')

@section('title', 'Confirmación de Compra')

@section('content')
<!--This view displays a confirmation page for the purchase of lottery tickets.-->
<div style="text-align: center; font-family: Arial, sans-serif; ">
    <div style="display: inline-block; margin: 0 auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);">
        <p>Has seleccionado los números:</p>
        <p>{{ implode(' - ', json_decode($numbers)) }}</p>
        <p>El valor total de tu billete es ${{ number_format($price, 0, ',', '.') }}.</p>
        <b>¿Deseas continuar?</b>
         <!-- Form for confirming the purchase -->
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <input type="hidden" name="numbers" value="{{ json_encode($numbers) }}">
            <input type="hidden" name="im_feeling_lucky" value="{{ $im_feeling_lucky }}">
            <input type="hidden" name="price" value="{{ $price }}">
             <!-- Button to continue with the purchase -->
            <button style="margin: 15px; background-color: #328000; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;" type="submit" >Continuar</button>
            <a href="{{ route('ticket.index') }}" style="margin: 15px; background-color: #EC2C00; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; text-decoration: none;">Cancelar</a>
        </form>
    </div>
</div>
@endsection