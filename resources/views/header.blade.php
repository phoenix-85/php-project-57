<header>
    <nav>
        <div>
            <a href="/">
                Менеджер задач
            </a>
            <div>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Выход</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        Вход
                    </a>
                    <a href="{{ route('register') }}">
                        Регистрация
                    </a>
                @endauth
            </div>
            <div>
                <ul>
                    <li>
                        <a href="{{ route('tasks.index') }}">
                            Задачи
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('task_statuses.index') }}">
                            Статусы
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('labels.index') }}">
                            Метки
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
