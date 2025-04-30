@extends('layouts.app')
@section('title', 'Заявки на вступление в клан')
@section('content')
    <div class="container">
        <h1 class="my-4">Заявки на вступление в клан "{{ $userClan->name }}"</h1>

        @if($applications->isEmpty())
            <div class="alert alert-info">
                Нет заявок на вступление.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Пользователь</th>
                        <th>Дата подачи</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        <tr id="application-row-{{ $application->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $application->user?->username }}</td>
                            <td>{{ $application->created_at?->format('d.m.Y H:i') }}</td>
                            <td id="status-{{ $application->id }}">
                                @switch($application->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">Ожидает</span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success">Принята</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">Отклонена</span>
                                        @break
                                @endswitch
                            </td>
                            <td id="actions-{{ $application->id }}">
                                @if($application->status === 'pending')
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success accept-application" data-application-id="{{ $application->id }}">Принять</button>
                                        <button type="button" class="btn btn-danger reject-application" data-application-id="{{ $application->id }}">Отклонить</button>
                                    </div>
                                @else
                                    <div class="btn-group" role="group">
                                        @if($application->status === 'rejected')
                                            <button type="button" class="btn btn-success accept-application" data-application-id="{{ $application->id }}">Принять</button>
                                        @elseif($application->status === 'approved')
                                            <button type="button" class="btn btn-danger reject-application" data-application-id="{{ $application->id }}">Отклонить</button>
                                        @endif
                                        <button type="button" class="btn btn-outline-danger delete-application" data-application-id="{{ $application->id }}">
                                            Удалить
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('clan.show', $userClan->id) }}" class="btn btn-primary mt-3">Назад к клану</a>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Обработка кнопки "Принять"
                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('accept-application')) {
                        const applicationId = event.target.getAttribute('data-application-id');
                        confirmAction(
                            'Подтвердите действие',
                            'Вы уверены, что хотите принять эту заявку?',
                            'success',
                            'Принять',
                            () => processApplication(applicationId, 'accept', event.target)
                        );
                    }
                });

                // Обработка кнопки "Отклонить"
                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('reject-application')) {
                        const applicationId = event.target.getAttribute('data-application-id');
                        confirmAction(
                            'Подтвердите действие',
                            'Вы уверены, что хотите отклонить эту заявку?',
                            'warning',
                            'Отклонить',
                            () => processApplication(applicationId, 'reject', event.target)
                        );
                    }
                });

                // Обработка кнопки "Удалить"
                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('delete-application') ||
                        event.target.closest('.delete-application')) {
                        const btn = event.target.classList.contains('delete-application') ?
                            event.target : event.target.closest('.delete-application');
                        const applicationId = btn.getAttribute('data-application-id');
                        confirmAction(
                            'Подтвердите удаление',
                            'Вы уверены, что хотите удалить эту заявку? Это действие нельзя отменить!',
                            'error',
                            'Удалить',
                            () => deleteApplication(applicationId, btn)
                        );
                    }
                });

                function confirmAction(title, text, icon, confirmButtonText, callback) {
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmButtonText,
                        cancelButtonText: 'Отмена'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            callback();
                        }
                    });
                }

                function processApplication(applicationId, action, btn) {
                    const originalText = btn.innerHTML;
                    const actionText = action === 'accept' ? 'Принятие...' : 'Отклонение...';

                    // Показываем индикатор загрузки
                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + actionText;

                    // Отправляем AJAX запрос
                    axios.post(`/clan/applications/${applicationId}/${action}`)
                        .then(response => {
                            // Обновляем статус
                            const statusCell = document.getElementById(`status-${applicationId}`);
                            if (action === 'accept') {
                                statusCell.innerHTML = '<span class="badge bg-success">Принята</span>';
                            } else {
                                statusCell.innerHTML = '<span class="badge bg-danger">Отклонена</span>';
                            }

                            // Обновляем кнопки действий
                            const actionsCell = document.getElementById(`actions-${applicationId}`);
                            let newActions = '';
                            if (action === 'accept') {
                                newActions = `
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-danger reject-application" data-application-id="${applicationId}">Отклонить</button>
                                        <button type="button" class="btn btn-outline-danger delete-application" data-application-id="${applicationId}">
                                            Удалить
                                        </button>
                                    </div>
                                `;
                            } else {
                                newActions = `
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success accept-application" data-application-id="${applicationId}">Принять</button>
                                        <button type="button" class="btn btn-outline-danger delete-application" data-application-id="${applicationId}">
                                            Удалить
                                        </button>
                                    </div>
                                `;
                            }
                            actionsCell.innerHTML = newActions;

                            // Показываем уведомление об успехе
                            showToast('success', response.data.message || 'Действие выполнено успешно');
                        })
                        .catch(error => {
                            // Восстанавливаем кнопку
                            btn.disabled = false;
                            btn.innerHTML = originalText;

                            // Показываем ошибку
                            const errorMsg = error.response?.data?.message || 'Произошла ошибка при обработке заявки';
                            showToast('error', errorMsg);
                        });
                }

                function deleteApplication(applicationId, btn) {
                    const originalHtml = btn.innerHTML;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                    btn.disabled = true;

                    axios.delete(`/clan/applications/${applicationId}`)
                        .then(response => {
                            // Удаляем строку из таблицы
                            document.getElementById(`application-row-${applicationId}`).remove();
                            showToast('success', response.data.message || 'Заявка удалена');
                        })
                        .catch(error => {
                            btn.innerHTML = originalHtml;
                            btn.disabled = false;
                            const errorMsg = error.response?.data?.message || 'Произошла ошибка при удалении заявки';
                            showToast('error', errorMsg);
                        });
                }
            });
        </script>
    @endsection
@endsection
