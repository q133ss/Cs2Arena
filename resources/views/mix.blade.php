@extends('layouts.app')
@section('title', 'Микс')
@section('content')
    <style>
        .form-select{
            --bs-form-select-bg-img: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e);
            display: block;
            width: 100%;
            padding: .375rem 2.25rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: right .75rem center;
            background-size: 16px 12px;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            transition: border-color .15sease-in-out, box-shadow .15sease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .card{
            background: #1a0e22;
            border: 1px solid rgb(255 192 16);
        }
    </style>
    <section id="home" style="margin-top: 130px;">
        <div class="container">
            <!-- Фильтры -->
            <div class="row mb-4 mt-5">
                <div class="col-md-6">
                    <label for="mapFilter" class="form-label">Фильтр по картам:</label>
                    <select id="mapFilter" class="form-select">
                        <option value="all">Все карты</option>
                        <option value="de_dust2">Dust II</option>
                        <option value="de_inferno">Inferno</option>
                        <option value="de_mirage">Mirage</option>
                        <!-- Добавьте другие карты -->
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="playerCountFilter" class="form-label">Фильтр по количеству игроков:</label>
                    <select id="playerCountFilter" class="form-select">
                        <option value="all">Все серверы</option>
                        <option value="5">5 игроков</option>
                        <option value="10">10 игроков</option>
                        <option value="20">20 игроков</option>
                        <!-- Добавьте другие варианты -->
                    </select>
                </div>
            </div>

            <!-- Таблица с серверами -->
            <div class="table-responsive">
                <table class="table table-striped" style="color: #FFFFFF">
                    <thead>
                    <tr>
                        <th>Имя сервера</th>
                        <th>Карта</th>
                        <th>Игроков</th>
                        <th>Время игры</th>
                        <th>Средний K/D</th>
                        <th>IP-адрес</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="serverList">
                    <!-- Данные о серверах будут загружены сюда -->
                    </tbody>
                </table>
            </div>

            <!-- Статистика игрока -->
            <h2 class="mt-5">Ваша статистика</h2>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">K/D</h5>
                            <p class="card-text" id="playerKD">1.25</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Время игры</h5>
                            <p class="card-text" id="playTime">120 часов</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ранг</h5>
                            <p class="card-text" id="playerRank">2500</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const servers = [
            { name: "Server 1", map: "de_dust2", players: 0, playTime: "45 мин", avgKD: 1.0, ip: "62.122.213.110:27015" },
            { name: "Server 2", map: "de_inferno", players: 0, playTime: "30 мин", avgKD: 1.0, ip: "62.122.213.111:27015" },
            { name: "Server 3", map: "de_mirage", players: 0, playTime: "60 мин", avgKD: 1.1, ip: "62.122.213.112:27015" },
            // Добавьте другие серверы
        ];

        // Функция для отображения серверов
        function displayServers(filteredServers) {
            const serverList = document.getElementById('serverList');
            serverList.innerHTML = '';
            filteredServers.forEach(server => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${server.name}</td>
                    <td>${server.map}</td>
                    <td>${server.players}</td>
                    <td>${server.playTime}</td>
                    <td>${server.avgKD}</td>
                    <td>${server.ip}</td>
                    <td>
                        <button class="btn-sm btn-info" style="background:#ffc010;border-color: #ffc010" onclick="connectToServer('${server.ip}')">Подключиться</button>
                    </td>
                `;
                serverList.appendChild(row);
            });
        }

        // Функция для подключения к серверу
        function connectToServer(ip) {
            const steamConnectUrl = `steam://connect/${ip}`;
            window.location.href = steamConnectUrl;
        }

        // Инициализация таблицы с серверами
        displayServers(servers);

        // Фильтрация серверов
        document.getElementById('mapFilter').addEventListener('change', function() {
            const map = this.value;
            const playerCount = document.getElementById('playerCountFilter').value;
            filterServers(map, playerCount);
        });

        document.getElementById('playerCountFilter').addEventListener('change', function() {
            const playerCount = this.value;
            const map = document.getElementById('mapFilter').value;
            filterServers(map, playerCount);
        });

        function filterServers(map, playerCount) {
            let filteredServers = servers;
            if (map !== 'all') {
                filteredServers = filteredServers.filter(server => server.map === map);
            }
            if (playerCount !== 'all') {
                filteredServers = filteredServers.filter(server => server.players == playerCount);
            }
            displayServers(filteredServers);
        }
    </script>
@endsection
