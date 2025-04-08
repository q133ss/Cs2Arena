@extends('layouts.app')
@section('title', 'Главная')
@section('meta')
    <style>
        .image-bg {
            background-image: url('/assets/images/cs2-bg.png');
            background-size: cover;
            background-position: center;
            color: white;
            height: 300px;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-5">
        <div class="card image-bg">
            <div class="d-flex align-items-center h-100">
                <div class="card-body text-center">
                    <h1>CS2 Arena — твой путь к профессионализму</h1>
                    <p class="h4">
                        Соревнуйся, побеждай, прокачивай скилл. Получай признание и открой двери в мир киберспорта.
                    </p>
                    <a href="#" class="btn btn-primary btn-lg">Начать играть</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <h2 class="text-center fw-bold">Ближайший турнир</h2>
        <span class="text-center text-muted">Участвуй в еженедельных турнирах с денежными призами и рейтингом</span>
        @include('includes.tournamentGrid')
    </div>

    <div class="row mt-5">
        <!-- Заголовок и описание -->
        <div class="text-center">
            <h2 class="fw-bold">Новый путь в PRO</h2>
            <p class="text-muted">CS2 Arena — это не просто матчмейкинг, а система для роста.</p>
        </div>

        <div class="services-statistics">

        <div class="row text-center">
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="counter-status">
                            <div class="counter-icon bg-primary-gradient box-shadow-primary">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <h4 class="mb-2 fw-semibold">Честный рейтинг</h4>
                            <p>Только ручная проверка игроков</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="counter-status">
                            <div class="counter-icon bg-secondary-gradient box-shadow-secondary">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                            </div>
                            <h4 class="mb-2 fw-semibold">Призы</h4>
                            <p>Лучшие команды получают призы</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="counter-statuss">
                            <div class="counter-icon bg-success-gradient box-shadow-success">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                            </div>
                            <h4 class="mb-2 fw-semibold">Аналитика игры</h4>
                            <p>Разбор карт, стратегий и персональных stats</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="counter-status">
                            <div class="counter-icon bg-danger-gradient box-shadow-danger">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <h4 class="mb-2 fw-semibold">Комьюнити</h4>
                            <p>Играй с равными по уровню, находи команду</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>

        <!-- Кнопка "Как это работает?" -->
        <div class="text-center mt-4">
            <a href="#" class="btn btn-primary">Как это работает? →</a>
        </div>
    </div>

    <div class="row mt-5 mb-lg-6">

        <div class="text-center">
            <h2 class="fw-bold">FAQ</h2>
            <p class="text-muted">Частые вопросы</p>
        </div>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button active" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Как попасть в закрытую лигу?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                    <div class="accordion-body">
                        Набери 2500+ рейтинга или выиграй квалификацию.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button active collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Какой античит используется?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                    <div class="accordion-body">
                        VAC + наш собственный детектор читов с ручной модерацией
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button active collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Можно ли играть с командой?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
                    <div class="accordion-body">
                        Да, есть отдельные турниры для команд и соло-рейтинг
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Как выводятся призы?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Через PayPal, крипту или стим-скины (по выбору).
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
