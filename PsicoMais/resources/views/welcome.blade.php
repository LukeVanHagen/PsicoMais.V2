<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PsicoMais</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/stylewelcome.css') }}" rel="stylesheet">
</head>
<body class="antialiased">
    <!-- Navbar -->
    <nav class="navbar">
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/PsicoMaisLogo.svg') }}" alt="PsicoMais Logo">
        </div>
        <div class="menu">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
            @else
            <div class="Div_b">
                <a href="{{ route('login') }}" class="nav-link">Entrar</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-link">Registrar</a>
                @endif
            </div>
            @endauth
            @endif
        </div>
    </div>
</nav>

    <!-- Main Section -->
    <main class="main-content">
        <div class="hero">
            <h1>PsicoMais+</h1>
            <p class="hero-text">Plataforma para gestão eficiente de consultas psicológicas em hospitais-escola.</p>
        </div>
    </main>
  <div  class = 'Div_img'>
        <!-- Image between Main and About Section -->
        <div class="image-container">
            <img src="{{ asset('images/Img_come.svg') }}" alt="Profissional">
        </div>


    </div>
    <!-- About Project Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2>Sobre o Projeto</h2>
            <p>O PsicoMais visa otimizar a gestão de consultas psicológicas em ambientes acadêmicos, enfrentando desafios como atrasos e dificuldades de comunicação. Oferece agendamento, registro e controle de atendimentos em uma única plataforma.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container services-container">
            <div class="service-card">
                <h3>Cliente</h3>
                <p>Agende consultas com profissionais de sua escolha.</p>
            </div>
            <div class="service-card">
                <h3>Profissional</h3>
                <p>Disponibilize consultas conforme seu horário.</p>
            </div>
            <div class="service-card">
                <h3>GitHub</h3>
                <p><a href="https://github.com/LukeVanHagen/Projeto2IF">Veja o projeto no GitHub.</a></p>
            </div>
        </div>
    </section>

    <script>
        function showPopup(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closePopup(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>

    <script src="{{ asset('js/buttwelcome.js') }}"></script>
</body>
</html>
