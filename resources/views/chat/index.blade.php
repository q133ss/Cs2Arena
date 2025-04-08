@extends('layouts.app')
@section('title', 'Чат')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Список чатов -->
            <div class="col-md-4 border-end">
                <div class="d-flex flex-column p-3" style="height: 100vh;">
                    <h4 class="mb-4">Мои чаты</h4>

                    <div class="list-group overflow-auto flex-grow-1">
                        @foreach($chats as $item)
                            <a href="{{ route('chat.show', $item) }}"
                               class="list-group-item list-group-item-action {{ isset($chat) && $chat->id == $item->id ? 'active' : '' }}">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">
                                        @foreach($item->users() as $user)
                                            {{ $user->username }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </h5>
                                    <small>{{ $item->messages?->last()?->created_at?->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1 text-truncate">{{ $item->messages?->last()?->content }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Сообщения чата -->
            <div class="col-md-8">
                @isset($chat)
                    <div class="d-flex flex-column" style="height: 90vh;">
                        <!-- Заголовок чата -->
                        <div class="p-3 border-bottom">
                            <h4>
                                @foreach($chat->users() as $user)
                                    {{ $user->username }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </h4>
                        </div>

                        <!-- Сообщения -->
                        <div class="flex-grow-1 p-3 overflow-auto" id="messages-container">
                            @foreach($chat->messages as $message)
                                <div class="mb-3 {{ $message->user_id == auth()->id() ? 'text-end' : '' }}">
                                    <div class="d-flex {{ $message->user_id == auth()->id() ? 'justify-content-end' : '' }}">
                                        @if($message->user_id != auth()->id())
                                            <div class="me-2">
                                                <img src="https://ui-avatars.com/api/?name={{ $message->user?->username }}"
                                                     class="rounded-circle" width="40" alt="">
                                            </div>
                                        @endif
                                        <div>
                                            <div class="p-3 rounded">
                                                {{ $message->text }}
                                            </div>
                                            <small class="text-muted">
                                                {{ $message->created_at?->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Форма отправки -->
                        <div class="p-3 border-top">
                            <form action="{{ route('chat.message.store', $chat) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="content" id="msg" class="form-control" placeholder="Напишите сообщение...">
{{--                                    <button class="btn btn-primary" type="submit">Отправить</button>--}}
                                    <button class="btn btn-primary" onclick="sendMsg()" type="button">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                        <div class="text-center">
                            <h4>Выберите чат</h4>
                            <p class="text-muted">Выберите чат из списка слева или создайте новый</p>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(isset($chat))
    <script>
        // Автоскролл вниз при загрузке
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        });
        function createMessageElement(message) {
            const div = document.createElement('div');
            div.className = 'mb-3 ' + (message.user_id == {{ auth()->id() }} ? 'text-end' : '');

            const innerHTML = `
                <div class="d-flex ${message.user_id == {{ auth()->id() }} ? 'justify-content-end' : ''}">
                    ${message.user_id != {{ auth()->id() }} ? `
                        <div class="me-2">
                            <img src="https://ui-avatars.com/api/?name=${message.user.username}"
                                 class="rounded-circle" width="40" alt="">
                        </div>
                    ` : ''}
                    <div>
                        <div class="p-3 rounded">${message.text}</div>
                        <small class="text-muted">${message.created_at}</small>
                    </div>
                </div>
            `;

            div.innerHTML = innerHTML;
            return div;
        }

        function sendMsg(){
            const msg = document.getElementById('msg').value.trim();
            const messagesContainer = document.getElementById('messages-container');
            if (!msg) {
                alert('Введите текст сообщения'); // Проверяем, что поле не пустое
                return;
            }

            console.log(msg)
            let message = {
                text: msg, // Текст сообщения
                created_at: "только что", // Преобразуем дату в строку
                user_id: {{ auth()->id() }}, // ID текущего пользователя
                user: {
                    username: "{{ auth()->user()->username }}" // Имя пользователя
                }
            };

            msg.value = '';

            // Добавляем новое сообщение в DOM
            // TODO доделать!!!!
            const messageElement = createMessageElement(message);
            messagesContainer.appendChild(messageElement);

            // Прокручиваем чат вниз
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

        }
    </script>
    @endif
@endsection
