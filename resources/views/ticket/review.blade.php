@extends('includes.navbar')

@section('title', 'Revisar Ticket')

@section('content')
<form method="POST" action="{{ route('tickets.show') }}">
    @csrf
    Numero de ticket:
    <input name="ticket_id"></input>
    <button type="submit">Buscar</button>
</form>
@endsection