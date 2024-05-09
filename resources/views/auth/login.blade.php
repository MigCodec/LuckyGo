<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            text-align: center;
            justify-content: center;
        }

        .logo {
            display: block; 
            margin: 0 auto; 
            height: 100px; 
        }
    </style>
</head>
<body>
<div class="container">
        <img src="https://lh3.googleusercontent.com/pw/AP1GczNEO8J7m5Wsj55kpXSXsbi8z5UIFBfZpbaNE-2_IpmrG5RkcYes4WSt8zAPddfG0tutaM9V0TRo3vqk6MnxMzBgBQqU7iW0y6k_iLKhJmm6W-4c7BsBhbNQOGWgfpbjNxP64gy-3wH27WUmbe6njbnoD5lQ1TUyAEE9KM2gOhEa5sfJZ0goWMTGLlNyOwlJ-C5ytqlgdAF_OVL-cmDeccYiCFq-_Wy4XN0sPvIccwRfjZ2FvcYD-FsbOjz--pug591ZFN2EHxeo6J1LRxtliX0cFEQK81JT-HjzUEHLz1U0Ok7G98TwmjMMofx-KwkU_uq2LNwkpk01hle-mDTElc_2KlefykYkvon52MsRYE_PdK2ygo8CqE1TaaruhWcjyG5mBH41uvSm0qS63HEZX_oP7VQKFRACKaLd8wX4D84V5p5E2cqwFDoiTg0GTXCfiK-Z57Ws1M0JBwjWqIOUMAEmIqZKAhQ4FyADboxE0itV-u24teYrF-mlh3DsNjrgxJ7QMqXioAr5bQ1HlZq6zWYRMsxTFAtl6uyuF3e_5QaEy3ye0dEwAvMuPdpAPjDOIdjzs6EQinTEvF53_BJsBnRnC2GXnIchR0f5HWsKvG0Rr_CzJDSJ3dB8n2UhRBlL1wGxM0-1jQRwtCneADbv4aO2BqpTk4hdzMThwq2NmOvJ5cadVosEsQ3wUk3hzaE6FKn1C7RiVJ2IyJpVPneP93ZxnDMdaqBFVcPyiXKQARMDmujMYbUqOZWneHGIuVT4gXsHWbPiYZOAE5U5UBGmujAlaNqQhNowzpQfqJanrQtgm0ZEzl_OPZSBaZKg3l32w91K-tWm1Kslv_gwMb_zzonvGesvskznMtFIsu7DkwdjxVbbDzZJHgelpmdw-Ic6YfM4SGGA_GMCK2d_FAp4K_ESOdksBJ1JKvfXvqTyo4-5Cf2rPtabG3OyZtIC8jw0ye6H3d620e5QUXtMIGoQj3HNn9EQQEe3NcEM3k5tMvFbOqR1Z41nScuPHPQxj8jVe0tvO4BdinA9ffXgRsmo_mJXx1-uuKXCo2dtwSBbNseN9f3R2g7yUgbxPk61WhWAAiFpmmWolA=w879-h879-s-no-gm?authuser=1" class="logo" alt="Lucky Go Logo">
        <style>
          .logo-container{
            text-align: center;
          }
        </style>
    </div>
    <h1 style="margin-bottom: 16px; font-size: 1.5rem; font-weight: 800; line-height: 1; text-align: center;">Iniciar sesión</h1>

    <div style="max-width: 28rem; margin: 0 auto; padding: 1.5rem; background-color: #fff; border-radius: 1.5rem; border: 4px solid #D1CEC5;">
        <form style="max-width: 20rem; margin: 0 auto;" method="POST" action="{{ route('login') }}" novalidate>
          @csrf
        <div style="margin-right: 1.25rem; flex: 2;">
                    <label for="email" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Correo Electrónico:</label>
                    <input type="text" id="email" name="email" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    @error('email')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                    @enderror
                </div>
                <div style="margin-right: 1.25rem; flex: 2;">
                    <label for="password" style="margin-bottom: 10px 0.5rem; font-size: 0.875rem; font-weight: 500;">Contraseña:</label>
                    <input type="password" id="password" name="password" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    @error('password')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                    @enderror
                </div>
                <div style="display: flex; justify-content: center;">
                <button type="submit" style="margin-bottom: 0px; background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 0.875rem; text-align: center; padding: 0.625rem 1.25rem; width: 100%; max-width: 10rem;">Acceder</button>
                @if(session('message'))
                </p>
                <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{session('message')}}</p>
                @endif
            </div>
                
            </div>
</body>
</html>
