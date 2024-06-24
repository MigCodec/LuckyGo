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
    <div style="max-width: 28rem; margin: 0 auto; padding: 2.5rem; background-color: #fff; border-radius: 1.5rem; border: 4px solid #D1CEC5;">
        <form style="max-width: 20rem; margin: 0 auto;" method="POST" action="{{ route('login') }}" novalidate>
          @csrf
           <!-- New Passsword Field -->
            <div style="margin-right: 1.25rem; flex: 2;">
              <label for="email" style="margin-bottom: 0.5rem; font-size: 2rem; font-weight: 500;">Nueva Contraseña:</label>
              <input type="text" id="email" name="email" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.7rem;" required />
              @error('email')
              <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
              @enderror
            </div>
            <!-- Password Confirm Field -->
            <div style="margin-right: 1.25rem; flex: 2;">
              <label for="password" style="margin-bottom: 10px 1rem; font-size: 2rem; font-weight: 500;">Confirmar Contraseña:</label>
              <input type="password" id="password" name="password" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.7rem;" required />
              @error('password')
              <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
              @enderror
            </div>
             <!-- Confirm Button -->
            <div style="margin-top: 1rem; text-align: center;">
              <button type="submit" style="margin-bottom: 10px; background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 1.2rem; text-align: center; padding: 1rem 1.5rem; width: 100%; max-width: 10rem;">Cambiar</button>
             <!-- Success Message -->
              @if(session('login_successfuly'))
              <p style="background-color: #2ECC71; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('login_successfuly')}}</p>
              @endif
              <!-- Error Message -->
              @if(session('message'))
              <p style="background-color: #f56558; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('message')}}</p>
              @endif
            </div>
        </form>        
    </div>
    
</body>
</html>








