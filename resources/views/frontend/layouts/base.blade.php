<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/themes/base/base/theme.css') }}">

    <title>Website</title>
</head>

<body>
    <header class="page-header">
        <div class="page-limiter">
            <div class="header-logo">
                <a href="/" class="logo"></a>
            </div>
            <div class="header-menu">
                <a href="">Типажи</a>
                <a href="">Гардероб</a>
                <a href="">Статьи</a>
                <a href="">Форум</a>
            </div>
            <div class="header-userbar">
                <a href="" class="userbar-logo"></a>
            </div>
        </div>
    </header>
    <main class="page-content">
        @yield('content')
    </main>

    <footer class="page-footer">
        <div class="page-limiter">
            <div class="footer-left">
                <a href="/" class="footer-logo"></a>
                <div class="footer-social-links">
                    <a href="" class="social-link link-instagram">
                        <span class="link-icon"></span>
                    </a>
                    <a href="" class="social-link link-youtube">
                        <span class="link-icon"></span>
                    </a>
                </div>
            </div>
            <div class="footer-center">
                <div class="footer-menu">
                    <a href="">О проекте</a>
                    <a href="">Примерка</a>
                    <a href="">Онлайн-тест Кибби</a>
                    <a href="">Цветотип в 2 клика</a>
                </div>
                <div class="footer-menu">
                    <a href="">Описание типажей</a>
                    <a href="">Форум</a>
                    <a href="">Статьи</a>
                    <a href="">Гардеробная</a>
                </div>
            </div>
            <div class="footer-right">
                <div class="footer-feedback">
                    <p>Обратная связь</p>
                    <p>Здравствуйте! Подскажите, как я могу получить консультацию? есть номер?</p>
                    <form action="" method="post">
                        <input type="text" placeholder="example@mail.ru">
                        <button><div class="button-icon"></div></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="page-limiter">
                <div class="bottom-left">
                    <p>© 2021 Kibbe_russia. Все права защищены.</p>
                </div>
                <div class="bottom-right">
                    <a href="">Политика конфиденциальности</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/themes/base/base/main.js') }}"></script>
</body>

</html>