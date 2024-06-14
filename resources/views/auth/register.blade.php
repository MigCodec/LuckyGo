@extends('includes.navbar')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Sorteador</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


    </style>
</head>
<body>
    <!-- Main Container -->
    <!-- Main Container -->
    <!--
    <div class="container">
        <img src="luckygo_logo.png" alt="Lucky Go Logo" 
        style = "width: 100px; height: auto;">
        
    </div>d
    -->
    <!-- Title register -->
    <h1 style="margin-bottom: 50px; font-size: 2.5rem; font-weight: 800; line-height: 1.5; text-align: center;">Registrar Sorteador</h1>
    <!-- Registration Form -->
    <div style="max-width: 28rem; margin: -2rem auto 0 auto; padding: 4rem; background-color: #fff; border-radius: 1.5rem; border: 4px solid #D1CEC5; line-height:auto;">
        <form class="confirmedform" style="max-width: 20rem; margin: 0 auto;" method="POST" action="{{ route('register') }}" novalidate>
            @csrf
             <!-- Sorter Name Field -->
            <div style="margin-bottom: 2.25rem; display: flex;">
                <div style="margin-right: 2rem; flex: 8;;flex: 1; margin-left: -5rem;">
                    <label for="name" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Nombre del sorteador:</label>
                    <input type="name" id="name" name="name" style="background-color: #F3F4F6; ;border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    @error('name')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                    @enderror
                </div>
                <!-- Age Field -->
                <div style="flex: 0.5;margin-right: -5rem">
                    <label for="age" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Edad:</label>
                    <input type="age" id="age" name="age" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    @error('age')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <!-- Email Field -->
            <div style="margin-bottom: 1.25rem;flex: 1; margin-left: -5rem;margin-right:-5rem;">
                <label for="mail" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Correo electrónico:</label>
                <input type="mail" id="mail" name="email" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                @error('email')
                <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                @enderror
            </div>
            <!-- Submit Button -->
            <div style="display: flex; justify-content: center;">
                <button type="submit"  style="background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 0.875rem; text-align: center; padding: 0.625rem 1.25rem; width: 100%; max-width: 12rem;">Registrar</button>
                @if(session('message_conection_error'))
                <p style="background-color: #f56558; color: #fff; border-radius: 0.375rem; font-size: 1rem; padding: 0.25rem;">{{session('message_conection_error')}}</p>
                @endif
            </div>
        </form>
    </div>

</body>
</html>
@endsection