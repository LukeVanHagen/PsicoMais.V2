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
                        @foreach ($sortedConsults as $consult)
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
                                            <!-- Botões de Ação -->
                                            <div class="note-actions">
                                                <!-- Botão para exibir o pop-up de adicionar nota -->
                                                <button type="button" class="primary-button" onclick="showNoteForm({{ $consult->id }})">Adicionar </button>

                                                <!-- Botão para ver a nota existente -->
                                                <button type="button" class="primary-button" onclick="showNotePopup({{ $consult->id }})">Ver Nota</button>
                                            </div>

                                            <!-- Pop-up de adição de nota -->
                                            <div id="note-popup-{{ $consult->id }}" class="note-popup">
                                                <button type="button" class="popup-close" onclick="closeNotePopup({{ $consult->id }})">X</button>
                                                <div class="popup-title">Adicionar Nota</div>
                                                <form id="note-form-{{ $consult->id }}" action="{{ route('notas.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="consult_id" value="{{ $consult->id }}">
                                                    <input type="text" name="nota" class="input-field" placeholder="Digite a nota">
                                                    <div class="popup-actions">
                                                        <button type="submit" class="primary-button">Salvar</button>
                                                        <button type="button" class="primary-button" onclick="closeNotePopup({{ $consult->id }})">Cancelar</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Pop-up de exibição de nota -->
                                            <div id="note-popup-view-{{ $consult->id }}" class="note-popup">
                                                <button type="button" class="popup-close" onclick="closeNotePopup({{ $consult->id }})">X</button>
                                                <div class="popup-title">Nota</div>
                                                <div id="note-text-{{ $consult->id }}">{{ $consult->nota }}</div>
                                                <div class="popup-actions">
                                                    <button type="button" class="primary-button" onclick="closeNotePopup({{ $consult->id }})">Fechar</button>
                                                </div>
                                            </div>

                                            <!-- Overlay de fundo para o pop-up -->
                                            <div id="note-overlay-{{ $consult->id }}" class="note-overlay" onclick="closeNotePopup({{ $consult->id }})"></div>
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

<script>
    function showNoteForm(consultId) {
        document.getElementById('note-popup-' + consultId).style.display = 'block';
        document.getElementById('note-overlay-' + consultId).style.display = 'block';
        document.getElementById('note-popup-' + consultId).classList.add('fade-in');
    }

    function showNotePopup(consultId) {
        document.getElementById('note-popup-view-' + consultId).style.display = 'block';
        document.getElementById('note-overlay-' + consultId).style.display = 'block';
        document.getElementById('note-popup-view-' + consultId).classList.add('fade-in');
    }

    function closeNotePopup(consultId) {
        document.getElementById('note-popup-' + consultId).classList.remove('fade-in');
        document.getElementById('note-popup-view-' + consultId).classList.remove('fade-in');
        setTimeout(function() {
            document.getElementById('note-popup-' + consultId).style.display = 'none';
            document.getElementById('note-popup-view-' + consultId).style.display = 'none';
            document.getElementById('note-overlay-' + consultId).style.display = 'none';
        }, 300);
    }
</script>
