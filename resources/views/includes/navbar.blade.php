<nav>
  <ul>
    @if(auth()->guard("admin")->check())
    <li><a href="{{route("register")}}">Registrar Sorteador</a></li>
    <li><a href="{{route("sorters.index")}}">Sorteador</a></li>
    <li><a href="{{route("lotterys.index")}}">Sorteo</a></li>
    @endif
    @if(auth()->guard("sorter")->check())
    <li><a href="{{route("tickets.index")}}">Comprar billete de loteria</a></li>
    @endif
    <li><a href="{{route("logout")}}">Cerrar Sesion</a></li>
  </ul>
</nav>
@yield('content')