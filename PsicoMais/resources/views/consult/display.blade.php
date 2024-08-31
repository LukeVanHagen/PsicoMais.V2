<x-app-layout>
    <div class="disp_horario" x-data="filterConsults()">
        <div class="section-subtitle">
            @if(session('msg'))
                <div class="{{ session('class') }}" x-init="hideDivsAfterDelay">
                    {{ session('msg') }}
                </div>
            @endif
        </div>

        @php
            $hasAvailableConsults = false;
        @endphp

        @foreach ($sortedConsults as $consult)
            @if (!$consult->paciente_id && $consult->profissional_id == auth()->user()->id)
                @php
                    $hasAvailableConsults = true;
                    break;
                @endphp
            @endif
        @endforeach

        <h3 class="section-title">
            {{ __('Disponibilização de Horários ') }}
        </h3>

        @if ($hasAvailableConsults)
            <div class="filter-container">
                <div class="form-container">
                    <h5 class="section-title">
                        {{ __('Filtros') }}
                    </h5>
                    <div class="input-group">
                        <label for="start_date">Início:</label>
                        <input class="input-date" type="date" x-model="startDate" id="start_date" required>
                    </div>
                    <div class="input-group">
                        <label for="end_date">Fim:</label>
                        <input class="input-date" type="date" x-model="endDate" id="end_date" required>
                    </div>
                    <div class="buttons-container">
                        <x-primary-button class="Est_button" @click="filterConsults">Filtrar</x-primary-button>
                    </div>
                    <div class="buttons-container">
                        <form action="{{ route('consult.create') }}" method="POST">
                            @csrf
                            <button type="submit">
                                <img src="{{ asset('images/icon_add.png') }}" width="50" height="50" alt="Adicionar Consulta">
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="consul-contei">
                <table class="consul-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Início</th>
                            <th>Término</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sortedConsults as $consult)
                            @if (!$consult->paciente_id && $consult->profissional_id == auth()->user()->id)
                                <tr class="consult-row" data-date="{{ date('Y-m-d', strtotime($consult->date)) }}">
                                    <td>{{ date('d-m-Y', strtotime($consult->date)) }}</td>
                                    <td>{{ date('H:i', strtotime($consult->date)) }}</td>
                                    <td>{{ date('H:i', strtotime($consult->end_time)) }}</td>
                                    <td>
                                        <form action="{{ route('consult.destroy', $consult->id) }}" method="POST">
                                            @csrf
                                            <x-primary-button  class="Est_button" type="submit" data-confirm="Tem certeza que deseja excluir?">Excluir</x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="disp_horario">
                <p class="section-subtitle">Não há consultas disponibilizadas não agendadas.</p>
                <div class="buttons-container">
                    <form action="{{ route('consult.create') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <img src="{{ asset('images/icon_add.png') }}" width="50" height="50" alt="Adicionar Consulta">
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
