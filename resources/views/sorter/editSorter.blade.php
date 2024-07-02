@extends('includes.navbar')

@section('content')
<title>Editar Sorteador</title>
<div class="container">
    <h1 style="margin-bottom: 50px; font-size: 2.5rem; font-weight: 800; line-height: 1.5; text-align: center;">Actualizar Datos del Sorteador</h1>
    <div style="max-width: 28rem; margin: -2rem auto 0 auto; padding: 4rem; background-color: #fff; border-radius: 1.5rem; border: 4px solid #D1CEC5; line-height:auto;">
        <form class="confirmedform" style="max-width: 20rem; margin: 0 auto;" method="POST" action="{{ route('sorters.update_sorter', ['sorter' => $sorter->id]) }}" novalidate>
            @csrf
            @method('PUT')
            <!-- Sorter Name Field -->
            <div style="margin-bottom: 2.25rem; display: flex;">
                <div class="tooltip" style="margin-right: 2rem; flex: 1;">
                    <label for="name" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Nombre:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $sorter->name) }}" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    <span class="tooltip_text">Ingrese nuevo nombre</span>
                    @error('name')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 0.875rem; text-align: center; padding: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Age Field -->
                <div class="tooltip" style="flex: 0.5;">
                    <label for="age" style="margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 500;">Edad:</label>
                    <input type="number" id="age" name="age" value="{{ old('age', $sorter->age) }}" style="background-color: #F3F4F6; border: 1px solid #CBD5E0; font-size: 0.875rem; border-radius: 0.375rem; display: block; width: 100%; padding: 0.625rem;" required />
                    <span class="tooltip_text">Ingrese nueva edad</span>
                    @error('age')
                    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 0.875rem; text-align: center; padding: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Submit Button -->
            <div class="tooltip" style="display: flex; justify-content: center;">
                <button type="submit" style="background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 0.875rem; text-align: center; padding: 0.625rem 1.25rem; width: 100%; max-width: 12rem; cursor: pointer;">Actualizar Datos</button>
                <span class="tooltip_text">Guardar cambios</span>
            </div>
        </form>
        @if(session('message_conection_error'))
        <p style="background-color: #f56558; color: #fff; border-radius: 0.375rem; font-size: 1rem; padding: 0.25rem; margin-top: 1rem; text-align: center;">{{ session('message_conection_error') }}</p>
        @endif
        @if(session('successfully'))
        <p style="background-color: #2ECC71; color: #fff; border-radius: 0.7rem; font-size: 1rem; padding: 0.25rem;">{{session('successfully')}}</p>
        @endif
    </div>
</div>
@endsection