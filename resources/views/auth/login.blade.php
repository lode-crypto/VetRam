@extends('layouts.app')

@section('contenido')

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.auth-page {
  min-height: calc(100vh - 70px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
  background: linear-gradient(135deg, #0f172a 0%, #012661 100%);
}

.auth-card {
  background: #1e293b;
  padding: 2.5rem 2rem;
  border-radius: 16px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
  width: 100%;
  max-width: 480px;
  border: 1px solid #334155;
}

h1 {
  text-align: center;
  color: #facc15;
  margin-bottom: 2rem;
  font-size: 2.1rem;
  font-weight: 700;
}

.form-group {
  margin-bottom: 1.6rem;
}

label {
  display: block;
  margin-bottom: 0.55rem;
  color: #cbd5e1;
  font-weight: 500;
  font-size: 0.95rem;
}

input {
  width: 100%;
  padding: 0.9rem 3rem 0.9rem 1rem;
  border: 2px solid #475569;
  border-radius: 8px;
  background: #0f172a;
  color: #f1f5f9;
  font-size: 1rem;
  transition: all 0.25s ease;
}

input:focus {
  outline: none;
  border-color: #facc15;
  box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.18);
}

.password-wrapper {
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #94a3b8;
  cursor: pointer;
}

.toggle-password.active {
  color: #facc15;
}

button[type="submit"] {
  width: 100%;
  padding: 1rem;
  background: #facc15;
  color: #0f172a;
  border: none;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 700;
  cursor: pointer;
  margin-top: 1.2rem;
}

button[type="submit"]:hover {
  background: #eab308;
}

.login-link {
  text-align: center;
  margin-top: 1.8rem;
  color: #94a3b8;
}

.login-link a {
  color: #facc15;
  text-decoration: none;
  font-weight: 600;
}

.login-link a:hover {
  text-decoration: underline;
}

.error-box {
  background: #7f1d1d;
  padding: 10px;
  border-radius: 6px;
  margin-bottom: 15px;
}
</style>

<div class="auth-page">
  <div class="auth-card">
    <h1>Iniciar sesión</h1>

    @if(session('error'))
    <div class="error-box">
      {{ session('error') }}
    </div>
  @endif

  @if($errors->any())
    <div class="error-box">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
      <label>Contraseña</label>
      <div class="password-wrapper">
        <input type="password" id="password" name="password" required>
        <button type="button" class="toggle-password" id="togglePass">
          👁
        </button>
      </div>
    </div>

    <button type="submit">Iniciar sesión</button>
    </form>

    <div class="login-link">
      ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
    </div>
  </div>
</div>

<script>
function setupToggle(inputId, buttonId) {
  const input = document.getElementById(inputId);
  const button = document.getElementById(buttonId);

  button.addEventListener('click', () => {
    if (input.type === 'password') {
      input.type = 'text';
      button.classList.add('active');
    } else {
      input.type = 'password';
      button.classList.remove('active');
    }
  });
}

setupToggle('password', 'togglePass');
</script>

@endsection