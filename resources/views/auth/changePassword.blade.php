@extends('includes.navbar')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <!-- Login Form -->
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 28rem; margin: 0 auto; padding: 2.5rem; background-color: #fff; border-radius: 1.5rem; border: 4px solid #D1CEC5;">
        <form style="max-width: 20rem; margin: 0 auto;" method="POST" action="{{ route('change_password') }}" novalidate>
          @csrf
           <!-- New Passsword Field -->
            <div class="tooltip" style="margin-right: 1.25rem; flex: 2; text-align: left; margin-bottom: 1rem;">
              <label for="password1" style="margin-bottom: 0.5rem; font-size: 2rem; font-weight: 500;">Nueva Contraseña:</label>
              <input type="password" id="password1" name="password1" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 110%; padding: 0.7rem;" required />
              <span class="tooltip_text">Ingrese su nueva contraseña</span>
              @error('password1')
              <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
              @enderror
            </div>
            <!-- Password Confirm Field -->
            <div class="tooltip" style="margin-right: 1.25rem; flex: 2; text-align: left; margin-bottom: 1rem;">
              <label for="password2" style="margin-bottom: 10px 1rem; font-size: 2rem; font-weight: 500;">Confirmar Contraseña:</label>
              <input type="password" id="password2" name="password2" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.7rem;" required />
              <span class="tooltip_text">Confirme nueva contraseña</span>
              @error('password2')
              <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
              @enderror
            </div>
            <!-- Confirm Button -->
            <div class="tooltip" style="margin-top: 1rem; flex: 1; display: flex; justify-content: center; align-items: center;">
              <div style="text-align: center;">
                <button type="submit" style="background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 1.2rem; padding: 1rem 1.5rem; width: 100%; max-width: 10rem;">Cambiar</button>
                <span class="tooltip_text">Envie cambio de contraseña</span>
              </div>
              <!-- Success Message is in login.blade-->
              <!-- Error Message -->
              @if(session('error_password_diferent'))
              <p style="background-color: #f56558; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('error_password_diferent')}}</p>
              @endif
              @if(session('error_first_char'))
              <p style="background-color: #f56558; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('error_first_char')}}</p>
              @endif
              @if(session('message'))
              <p style="background-color: #f56558; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('message')}}</p>
              @endif
            </div>
        </form>        
    </div>
    
</body>
</html>
@endsection








