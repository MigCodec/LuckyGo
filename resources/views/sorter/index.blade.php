@extends('includes.navbar')
@section('content')
<html>
    <table>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Nombre del sorteador
                </th>
                <th>
                    Correo electronico
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
                    {{$sorter->email}}
                </td>
                <td>
                    {{$sorter->name}}
                </td>
                <td>
                    {{$sorter->age}}
                </td>
                <td>
                    {{$sorter->tickets_count}}
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
</html>
@endsection