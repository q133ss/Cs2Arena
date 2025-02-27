@extends('layouts.app')
@section('title', 'Профиль')
@section('content')
    <style>
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .social-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        .badge-custom {
            font-size: 14px;
            margin-right: 5px;
        }

        .card{
            background: #1a0e22;
            border: 1px solid #ffc010;
        }

        .list-group-item{
            background: #1a0e22;
        }
    </style>
    <div class="container" style="margin-top: 130px;">
        <h1 class="text-center">Личный кабинет</h1>

        <!-- Личные данные -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Личные данные</h3>
                <div class="text-center">
                    <img src="{{auth()->user()->avatar_url}}" alt="Фото профиля" class="profile-picture" id="profilePicture">
                    <input type="file" id="uploadPhoto" class="form-control mt-3" style="width: 200px; margin: 0 auto;">
                </div>
                <div class="mt-3">
                    <label for="steamId" class="form-label">Steam ID</label>
                    <input type="text" class="form-control" id="steamId" value="STEAM_0:1:510235008" readonly>
                </div>
                <div class="mt-3">
                    <label for="steamId" class="form-label">Логин</label>
                    <input type="text" class="form-control" id="steamId" value="lexa36rus4" readonly>
                </div>
                <div class="mt-3">
                    <label for="steamId" class="form-label">Email</label>
                    <input type="text" class="form-control" id="steamId" value="blockstar2k@gmail.com" readonly>
                </div>
                <div class="mt-3">
                    <label class="form-label">Социальные сети</label>
                    <div>
                        <i class="fab fa-vk"></i>
                        <i class="fab fa-telegram"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Клан -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Клан</h3>
                <div id="clanInfo">
                    <p>Вы не состоите в клане.</p>
                    <button class="btn btn-success" id="createClanButton">Создать клан</button>
                    <button class="btn btn-primary" id="joinClanButton">Вступить в клан</button>
                </div>
            </div>
        </div>

        <!-- Друзья и подписки -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Друзья и подписки</h3>
                <div id="friendsList">
                    <p>У вас пока нет друзей.</p>
                    <button class="btn btn-primary">Добавить друга</button>
                </div>
            </div>
        </div>

        <!-- История -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>История</h3>
                <ul class="list-group">
                    <li class="list-group-item">Участие в клановых войнах: 10</li>
                    <li class="list-group-item">Поданные заявки в кланы: 2</li>
                    <li class="list-group-item">История игр: 50 матчей</li>
                </ul>
            </div>
        </div>

        <!-- Избранное -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Избранное</h3>
                <div>
                    <p>Любимые серверы: <span class="badge bg-secondary">3</span></p>
                    <p>Любимые кланы/игроки: <span class="badge bg-secondary">5</span></p>
                </div>
            </div>
        </div>

        <!-- Награды и достижения -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Награды и достижения</h3>
                <div>
                    <span class="badge bg-success badge-custom">MIX: Победитель</span>
                    <span class="badge bg-warning badge-custom">CW: Лучший игрок</span>
                    <span class="badge bg-info badge-custom">Турниры: 1 место</span>
                </div>
            </div>
        </div>

        <!-- Развернутая статистика -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Развернутая статистика</h3>
                <div class="mb-3">
                    <label for="modeSelect" class="form-label">Режим</label>
                    <select class="form-select" id="modeSelect">
                        <option value="1x1">1x1</option>
                        <option value="2x2">2x2</option>
                        <option value="5x5">5x5</option>
                    </select>
                </div>
                <p>Ранг: <span class="badge bg-primary">1500</span></p>
                <p>Место в топе: <span class="badge bg-success">25</span></p>
            </div>
        </div>
    </div>

    <script>
        // Изменение фото профиля
        document.getElementById('uploadPhoto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePicture').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Создание клана
        document.getElementById('createClanButton').addEventListener('click', function() {
            const clanName = prompt("Введите название клана:");
            if (clanName) {
                document.getElementById('clanInfo').innerHTML = `
                    <p>Ваш клан: <strong>${clanName}</strong></p>
                    <button class="btn btn-danger" id="leaveClanButton">Выйти из клана</button>
                `;
            }
        });

        // Вступление в клан
        document.getElementById('joinClanButton').addEventListener('click', function() {
            const clanName = prompt("Введите название клана для вступления:");
            if (clanName) {
                document.getElementById('clanInfo').innerHTML = `
                    <p>Вы вступили в клан: <strong>${clanName}</strong></p>
                    <button class="btn btn-danger" id="leaveClanButton">Выйти из клана</button>
                `;
            }
        });

        // Выход из клана
        document.addEventListener('click', function(event) {
            if (event.target.id === 'leaveClanButton') {
                document.getElementById('clanInfo').innerHTML = `
                    <p>Вы не состоите в клане.</p>
                    <button class="btn btn-success" id="createClanButton">Создать клан</button>
                    <button class="btn btn-primary" id="joinClanButton">Вступить в клан</button>
                `;
            }
        });

        // Отправка обращения в поддержку
        document.getElementById('supportForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const message = document.getElementById('supportMessage').value;
            alert("Ваше сообщение отправлено: " + message);
            document.getElementById('supportMessage').value = '';
        });
    </script>
@endsection
