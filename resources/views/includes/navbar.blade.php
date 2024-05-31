<nav>
  <ul>
    @if(auth()->guard("admin")->check())
    <li><a href="{{route("register")}}">Registrar Sorteador</a></li>
    <li><a href="{{route("sorters.index")}}">Sorteadores</a></li>
    @endif
    @if(auth()->guard("sorter")->check())
    <li><a href="{{route("lotteries.index")}}">Sorteo</a></li>
    @endif
    <li><a href="{{route("tickets.index")}}">Comprar billete de loteria</a></li>
    <li><a href="{{route("logout")}}">Cerrar Sesion</a></li>
  </ul>
</nav>
<style>
  nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #0A74DA;
    padding: 10px 20px;
   display: flex;
    z-index: 1000;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    margin-left: auto;
}

nav ul li {
   display: inline-block;
    margin-right: 30px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

nav ul li a:hover {
    color: #ccc; 
}

.logo {
   position: relative;
    margin-top: 50px; 
    margin-left: 50px;
}

.logo img {
    max-width: 10%; 
    height: auto; 
}
body{
  font-family: Arial, sans-serif;
}
  </style>
<div class="logo">
  <img src="{{ url('logo.png') }}" alt="Lucky Go Logo">
</div>
@yield('content')
@yield('styles')