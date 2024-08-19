<section class="delete-account-section">
    <style>
        /* Section Styles */
        .delete-account-section {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Header Styles */
        .delete-account-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: left;
            margin-bottom: 10px;
        }

        .delete-account-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        /* Button Styles */
        .delete-button {
            background-color: #e63946;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            margin-top: 15px;
        }

        .delete-button:hover {
            background-color: #d62828;
        }

        .cancel-button {
            background-color: #888;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .cancel-button:hover {
            background-color: #666;
        }

        .confirm-delete-button {
            background-color: #e63946;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            margin-left: 10px;
        }

        .confirm-delete-button:hover {
            background-color: #d62828;
        }

        /* Modal Styles */
        .delete-form {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .modal-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        /* Input Styles */
        .input-container {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .input-password {
            width: 100%;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #cccccc;
            font-size: 16px;
        }

        .input-password:focus {
            border-color: #888888;
            outline: none;
            box-shadow: 0 0 5px rgba(229, 231, 235, 1);
        }

        /* Input Label Styles */
        .input-label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        /* Error Message Styles */
        .error-message {
            color: #e63946;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Button Container Styles */
        .buttons-container {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .delete-account-section {
                padding: 15px;
                max-width: 100%;
            }

            .delete-button, .cancel-button, .confirm-delete-button {
                width: 100%;
                margin-top: 10px;
            }

            .buttons-container {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>

    <header>
        <h2 class="delete-account-title">
            {{ __('Deletar Conta') }}
        </h2>

        <p class="delete-account-description">
            {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, faça o download de todos os dados ou informações que deseja reter.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="delete-button"
    >{{ __('Deletar Conta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="delete-form">
            @csrf
            @method('delete')

            <h2 class="modal-title">
                {{ __('Você tem certeza que quer deletar a conta?') }}
            </h2>

            <p class="modal-description">
                {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Digite sua senha para confirmar que deseja excluir permanentemente sua conta.') }}
            </p>

            <div class="input-container">
                <x-input-label for="password" value="{{ __('Senha') }}" class="input-label" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="input-password"
                    placeholder="{{ __('Senha') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="error-message" />
            </div>

            <div class="buttons-container">
                <x-secondary-button x-on:click="$dispatch('close')" class="cancel-button">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="confirm-delete-button">
                    {{ __('Deletar Conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
