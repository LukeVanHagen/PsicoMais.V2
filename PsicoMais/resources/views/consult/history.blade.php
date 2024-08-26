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
                            @if(Auth::check() && Auth::user()->type == 'Profissional')
                                <th>Nota</th> <!-- Coluna para os botões de nota -->
                            @endif
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
                                    @if(Auth::check() && Auth::user()->type == 'Profissional')
                                        <td>
                                            <!-- Botão para exibir o campo de nota -->
                                            <button type="button" class="btn btn-sm btn-primary" onclick="showNoteForm({{ $consult->id }})">Adicionar Nota</button>

                                            <!-- Formulário de adição de nota (inicialmente oculto) -->
                                            <form id="note-form-{{ $consult->id }}" action="{{ route('notas.store') }}" method="POST" style="display:none;">
                                                @csrf
                                                <input type="hidden" name="consult_id" value="{{ $consult->id }}">
                                                <input type="text" name="nota" class="form-control" placeholder="Digite a nota">
                                                <button type="submit" class="btn btn-sm btn-success mt-2">Salvar</button>
                                            </form>

                                            <!-- Botão para ver a nota existente -->
                                            <button type="button" class="btn btn-sm btn-info mt-2" onclick="showNote({{ $consult->id }})">Ver Nota</button>

                                            <!-- Campo para exibir a nota cadastrada (inicialmente oculto) -->
                                            <div id="note-display-{{ $consult->id }}" style="display:none; margin-top: 5px;">
                                                <strong>Nota:</strong> <span id="note-text-{{ $consult->id }}">{{ $consult->nota }}</span>
                                            </div>
                                        </td>
                                    @endif
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
