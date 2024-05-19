@extends('includes.navbar')
@section('content')
<html>
    <table>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Email
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Edad
                </th>
                <th>
                   Status
                </th>
            </tr>
            @foreach($sorters as $sorter)
            <tr>
                <td>
                    {{$sorter->id}}
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
                    <form action="{{ route('sorters.toggle', $sorter->id) }}" method="POST">
                        @csrf
                        <button type="submit">
                            {{ $sorter->status ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                </td>
            @endforeach
    </table>
</html>
@endsection