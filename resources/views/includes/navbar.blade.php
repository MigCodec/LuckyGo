<nav>
  <ul>
  
    
    @if (auth()->guard("admin")->check())
    <!-- Links for admin users -->
    
    <li><a href="{{route("change_password_form")}}">Cambiar Contraseña</a></li>
    <li><a href="{{route("register")}}">Registrar Sorteador</a></li>
    <li><a href="{{route("sorters.index")}}">Sorteadores</a></li>
    <li><a href="{{route("logout")}}">Cerrar Sesión</a></li>
  
    @elseif(auth()->guard("sorter")->check())
    <!-- Links for sorter users -->
    @php
     $sorter_id = auth()->guard("sorter")->user()->id;
     @endphp
    <li><a href="{{ route("sorters.edit_sorter", ['sorter' => $sorter_id]) }}">Editar Sorteador</a></li>
    <li><a href="{{route("change_password_form")}}">Cambiar Contraseña</a></li>
    <li><a href="{{route("lotteries.index")}}">Sorteo</a></li>
    <li><a href="{{route("logout")}}">Cerrar Sesión</a></li>
    <!-- Link for unauthenticated users -->
     @else
     <li><a href="{{route("tickets.show_form")}}">Revisar Ticket</a></li>
     <li><a href="{{route("login")}}">Iniciar Sesión</a></li>
    @endif
     
  </ul>
</nav>
<style>
     /* 
      Styling for the navigation bar 
     */
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
  <style>
.hidden{
  display:none;
}
#confirmationDialog {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 99;
}

.dialogContent {
    background: white;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}

.dialogContent p {
    margin-bottom: 20px;
}

.dialogContent button {
    margin: 5px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#confirmButton {
    background-color: green;
    color: white;
}

#cancelButton {
    background-color: red;
    color: white;
}
  </style>
<style>
    .tooltip {
    position: relative;
    display: inline-block;
    }

    .tooltip .tooltip_text {
    visibility: hidden;
    width: 170px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 110%;
    left: 50%;
    margin-left: -60px;
    }

    .tooltip .tooltip_text::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: black transparent transparent transparent;
    }

    .tooltip:hover .tooltip_text {
    visibility: visible;
    }
</style>
<div class="logo">
  <img src="{{ url('logo.png') }}" alt="Lucky Go Logo">
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll('.confirmedform');
    const confirmationDialog = document.getElementById('confirmationDialog');
    const confirmButton = document.getElementById('confirmButton');
    const cancelButton = document.getElementById('cancelButton');
    let currentForm = null;
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            currentForm = form;
            console.log("xD");
            confirmationDialog.classList.remove('hidden');
            confirmationDialog.style="display:flex";
        });
    });

    confirmButton.addEventListener('click', function() {
        if (currentForm) {
            currentForm.submit();
        }
    });

    cancelButton.addEventListener('click', function() {
        confirmationDialog.classList.add('hidden');
        confirmationDialog.style="display:none";
    });
}); 
</script>
  <div id="confirmationDialog" class="hidden">
    <div class="dialogContent">
        <p>¿Estás seguro de que quieres enviar este formulario?</p>
        <button id="confirmButton">Confirmar</button>
        <button id="cancelButton">Cancelar</button>
    </div>
</div>
@yield('content')
@yield('styles')