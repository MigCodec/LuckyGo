@extends('includes.navbar')

@section('title', 'Confirmación de Compra')

@section('content')
<div class="container">
    <h1>Has seleccionado los numeros:</h1>
    <p>{{ implode(', ', json_decode($numbers)) }}</p>
    <p>El valor totla de tu billete es ${{ number_format($price, 0, ',', '.') }}.</p>
    <p>Deseas continuar?</p>
    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf
        <input type="hidden" name="numbers" value="{{ json_encode($numbers) }}">
        <input type="hidden" name="im_felling_lucky" value="{{ $im_felling_lucky }}">
        <input type="hidden" name="price" value="{{ $price }}">
        <button type="submit" >Continuar</button>
        <a href="{{ route('tickets.index') }}">Cancelar</a>
    </form>
</div>
@endsection