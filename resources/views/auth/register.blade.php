<form method="POST" action="{{route('register')}}">
  @csrf
    <h1>Register</h1>
    <input name="name"/>
    <input name="age"/>
    <input name="email"/>
    @error('email')
    <p style="background-color: #f56558; color: #fff; margin-top: 0.5rem; border-radius: 0.375rem; font-size: 1rem; text-align: center; padding: 0.25rem;">{{$message}}</p>
    @enderror
    <button type="submit" style="margin-bottom: 0px; background-color: #3B82F6; color: #fff; font-weight: 500; border-radius: 0.375rem; font-size: 0.875rem; text-align: center; padding: 0.625rem 1.25rem; width: 100%; max-width: 10rem;">Registrar</button>
</form>