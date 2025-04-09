@extends('layouts.app')
@section('title', 'Битва кланов')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Битва кланов</h1>

        <!-- Основной контейнер -->
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
                                    <button class="btn btn-danger btn-sm">Выгнать</button>
                                </td>
                            </tr>
                            <!-- Добавьте больше строк по необходимости -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Блок 2: Пригласить игрока -->
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

                <!-- Блок 3: Статус текущего пользователя -->
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
            </div>

            <!-- Правая колонка (2 блока) -->
            <div class="col-md-4">
                <!-- Блок 4: Поиск клана -->
                <div class="card mb-4">
                    <div class="card-header">Поиск противника</div>
                    <div class="card-body text-center">
                        <select name="map" class="form-select mb-2" id="">
                            <option value="#">Выберите карту</option>
                            <option value="#">de_dust2</option>
                            <option value="#">de_mirage</option>
                            <option value="#">de_inferno</option>
                            <option value="#">cs_italy</option>
                        </select>
                        <button class="btn btn-primary w-100 mb-3" id="start-search-btn">Начать поиск</button>
                        <div id="search-timer" class="d-none">
                            <p>Поиск противника...</p>
                            <p><strong id="timer">00:00</strong></p>
                        </div>
                        <div id="found-clan-info" class="d-none">
                            <p>Найден клан:</p>
                            <p><strong id="clan-name">Название</strong>Клан 2</p>
                            <p><strong>Дивизион: </strong> A</p>
                            <p><strong>Средний рейтинг: </strong> 1.000</p>
                            <p><strong>Девиз: </strong> Тут будет девиз клана!</p>
                            <button type="button" onclick="window.location.href='steam://connect/37.230.228.9:27015'" class="btn btn-primary">Присоединиться к игре</button>
                        </div>
                    </div>
                </div>

                <!-- Блок 5: Общий чат -->
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
                <button class="btn btn-primary w-100">Начать групповой звонок</button>
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

            // Начать поиск
            startSearchBtn.addEventListener('click', function () {
                startSearchBtn.classList.add('d-none');
                searchTimer.classList.remove('d-none');

                let seconds = 0;
                timerInterval = setInterval(() => {
                    seconds++;
                    const minutes = Math.floor(seconds / 60);
                    const remainingSeconds = seconds % 60;
                    timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;

                    if (seconds >= 10) { // Пример: поиск завершается через 10 секунд
                        clearInterval(timerInterval);
                        searchTimer.classList.add('d-none');
                        foundClanInfo.classList.remove('d-none');
                    }
                }, 1000);
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
    </script>
@endsection
