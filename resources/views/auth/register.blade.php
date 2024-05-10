<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <div class="container">
        <img src="https://lh3.googleusercontent.com/pw/AP1GczMe3fo-AA66butYjilgqMojeACEilQxXtxfIOrmmFGlMUoU1BoTLm3-MV-5olvqcXUaUOTY9RhDSiErrVp6Jgd3Fw8gf-EZHuruO6Zp2KoeWGkkSosmXKDrrRjtoG_UPcofqNNvotCn1XPH5E2KRb5mxMGcSumpCPTrsU0M6Avv0my7OHLHwCXcYTSftU2Ye5pXRUcNynf05JbadZ8v0NPNunI9nZ6IPGUsPv1X8mhyWVwoLGMIj5i2FsQ73jdQ63xkWkZMA8SVX9qQgdiF8rZ-Pfquf65TZk4NRIv_kvoi_Q1CCKSwI6glK1K5vjSlIteSfBgT7wzC7xyzu5OCQxe2-rPfNXacyouj8Bfn0qkxxr3ozHnMK6cDODLSs0IvzR9OFjxjj106A3ykEvl_kEFAal1pURzsllHiBYcHF9a1vNYy9sUsWqFLOmc9K_pMGfTzmXA9PZbBMHS7uxdfB4FWAKFwf_xKvdKhur-bJ_FFIuqCXQ7rXlQtKz66z4aUPg45KN8Eapu1xOo_H9n3G0zBbakj8MM3cdIgXx0dMmH0VhmOaR7woCU6oxwBcSnu_BsXDswE10tgosK65OlZcE3mriqUFb2EIK55lGPPihOiw-99tX700DmuNPAMYRha-Zcw6_88mfNtREMux-6wXulnrr9xw3l5oobXopLQdT1VTkkTsg-fqxqEeBQYy1JgAHmuvd2vOQD_Jqf4ieZelEoRUp8GI5tch6blMlWlgABbnGrjS2nT2pcUzOLzt4LgtiCuSYEla3PnJwEaStPsyqj_VBVmz3KdXE-0wRVnzmG8uGfda2zLk5q2VZxN6oujpc6LujPCr21yRR8Q45VjYeKpJtPdy0u_CVsu-GGEnSS3V2vIGniQPwXHdD1bck7a3Ge4NsW8iS-wB3LknMEXV5lBwYiBGRK_gAhKUIIsgP1rvbkOObawOfCRAyvypxnU-8QmSqvsVJ_CA2nm9HStY3_qhFEAEpwTDofMoauH33QfDuUR4K8Cv1RtBHCWPOB2jzMD_r9U1usR3zOOEqxdJ6abimi_R9Nyb1Tr7Z2MFVn5ZdgB-Xr11Em0f6WQTiCSMV1sCBkMVA=w879-h879-s-no-gm?authuser=1" alt="Lucky Go Logo" 
        style = "width: 160px; height: auto;">
        
    </div>
    
    <h1 style="margin-bottom: 50px; font-size: 2.5rem; font-weight: 800; line-height: 1.5; text-align: center;">Registrar Sorteador</h1>

    <div style="max-width: 28rem; margin: -2rem auto 0 auto; padding: 4rem; background-color: #fff; border-radius: 1.5rem; border: 4px solid #D1CEC5; line-height:auto;">
        <form style="max-width: 20rem; margin: 0 auto;" method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div style="margin-bottom: 2.25rem; display: flex;">
                <div style="margin-right: 2rem; flex: 8;;flex: 1; margin-left: -5rem;">
                    <label for="name" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Nombre del sorteador:</label>
                    <input type="name" id="name" name="name" style="background-color: #F3F4F6; ;border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    @error('name')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                    @enderror
                </div>
                <div style="flex: 0.5;margin-right: -5rem">
                    <label for="age" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Edad:</label>
                    <input type="age" id="age" name="age" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    @error('age')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div style="margin-bottom: 1.25rem;flex: 1; margin-left: -5rem;margin-right:-5rem;">
                <label for="mail" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Correo electrónico:</label>
                <input type="mail" id="mail" name="email" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                @error('email')
                <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
                @enderror
            </div>
            <div style="display: flex; justify-content: center;">
                <button type="submit" style="background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 0.875rem; text-align: center; padding: 0.625rem 1.25rem; width: 100%; max-width: 12rem;">Registrar</button>
            </div>
        </form>
    </div>    

</body>
</html>