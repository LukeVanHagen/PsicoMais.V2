<header>
    <h2 class="section-title text-xl font-semibold text-gray-900 dark:text-gray-100">
        {{ __('Atualizar Senha') }}
    </h2>

    <p class="section-description text-sm text-gray-600 dark:text-gray-400">
        {{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para se manter segura.') }}
    </p>
</header>

<form method="post" action="{{ route('password.update') }}" class="password-update-form mt-6 space-y-6">
    @csrf
    @method('put')

    <div class="form-group">
        <x-input-label for="current_password" :value="__('Senha Atual')" class="input-label text-gray-700 dark:text-gray-300" />
        <x-text-input 
            id="current_password" 
            name="current_password" 
            type="password" 
            class="input-field mt-1 block w-full  text-gray-900 dark:bg-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            autocomplete="current-password" 
        />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="error-message text-red-600 dark:text-red-400 mt-2" />
    </div>

    <div class="form-group">
        <x-input-label for="password" :value="__('Nova Senha')" class="input-label text-gray-700 dark:text-gray-300" />
        <x-text-input 
            id="password" 
            name="password" 
            type="password" 
            class="input-field mt-1 block w-full bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            autocomplete="new-password" 
        />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="error-message text-red-600 dark:text-red-400 mt-2" />
    </div>

    <div class="form-group">
        <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" class="input-label text-gray-700 dark:text-gray-300 " />
        <x-text-input 
            id="password_confirmation" 
            name="password_confirmation" 
            type="password" 
            class="input-field mt-1 block w-full bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            autocomplete="new-password" 
        />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="error-message text-red-600 dark:text-red-400 mt-2" />
    </div>

    <div class="form-actions flex items-center gap-4 mt-6">
    <x-primary-button class="Est_button">
                {{ __('Salvar') }}
            </x-primary-button>

        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="status-message text-sm text-green-600 dark:text-green-400"
            >{{ __('Salvo.') }}</p>
        @endif
    </div>
</form>
