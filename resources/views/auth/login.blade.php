
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
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

        .logo {
            display: block; 
            margin: 0 auto; 
            height: 200px; 
        }
    </style>
</head>
<!-- Main Container -->
<body>
    <div class="container">
       <!-- Logo -->
       <img src="luckygo_logo.png" class="logo" alt="Lucky Go Logo">
    </div>
    <!-- Title Login-->
    <h1 style="margin-bottom: 16px; font-size: 4rem; font-weight: 800; line-height: 1.5; text-align: center;">Iniciar sesión</h1>

    <!-- Login Form -->
    <div style="max-width: 28rem; margin: 0 auto; padding: 2.5rem; background-color: #fff; border-radius: 1.5rem; border: 4px solid #D1CEC5;">
        <form style="max-width: 20rem; margin: 0 auto;" method="POST" action="{{ route('login') }}" novalidate>
          @csrf
           <!-- Email Field -->
            <div style="margin-right: 1.25rem; flex: 2;">
              <label for="email" style="margin-bottom: 0.5rem; font-size: 2rem; font-weight: 500;">Correo Electrónico:</label>
              <input type="text" id="email" name="email" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.7rem;" required />
              @error('email')
              <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
              @enderror
            </div>
            <!-- Password Field -->
            <div style="margin-right: 1.25rem; flex: 2;">
              <label for="password" style="margin-bottom: 10px 1rem; font-size: 2rem; font-weight: 500;">Contraseña:</label>
              <input type="password" id="password" name="password" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.7rem;" required />
              @error('password')
              <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
              @enderror
            </div>
            <!-- Login Button -->
            <div style="margin-top: 1rem; text-align: center;">
              <button type="submit" style="margin-bottom: 10px; background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 1.2rem; text-align: center; padding: 1rem 1.5rem; width: 100%; max-width: 10rem;">Acceder</button>
              <!-- Success Message -->
              @if(session('login_successfully'))
              <p style="background-color: #2ECC71; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('login_successfully')}}</p>
              @endif
              @if(session('change_password_successfully')) 
              <p style="background-color: #2ECC71; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('change_password_successfully')}}</p>
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
