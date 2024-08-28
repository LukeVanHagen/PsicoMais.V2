<!-- resources/views/login.blade.php -->
<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="session-status mb-4">
            {{ session('status') }}
        </div>
    @endif
<div class = 'container'>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder = "Digite seu e-mail">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder =  "Digite sua senha">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="input-group checkbox-label">
            <input id="remember_me" type="checkbox" name="remember">
            <span>Lembre-me</span>
        </div>

        <!-- Action Buttons -->
        <div class="button-container">
            <a href="{{ route('register') }}">Registrar-se</a>
            <x-primary-button type="submit" class="Est_button">Entrar</x-primary-button>
        </div>
    </form>
  </div>
</x-guest-layout>


<style>
:root {
  --primary-color: #52b1ff; /* Azul Brilhante */
  --secondary-light: #a3d5ff; /* Azul Claro */
  --secondary-dark: #1e81d3; /* Azul Médio */
  --accent-color: #ffb152; /* Laranja Suave */
  --background-light: #f1faff; /* Cinza Azulado Claro */
  --text-color-dark: #333333; /* Cinza Escuro */
  --highlight-color: #ff5252; /* Vermelho Suave */
}

/* Global Reset and Base Styles */
body, h1, h2, h3, h4, h5, h6, p, ul, ol, a, button {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

/* Body Background */
body {
  background-color: var(--background-light);
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
  margin: 0;
}

.container {
  display: flex;
  max-width: 1200px;
  width: 100%;
  height: 39vh;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  background-color: rgba(255, 255, 255, 0.9); /* Fundo branco com 90% de opacidade */
  backdrop-filter: blur(10px); /* Opcional: adiciona um efeito de desfoque ao fundo */
}

/* Lado esquerdo com imagem */
.left-side {
  flex: 1;
  background-color: var(--secondary-light);
  display: flex;
  justify-content: center;
  align-items: center;
}

.left-side img {
  max-width: 100%;
  height: auto;
  display: block;
}

/* Lado direito com formulário */
.right-side {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
  background-color: #ffffff;
}

form {
  width: 100%;
  max-width: 500px;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  transition: box-shadow 0.3s ease;
}

form:hover {
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
}

/* Input Group Styles */
.input-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-size: 14px;
  color: var(--text-color-dark);
  margin-bottom: 8px;
}

input[type="email"],
input[type="password"],
input[type="text"],
input[type="checkbox"],
select {
  width: 100%;
  padding: 12px;
  border-radius: 4px;
  border: 1px solid var(--secondary-light);
  font-size: 16px;
  background-color: #f9f9f9;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="email"]:focus,
input[type="password"]:focus,
input[type="text"]:focus,
select:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 5px rgba(82, 177, 255, 0.5);
  outline: none;
}

input[type="checkbox"] {
  width: auto;
}

/* Error Message Styles */
.error-message {
  color: var(--highlight-color);
  font-size: 12px;
  margin-top: 5px;
}

/* Button Styles */

.Est_button {
  background-color: var(--background-light);
  color: var(--text-color-dark);
  padding: 10px 15px;
  border: solid 1px var(--primary-color);
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s, box-shadow 0.3s;
  text-decoration: none;
  margin-left: 60px; /* Espaço equivalente a um dedo (~16px) */
}

.Est_button:hover {
  background-color: var(--primary-color);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.Est_button:focus {
  outline: none;
  box-shadow: 0 0 5px var(--accent-color);
}


button.primary-button {
  background-color: var(--primary-color);
  color: #ffffff;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s, box-shadow 0.3s;
}

button.primary-button:hover {
  background-color: var(--secondary-dark);
  box-shadow: 0 4px 8px rgba(82, 177, 255, 0.3);
}

button.primary-button:focus {
  outline: none;
  box-shadow: 0 0 5px rgba(82, 177, 255, 0.5);
}

/* Link Styles */
a {
  color: var(--primary-color);
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* Checkbox Label Styles */
.checkbox-label {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.checkbox-label span {
  margin-left: 8px;
  color: #666666;
  font-size: 14px;
}

/* Flex container for buttons */
.button-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}

.button-container a {
  font-size: 14px;
  color: var(--primary-color);
  text-decoration: none;
  transition: color 0.3s;
}

.button-container a:hover {
  text-decoration: underline;
}

.button-container button.primary-button {
  font-size: 14px;
  padding: 10px 15px;
}

    
    </style>