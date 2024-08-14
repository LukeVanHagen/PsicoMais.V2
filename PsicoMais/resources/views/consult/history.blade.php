<x-app-layout>
    @php
        $hasConsults = false;
    @endphp

    @foreach ($sortedConsults as $consult)
        @if (($consult->paciente_id == Auth::id() || $consult->profissional_id == Auth::id()) && strtotime($consult->date) < time() && $consult->paciente_id != null)
            @php
                $hasConsults = true;
                break;
            @endphp
        @endif
    @endforeach

    <div class="disp_horario">
        <h3 class="section-title">
            {{ __('Histórico de Consultas') }}
        </h3>
    </div>

    <div class="disp_horario">
        @if ($hasConsults)
            <div class="consul-contei">
                <table class="consul-table">
                    <thead>
                        <tr>
                            @if(Auth::check() && Auth::user()->type == 'Profissional')
                                <th>Paciente</th>
                            @elseif(Auth::check() && Auth::user()->type == 'Paciente')
                                <th>Profissional</th>
                            @endif
                            <th>Data</th>
                            <th>Início</th>
                            <th>Término</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $consults = $sortedConsults;
                        @endphp
                        @foreach ($consults as $consult)
                            @if (($consult->paciente_id == Auth::id() || $consult->profissional_id == Auth::id()) && strtotime($consult->date) < time() && $consult->paciente_id != null)
                                <tr class="consult-row">
                                    @if ($consult->profissional_id == Auth::id())
                                        <td>{{ $users->find($consult->paciente_id)->name }}</td>
                                    @else
                                        <td>{{ $users->find($consult->profissional_id)->name }}</td>
                                    @endif
                                    <td>{{ date('d-m-Y', strtotime($consult->date)) }}</td>
                                    <td>{{ date('H:i', strtotime($consult->date)) }}</td>
                                    <td>{{ date('H:i', strtotime($consult->end_time)) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="section-subtitle">Você não possui nenhuma consulta realizada.</p>
        @endif
    </div>
</x-app-layout>
