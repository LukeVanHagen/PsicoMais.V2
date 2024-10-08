<x-app-layout>
    @php
        $hasConsults = false;
    @endphp

    @foreach ($sortedConsults as $consult)
        @if($consult->paciente_id == null && strtotime($consult->date) > time())
            @php
                $hasConsults = true;
                break;
            @endphp
        @endif
    @endforeach

    <div class="disp_horario" x-data="filterConsults()">
        <div class="section-subtitle">
            @if(session('msg'))
                {{ session('msg') }}
            @endif
        </div>

        <h3 class="section-title">
            {{ __('Marcar Consulta') }}
        </h3>

        @if ($hasConsults)
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
                        <x-primary-button class="Est_button" @click="filterConsults" >Filtrar</x-primary-button>
                    </div>
                </div>
            </div>
            <div class="consul-contei">
                <table class="consul-table">
                    <thead>
                        <tr>
                            <th>Profissional</th>
                            <th>Data</th>
                            <th>Início</th>
                            <th>Término</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sortedConsults as $consult)
                            @if($consult->paciente_id == null && strtotime($consult->date) > time())
                                <tr class="consult-row" data-date="{{ date('Y-m-d', strtotime($consult->date)) }}">
                                    <td>{{ $users->find($consult->profissional_id)->name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($consult->date)) }}</td>
                                    <td>{{ date('H:i', strtotime($consult->date)) }}</td>
                                    <td>{{ date('H:i', strtotime($consult->end_time)) }}</td>
                                    <td>
                                        <form action="{{ route('consult.mark', $consult->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                            <x-primary-button class="Est_button" type="submit">Marcar Consulta</x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="section-subtitle">Não há consultas disponíveis para agendamento no momento.</p>
        @endif
    </div>
</x-app-layout>
