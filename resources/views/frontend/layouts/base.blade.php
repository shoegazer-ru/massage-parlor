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

    <button class="basket-shortcut">
        <div class="shortcut-icon"></div>
        <p class="shortcut-count"></p>
    </button>

    <div class="basket-popup">
        <div class="popup-scroller">
            <div class="popup-container">
                <div class="popup-content">
                    <p class="popup-header">Ваш Заказ:</p>
                    <form action="">
                        <div class="basket-delim"></div>
                        <div class="basket-items"></div>
                        <div class="basket-delim"></div>
                        <div class="popup-body">
                            <p>Ознакомитесь с условиями на странице доставки и оплаты или свяжитесь с нами любым из способов на странице контактной информации</p>
                        </div>
                        <div class="basket-form">
                            <div class="form-field">
                                <label for="" class="field-label">Ваше имя</label>
                                <div class="field-control">
                                    <input type="text" placeholder="Иван Иванов"/>
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="" class="field-label">Телефон для связи</label>
                                <div class="field-control">
                                    <input type="text" placeholder="+7 999 999 99 99"/>
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="" class="field-label">E-mail</label>
                                <p class="field-note">Заполните, если хотите получить информацию о заказе</p>
                                <div class="field-control">
                                    <input type="text" placeholder="ivan@example.ru"/>
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="" class="field-label">Способ доставки</label>
                                <div class="field-control">
                                    <div class="checkput-item">
                                        <input type="radio" name="delivery-type" id="delivery-item-1">
                                        <label for="delivery-item-1">Курьером по Екатеринбургу</label>
                                    </div>
                                    <div class="checkput-item">
                                        <input type="radio" name="delivery-type" id="delivery-item-2">
                                        <label for="delivery-item-2">Самовывоз</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="" class="field-label">Комментарий</label>
                                <div class="field-control">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="Адрес доставки или пожелания к заказу"></textarea>
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="field-control">
                                    <button>Оформить заказ</button>
                                </div>
                            </div>
                        </div>
                        <div class="popup-body">
                            <p>Нажимая на кнопку, вы даете согласие на обработку своих персональных данных. Пользовательское соглашение</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <button class="popup-close-button">&#215;</button>
    </div>

    <script src="{{ asset('lib/jquery/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('js/themes/base/base/main.js') }}"></script>
</body>

</html>