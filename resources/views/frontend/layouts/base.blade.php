<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/themes/base/base/theme.css') }}">

    <title>Массажный салон</title>
</head>

<body>
    <div class="header-spacer"></div>
    <main class="page-content">
        @yield('content')
    </main>

    <header class="page-header">
        <div class="header-image">
            <img src="/images/default-banner.webp" alt="">
        </div>
        <div class="header-overflow">
            <div class="page-limiter">
                <div class="header-top">
                    <div class="header-social">
                        <a href="" class="link-item facebook"></a>
                        <a href="" class="link-item vkontakte"></a>
                        <a href="" class="link-item instagram"></a>
                    </div>
                    <div class="header-logo">
                        <a href="/" class="logo-image">Massage Parlor</a>
                    </div>
                    <div class="header-links">
                        <a href="" class="call-me-link">Обратный звонок</a>
                        <a href="" class="appointment-link">Записаться</a>
                    </div>
                </div>
                <div class="header-delim"></div>
                <div class="header-bottom">
                    <div class="header-menu">
                        <a href="">Главная</a>
                        <a href="">Услуги</a>
                        <a href="">Продукция</a>
                        <a href="">Доставка</a>
                        <a href="">Отзывы</a>
                        <a href="">Команда</a>
                        <a href="">Контакты</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <footer class="page-footer">
        <div class="page-limiter">
            <div class="footer-social">
                <a href="" class="link-item facebook"></a>
                <a href="" class="link-item vkontakte"></a>
                <a href="" class="link-item instagram"></a>
            </div>
            <div class="footer-menu">
                <a href="">Главная</a>
                <a href="">Услуги</a>
                <a href="">Продукция</a>
                <a href="">Доставка</a>
                <a href="">Отзывы</a>
                <a href="">Команда</a>
                <a href="">Контакты</a>
            </div>
            <div class="footer-agreement">
                <a href="">Пользовательское соглашение</a>
            </div>
            <p class="footer-copyrights">
                © 2022 MASSAGE PARLOR
            </p>
        </div>
    </footer>

    <script src="{{ asset('lib/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('js/themes/base/base/main.js') }}"></script>
</body>

</html>