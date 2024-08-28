<section class="profile-info-section py-6 max-w-4xl mx-auto">
    <header class="profile-header mb-6">
        <h2 class="section-title text-2xl font-semibold text-gray-900 dark:text-gray-100">
            {{ __('Informações de Perfil') }}
        </h2>

        <p class="section-description text-sm text-gray-600 dark:text-gray-400">
            {{ __("Atualize as informações de perfil e o endereço de email da sua conta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="profile-update-form space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <x-input-label for="name" :value="__('Nome')" class="input-label text-gray-700 dark:text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="input-field mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="error-message text-red-600 dark:text-red-400 mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" class="input-label text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="input-field mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="error-message text-red-600 dark:text-red-400 mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-section mt-4 p-4 border border-gray-300 dark:border-gray-700 rounded-md">
                    <p class="verification-info text-sm text-gray-700 dark:text-gray-300">
                        {{ __('Seu endereço de email não foi verificado.') }}

                        <button form="send-verification" class="verification-button mt-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Clique aqui para reenviar o email de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="status-update-message mt-2 text-sm text-green-600 dark:text-green-400">
                            {{ __('Um novo link de verificação foi enviado ao seu endereço de email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-actions flex items-center gap-4 mt-6">
            <x-primary-button class="Est_button">
                {{ __('Salvar') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="status-update-message text-sm text-green-600 dark:text-green-400"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
