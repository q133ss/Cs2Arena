@extends('layouts.app')
@section('title', 'Битва кланов')
@section('content')
    @if(!auth()->check())
        <div class="alert alert-primary mt-5" role="alert">
            Войдите в систему, что бы принять участие в битве кланов
        </div>
    @else
    <div class="container mt-5">
        <h1 class="text-center mb-4">Битва кланов</h1>

        <!-- Основной контейнер -->
        @php
            $clan = auth()->user()->clan()->first();
            $accessRoles = ['leader', 'deputy'];
            $isLeader = in_array($clan?->pivot?->role, $accessRoles);
            // if isLeader, то показываем кнопку "Начать битву"
            // иначе показываем "клан еще не начал битву.."
            // Так же надо планировать битву!! Типо "Битва будет в 20:00" (start_time, end_time)
            // А снизу история битв

            $opponent = $clanWar->clan1_id == $clan->id ? $clanWar->clan2 : $clanWar->clan1;
        @endphp
        <div class="row">
            <!-- Левая колонка (3 блока) -->
            <div class="col-md-8">
                <!-- Блок 1: Таблица приглашенных игроков -->
                <div class="card mb-4">
                    <div class="card-header">Приглашенные игроки</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Имя игрока</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody id="invited-players-table">
                            <!-- Пример строки -->
                            <tr>
                                <td>1</td>
                                <td>Player1</td>
                                <td><span class="badge bg-warning">Ожидание</span></td>
                                <td>
                                    @if($isLeader)
                                    <button class="btn btn-danger btn-sm">Выгнать</button>
                                    @endif
                                </td>
                            </tr>
                            <!-- Добавьте больше строк по необходимости -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Блок 2: Пригласить игрока -->
                @if($isLeader)
                <div class="card mb-4">
                    <div class="card-header">Пригласить игрока</div>
                    <div class="card-body">
                        <select class="form-select mb-3" id="clan-members-select">
                            <option value="">Выберите игрока</option>
                            <option value="Player2">Игрок2</option>
                            <option value="Player3">Игрок3</option>
                            <option value="Player4">Игрок4</option>
                            <option value="Player5">Игрок5</option>
                        </select>
                        <button class="btn btn-primary w-100" id="invite-player-btn">Пригласить</button>
                    </div>
                </div>
                @endif

                <!-- Блок 3: Статус текущего пользователя -->
                <div class="card">
                    <div class="card-header">Общий чат</div>
                    <div class="card-body">
                        <div class="chat-messages mb-3" style="max-height: 200px; overflow-y: auto;">
                            <!-- Пример сообщений -->
                            <p><strong>Игрок1:</strong> Готов к бою!</p>
                            <p><strong>Игрок2:</strong> Ждем еще одного.</p>
                            <p><strong>Игрок2:</strong> Давайте даст</p>
                            <p><strong>Игрок2:</strong> Я пойду на Б!</p>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Введите сообщение..." id="chat-input">
                            <button class="btn btn-primary" id="send-chat-btn">Отправить</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Правая колонка (2 блока) -->
            <div class="col-md-4">
                <!-- Блок 4: Поиск клана -->
                <div class="card mb-4">
                    <div class="card-header">Соперник</div>
                    <div class="card-body text-center">
                        <div id="found-clan-info">
                            <p><strong id="clan-name">Название: </strong><a href="{{route('clan.show', $opponent->id)}}">{{$opponent->name}}</a></p>
                            <p><strong>Дивизион: </strong> {{$opponent->division}}</p>
                            <p><strong>Рейтинг: </strong> {{$opponent->minimal_rating}}</p>
                            <p><strong>Девиз: </strong> {{$opponent->motto}}</p>
                            @php
                                $startsInOneMinuteOrLess = !$clanWar->start_time->isPast()
                                    && $clanWar->start_time->diffInMinutes(now(), false) >= -1;
                            @endphp

                            @if($startsInOneMinuteOrLess)
                                <button type="button" onclick="window.location.href='steam://connect/{{$clanWar->server?->ip_address}}'" class="btn btn-primary">
                                    Присоединиться к игре
                                </button>
                            @else
                                <div class="alert alert-primary">
                                    @if($clanWar->start_time->isPast())
                                        <span>Матч уже начался</span>
                                    @else
                                        <span>Присоединиться можно будет за минуту до начала ({{ $clanWar->start_time->diffForHumans() }})</span>
                                        <div class="mt-2">
                                            До начала:
                                            <span id="countdown-{{ $clanWar->id }}" class="fw-bold">
                                                {{ gmdate('H:i:s', max(0, $clanWar->start_time->diffInSeconds(now()))) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Блок 5: Общий чат -->
                <div class="card">
                    <div class="card-header">Мой статус</div>
                    <div class="card-body text-center">

                        <div id="ready" style="display: none">
                            <p><strong class="text-success">Вы готовы к игре</strong></p>
                            <button class="btn btn-link text-danger" onclick="ready(false)">Не готов</button>
                        </div>

                        <div id="not-ready">
                            <p><strong class="text-danger">Вы не готовы к игре</strong></p>
                            <button class="btn btn-success" onclick="ready(true)" id="ready-btn">Готов</button>
                        </div>
                    </div>
                </div>
{{--                <button class="btn btn-primary w-100">Начать групповой звонок</button>--}}
            </div>
        </div>
    </div>

    <!-- Подключение Bootstrap JS и Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript для интерактивности
        document.addEventListener('DOMContentLoaded', function () {
            const invitedPlayersTable = document.getElementById('invited-players-table');
            const clanMembersSelect = document.getElementById('clan-members-select');
            const invitePlayerBtn = document.getElementById('invite-player-btn');
            const startSearchBtn = document.getElementById('start-search-btn');
            const searchTimer = document.getElementById('search-timer');
            const timerDisplay = document.getElementById('timer');
            const foundClanInfo = document.getElementById('found-clan-info');
            const chatInput = document.getElementById('chat-input');
            const sendChatBtn = document.getElementById('send-chat-btn');
            const chatMessages = document.querySelector('.chat-messages');

            let timerInterval;

            // Пригласить игрока
            invitePlayerBtn.addEventListener('click', function () {
                const selectedPlayer = clanMembersSelect.value;
                if (!selectedPlayer) return;

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
          <td>${invitedPlayersTable.children.length + 1}</td>
          <td>${selectedPlayer}</td>
          <td><span class="badge bg-warning">Ожидание</span></td>
          <td><button class="btn btn-danger btn-sm">Выгнать</button></td>
        `;
                invitedPlayersTable.appendChild(newRow);
                clanMembersSelect.value = '';
            });

            // Отправить сообщение в чат
            sendChatBtn.addEventListener('click', function () {
                const message = chatInput.value.trim();
                if (!message) return;

                const newMessage = document.createElement('p');
                newMessage.innerHTML = `<strong>Вы:</strong> ${message}`;
                chatMessages.appendChild(newMessage);
                chatMessages.scrollTop = chatMessages.scrollHeight; // Прокрутка вниз
                chatInput.value = '';
            });
        });

        function ready(status){
            const ready = document.getElementById('ready');
            const notReady = document.getElementById('not-ready');

            if(status){
                ready.style.display = 'block';
                notReady.style.display = 'none';
            }else{
                ready.style.display = 'none';
                notReady.style.display = 'block';
            }
        }

        function updateCountdowns() {
            document.querySelectorAll('[id^="countdown-"]').forEach(element => {
                const matchId = element.id.split('-')[1];
                const endTime = new Date('{{ $clanWar->start_time->toIso8601String() }}').getTime();
                const now = new Date().getTime();
                let totalSeconds = Math.floor((endTime - now) / 1000);

                if (totalSeconds <= 0) {
                    element.textContent = "00:00:00";
                    window.location.reload(); // Перезагружаем страницу по окончании таймера
                    return;
                }

                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                element.textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            });
        }

        // Запускаем сразу и затем каждую секунду
        updateCountdowns();
        setInterval(updateCountdowns, 1000);
    </script>
    @endif
@endsection
