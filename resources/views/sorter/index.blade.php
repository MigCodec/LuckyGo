@extends('includes.navbar')
@section('content')

  <h1>Lista De Sorteadores</h1>
      
    <form action="{{route('sorters.search')}}" method="GET"><br>
        @csrf          
        <input id="search" name="q" type="text" placeholder="Escriba aquí">
        <input id="submit" type="submit" value="Buscar">
    </form>
   <!-- @if (isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div> 
    @else-->
   
        <table>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Nombre del sorteador
                    </th>
                    <th>
                        Correo electrónico
                    </th>
                    <th>
                        Edad
                    </th>
                    <th>
                        Cantidad de sorteos
                    </th>
                    <th>
                         Estado
                    </th>
                </tr>
                @foreach($sorters as $value=>$sorter)
                <tr>
                    <td>
                        {{$value+1}}
                    </td>
                    <td>
                        {{$sorter->name}}
                    </td>
                    <td>
                        {{$sorter->email}}
                    </td>
                    <td>
                        {{$sorter->age}}
                    </td>
                    <td>
                        {{$sorter->lotteries_count}}
                    </td>
                    <td>
                        <form action="{{ route('sorters.toggle', $sorter->id) }}" method="POST">
                            @csrf
                            <button type="submit">
                                {{ $sorter->status ? 'Habilitado' : 'Desabilitado' }}
                            </button>
                        </form>
                    </td>
                @endforeach
        </table>

   <!-- @endif -->    
@endsection