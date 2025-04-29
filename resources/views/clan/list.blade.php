@extends('layouts.app')
@section('title', 'Список кланов')
@section('meta')
    <style>
        .member-item:hover {
            background-color: #1d1d36;
        }
        .member-item{
            cursor: pointer
        }
    </style>
@endsection
@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Список кланов</h1>

        <div class="row">
            @foreach($clans as $clan)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center">
                            @if($clan->avatar_url)
                                <img src="{{ $clan->avatar_url }}" alt="Аватар клана" class="rounded-circle me-3" width="50" height="50">
                            @endif
                            <h5 class="mb-0">{{ $clan->name }}</h5>
                        </div>

                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Девиз:</strong>
                                <p class="mb-0">{{ $clan->motto ?? 'Не указан' }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Описание:</strong>
                                <p class="mb-0">{{ $clan->description ?? 'Не указано' }}</p>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <strong>Рейтинг:</strong>
                                        <span class="badge bg-primary">{{ $clan->points }}</span>
                                    </div>

                                    <div class="mb-2">
                                        <strong>Дивизион:</strong>
                                        <span class="badge bg-secondary">{{ $clan->division }}</span>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-2">
                                        <strong>Участников:</strong>
                                        <span class="badge bg-info">{{ $clan->members->count() }}</span>
                                    </div>

                                    <div class="mb-2">
                                        <strong>Создан:</strong>
                                        <span>{{ $clan->created_at->format('d.m.Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent">
                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#membersModal{{ $clan->id }}">
                                Участники
                            </button>

                            @if($hasClan)
                                <button class="btn btn-sm btn-success" disabled data-toggle="tooltip" data-placement="top" title="Вы уже состоите в клане" data-clan-id="{{ $clan->id }}">
                                    Подать заявку
                                </button>
                            @else
                                @if($clan->application_status === 'pending')
                                    <button class="btn btn-sm btn-warning application-sent" data-clan-id="{{ $clan->id }}" disabled>
                                        Заявка на рассмотрении
                                    </button>
                                @elseif($clan->application_status === 'rejected')
                                    <button class="btn btn-sm btn-danger application-rejected" data-clan-id="{{ $clan->id }}"
                                            title="Ваша заявка была отклонена" disabled>
                                        Заявка отклонена
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-success apply-btn" data-clan-id="{{ $clan->id }}">
                                        Подать заявку
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal with members list -->
                <div class="modal fade" id="membersModal{{ $clan->id }}" tabindex="-1" aria-labelledby="membersModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="membersModalLabel">Участники клана {{ $clan->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if($clan->members->count() > 0)
                                    <ul class="list-group">
                                        @foreach($clan->members as $member)
                                            <li class="list-group-item d-flex align-items-center member-item" onclick="location.href='{{route('profile.show', $member->id)}}'">
                                                <img src="{{ $member->avatar_url ?? substr($member->username,0,2)}}"
                                                     class="rounded-circle me-3"
                                                     width="40"
                                                     height="40"
                                                     alt="{{ $member->username }}">
                                                <div>
                                                    <h6 class="mb-0">{{ $member->username }}</h6>
                                                    <small class="text-muted">Рейтинг MIX: {{ $member->rank_mix ?? 'N/A' }}</small>
                                                    <small class="text-muted">Рейтинг CW: {{ $member->rank_cw ?? 'N/A' }}</small>
                                                </div>
                                                @if($clan->leader_id == $member->id)
                                                    <span class="badge bg-warning ms-auto">Лидер</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-info">В клане пока нет участников</div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $clans->links() }}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Обработчик для всех кнопок подачи заявки
            document.querySelectorAll('.apply-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const clanId = this.getAttribute('data-clan-id');
                    const btn = this;

                    // Блокируем кнопку
                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Отправка...';

                    // Отправляем AJAX запрос
                    axios.post(`/clans/${clanId}/apply`, {
                        _token: document.querySelector('meta[name="csrf-token"]').content
                    })
                        .then(response => {
                            // Успешная отправка
                            showToast('success', response.data.message);

                            // Меняем кнопку на "Заявка отправлена"
                            btn.innerHTML = 'Заявка отправлена';
                            btn.classList.remove('btn-success');
                            btn.classList.add('btn-secondary');
                        })
                        .catch(error => {
                            // Ошибка
                            if (error.response) {
                                showToast('error', error.response.data.message);
                            } else {
                                showToast('error', 'Произошла ошибка при отправке заявки');
                            }

                            // Разблокируем кнопку
                            btn.disabled = false;
                            btn.innerHTML = 'Подать заявку';
                        });
                });
            });

            // Функция для показа toast-уведомлений
            function showToast(type, message) {
                const toastContainer = document.getElementById('toast-container');

                // Создаем toast
                const toastEl = document.createElement('div');
                toastEl.className = `toast align-items-center text-white bg-${type} border-0 show`;
                toastEl.setAttribute('role', 'alert');
                toastEl.setAttribute('aria-live', 'assertive');
                toastEl.setAttribute('aria-atomic', 'true');

                toastEl.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            `;

                // Добавляем в контейнер
                toastContainer.appendChild(toastEl);

                // Удаляем через 5 секунд
                setTimeout(() => {
                    toastEl.remove();
                }, 5000);
            }
        });
    </script>
@endsection
