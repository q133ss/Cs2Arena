@extends('layouts.app')
@section('title', 'Битва кланов')
@section('content')
    <style>
        .card{
            background: #1a0e22;
            border: 1px solid #ffc010;
        }
    </style>
    <div class="container" style="margin-top: 130px">
        <!-- Информация о клане -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Название клана: <strong>ClanName</strong></h5>
                <p class="card-text">Рейтинг: <span class="badge bg-success">1000</span></p>
                <p class="card-text">Дивизион: <span class="badge bg-primary">D</span></p>
                <p class="card-text">Участников: <span class="badge bg-secondary">6</span></p>
                <p class="card-text">Статус: <span id="clanStatus" class="badge bg-secondary">Не готов к битве</span></p>
            </div>
        </div>

        <!-- Выбор карт -->
        <div class="mb-4">
            <h3>Выбор карт</h3>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="de_dust2" id="dust2">
                <label class="form-check-label" for="dust2">Dust II</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="de_inferno" id="inferno">
                <label class="form-check-label" for="inferno">Inferno</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="de_mirage" id="mirage">
                <label class="form-check-label" for="mirage">Mirage</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="de_nuke" id="nuke">
                <label class="form-check-label" for="nuke">Nuke</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="de_overpass" id="overpass">
                <label class="form-check-label" for="overpass">Overpass</label>
            </div>
        </div>

        <!-- Выбор участников -->
        <div class="mb-4">
            <h3>Выбор участников</h3>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="player1" id="player1">
                <label class="form-check-label" for="player1">Игрок 1</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="player2" id="player2">
                <label class="form-check-label" for="player2">Игрок 2</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="player3" id="player3">
                <label class="form-check-label" for="player3">Игрок 3</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="player4" id="player4">
                <label class="form-check-label" for="player4">Игрок 4</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="player5" id="player5">
                <label class="form-check-label" for="player5">Игрок 5</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="player6" id="player6">
                <label class="form-check-label" for="player6">Игрок 6</label>
            </div>
        </div>

        <!-- Кнопка "Начать поиск" -->
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" id="startSearchButton">Начать поиск</button>
        </div>
    </div>

    <script>
        // Обработчик кнопки "Начать поиск"
        document.getElementById('startSearchButton').addEventListener('click', function() {
            // Проверка выбора карт
            const selectedMaps = Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
                .filter(checkbox => checkbox.value.startsWith('de_'))
                .map(checkbox => checkbox.value);

            if (selectedMaps.length === 0) {
                alert("Выберите хотя бы одну карту!");
                return;
            }

            // Проверка выбора участников
            const selectedPlayers = Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
                .filter(checkbox => checkbox.value.startsWith('player'))
                .map(checkbox => checkbox.value);

            if (selectedPlayers.length !== 5) {
                alert("Выберите ровно 5 участников!");
                return;
            }

            // Меняем статус клана
            const clanStatus = document.getElementById('clanStatus');
            clanStatus.textContent = "Готов к битве";
            clanStatus.className = "badge bg-success";

            this.textContent = "Отменить поиск";
            this.classList.add('btn-danger');
            this.classList.remove('btn-primary');
            alert("Поиск начат! Статус клана изменен на 'Готов к битве'.");
        });
    </script>
@endsection
