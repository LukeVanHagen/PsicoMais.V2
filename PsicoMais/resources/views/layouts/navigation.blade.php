<nav class="navbar">
    <!-- Primary Navigation Menu -->
    <div class="nav-container">
        <!-- Logo na extrema esquerda -->
        <div class="nav-logo">
            <a href="{{ route('dashboard') }}">
                <img class="imglogo" src="{{ asset('images/PsicoMaisLogo.svg') }}" />
            </a>
        </div>

        <!-- Navigation Links Centralizados -->
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                {{ __('Consultas') }}
            </a>
            @if(Auth::check() && Auth::user()->type == 'Profissional')
                <a href="{{ route('consult.display') }}" class="nav-link {{ request()->routeIs('consult.display') ? 'active' : '' }}">
                    {{ __('Agendamentos') }}
                </a>
            @endif
            @if(Auth::check() && Auth::user()->type == 'Paciente')
                <a href="{{ route('consult.list') }}" class="nav-link {{ request()->routeIs('consult.list') ? 'active' : '' }}">
                    {{ __('Agendamentos') }}
                </a>
            @endif
            <a href="{{ route('consult.history') }}" class="nav-link {{ request()->routeIs('consult.history') ? 'active' : '' }}">
                {{ __('Histórico') }}
            </a>
        </div>

        <!-- Settings Dropdown na extrema direita -->
        <div class="nav-logout">
            <div class="dropdown">
                <button class="dropdown-toggle">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="dropdown-icon">
                        <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                <div class="dropdown-content">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">{{ __('Editar Perfil') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Sair') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
