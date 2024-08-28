<x-app-layout>
    <div class="disp_horario">
        <h3 class="section-title">
            Disponibilizar Horário:
        </h3>
    </div>
    <div class="form-container">
        <form action="{{ route('consult.store') }}" method="POST" class="form-container">
            @csrf

            <div class="input-group">
                <label for="date">Estarei disponível em:</label>
                <input class="input-date" type="date" name="date" id="date" value="{{ $dataAtual }}" required>
            </div>
            <div class="input-group">
                <label for="time">às:</label>
                <input class="input-date" type="time" id="time" name="time" required>
            </div>
            <div class="input-group">
                <p>
                    <label for="period">Durante</label>
                    <input class="input-field" type="number" name="period" id="period" min="1" max="24" placeholder="00" required>
                    <label for="period">Horas</label>
                </p>
            </div>
            <div class="buttons-container">
                <x-primary-button class="Est_button">
                    {{ __('Enviar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
