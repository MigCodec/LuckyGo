@extends('includes.navbar')
@section('content')

  <h1>Lista De Sorteadores</h1>
      
    <form action="{{route('sorters.search')}}" method="GET"><br>
        @csrf          
        <input id="search" name="q" type="text" placeholder="Ingrese nombre o correo electrónico">
        <input id="submit" type="submit" value="Buscar">
    </form>
    @if (isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div> 
    @else
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
                            <select name="status" onchange="this.form.submit()">
                                <option value="1" {{ $sorter->status ? 'selected' : '' }}>Habilitado</option>
                                <option value="0" {{ $sorter->status ? '' : 'selected' }}>Deshabilitado</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
        </table>

   @endif  
@endsection

@section('styles')
    <style>
        #search {
            width: 600px; padding: 12px; font-size: 18px;
        }

        #submit {
            padding: 12px 24px; font-size: 18px;
        }

        table {
            width: 100%; border-collapse: collapse; margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px; text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection
