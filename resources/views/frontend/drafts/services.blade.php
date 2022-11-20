@extends('frontend.layouts.base')

@section('content')
    <div class="page-menu">
        <div class="page-limiter">
            <a href="" class="active">Массаж</a>
            <a href="">Аппаратные методики</a>
            <a href="">Косметология</a>
            <a href="">Hydrafacial</a>
            <a href="">Другие процедуры</a>
            <a href="">Комплексные программы</a>
        </div>
    </div>

    <div class="page-gallery-background">
        <div class="page-limiter">
            <div class="page-services-list">
                <div class="services-item">
                    <a href="" data-id="1">
                        <span class="service-container">
                            <span class="service-caption">Фирменный массаж 90 мин.</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="" data-id="2">
                        <span class="service-container">
                            <span class="service-caption">Тибетская поющая чаша</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="" data-id="3">
                        <span class="service-container">
                            <span class="service-caption">Массаж спортивный (интенсивный) 60мин.</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="" data-id="4">
                        <span class="service-container">
                            <span class="service-caption">Массаж антицелюллитный (бедра, ягодицы живот, бока) 60 мин.</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="">
                        <span class="service-container">
                            <span class="service-caption">Тибетская поющая чаша</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="">
                        <span class="service-container">
                            <span class="service-caption">Массаж спортивный (интенсивный) 60мин.</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="">
                        <span class="service-container">
                            <span class="service-caption">Массаж антицелюллитный (бедра, ягодицы живот, бока) 60 мин.</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="">
                        <span class="service-container">
                            <span class="service-caption">Тибетская поющая чаша</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="">
                        <span class="service-container">
                            <span class="service-caption">Массаж спортивный (интенсивный) 60мин.</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
                <div class="services-item">
                    <a href="">
                        <span class="service-container">
                            <span class="service-caption">Массаж антицелюллитный (бедра, ягодицы живот, бока) 60 мин.</span>
                            <span class="service-info">
                                <span class="info-price">4 500 руб</span>
                                <span class="info-delim">&#183;</span>
                                <span class="info-duration">110 мин</span>
                            </span>
                            <span class="service-button">Подробнее</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="services-popup-list">
        <div class="service-popup" data-id="1">
            <div class="popup-scroller">
                <div class="popup-container">
                    <div class="popup-content">
                        <p class="popup-header">Фирменный массаж 90 мин.</p>
                        <div class="popup-body">
                            <p>Наш фирменный массаж начинается с приятного бонуса (подготовительного этапа) - Кедровой бочки. Именно в комплексе эффект от этих двух процедур будет максимально достигнут. Это уникальный метод оздоровления организма, который снимает усталость, заряжает организм энергией и омолаживает не только тело, но и душу. Длительность подготовительного этапа- 10 минут. Авторская методика массажа COSMOSPA направлена на релаксацию и седативный эффект нервной системы, гармонизацию внутренних процессов в теле. Массаж выполняется с использованием комбинации лучших элементов балийской, тайской и испанской техник с глубокой проработкой мышц спины ладонями и предплечьями. Большое внимание уделяется стопам, ладоням, шейно-воротниковой зоне, голове, поскольку в этих зонах много биологически активных, значимых точек.</p>
                        </div>
                        <p class="service-info">
                            <span class="info-price">4 500 руб</span>
                            <span class="info-delim">&#183;</span>
                            <span class="info-duration">110 мин</span>
                        </p>
                        <a href="" class="popup-button" target="_blank">Записаться</a>
                    </div>
                </div>
            </div>
            <button class="popup-close-button">&#215;</button>
        </div>
        <div class="service-popup" data-id="2">
            <div class="popup-scroller">
                <div class="popup-container">
                    <div class="popup-content">
                        <p class="popup-header">Тибетская поющая чаша</p>
                        <div class="popup-body">
                            <p>Поющие чаши известны нам также под названием музыкальных, звуковых. Их, в отличие от привычных чаш, не используют для еды или хранения каких-либо предметов. Их главное предназначение – создание особых полей энергии, которая заполняет все пространство положительными вибрациями. Считается, что такие чаши пришли из Индии, а затем распространившись по всему Востоку. Встречаются индийские, непальские, китайские, японские, бутанские и даже тайские чаши. Сейчас большинство из них изготавливается в районе Гималаев – это тибетские чаши. Говорят, именно им принадлежат чистейшие звуки. Изначально это был исключительно ритуальный предмет, восходивший к древней религии Тибета бон. Его изготавливали собственноручно, потому что такое изделие обладает большим энергетическим потенциалом и целительными свойствами. В чем польза: Еще первые последователи буддийской философии заметили, какое благотворное влияние оказывают на человека звуки, издаваемые чашами: они восстанавливают кровообращение, нормализуют давление и улучшают иммунитет, стимулируют мозговую деятельность, избавляют от плохой энергетики и внутренних переживаний. Современные реалии готовят для нас много стрессовых ловушек, сопровождаемых негативными вибрациями: от транспорта, электричества, электроприборов, криков, посторонних шумов. При такой деструктивной энергии нам на помощь может прийти наследие тибетцев – поющие чаши, которые своей мелодией способны быстро привести организм в состояние равновесия. Успокоение, релаксация: Они помогают успокоиться, расслабиться, настроиться на благоприятный лад, особенно людям с беспокойным сном, бессонницей, неустойчивой психикой, нервным истощением. Лечение: Было замечено, что при регулярной работе с чашами людям удавалось избавиться от многих недугов: хронических головных болей, желудочных заболеваний, постоянных стрессов, периодических депрессий. Данная услуга является дополнительной.</p>
                            <p>Поющие чаши известны нам также под названием музыкальных, звуковых. Их, в отличие от привычных чаш, не используют для еды или хранения каких-либо предметов. Их главное предназначение – создание особых полей энергии, которая заполняет все пространство положительными вибрациями. Считается, что такие чаши пришли из Индии, а затем распространившись по всему Востоку. Встречаются индийские, непальские, китайские, японские, бутанские и даже тайские чаши. Сейчас большинство из них изготавливается в районе Гималаев – это тибетские чаши. Говорят, именно им принадлежат чистейшие звуки. Изначально это был исключительно ритуальный предмет, восходивший к древней религии Тибета бон. Его изготавливали собственноручно, потому что такое изделие обладает большим энергетическим потенциалом и целительными свойствами. В чем польза: Еще первые последователи буддийской философии заметили, какое благотворное влияние оказывают на человека звуки, издаваемые чашами: они восстанавливают кровообращение, нормализуют давление и улучшают иммунитет, стимулируют мозговую деятельность, избавляют от плохой энергетики и внутренних переживаний. Современные реалии готовят для нас много стрессовых ловушек, сопровождаемых негативными вибрациями: от транспорта, электричества, электроприборов, криков, посторонних шумов. При такой деструктивной энергии нам на помощь может прийти наследие тибетцев – поющие чаши, которые своей мелодией способны быстро привести организм в состояние равновесия. Успокоение, релаксация: Они помогают успокоиться, расслабиться, настроиться на благоприятный лад, особенно людям с беспокойным сном, бессонницей, неустойчивой психикой, нервным истощением. Лечение: Было замечено, что при регулярной работе с чашами людям удавалось избавиться от многих недугов: хронических головных болей, желудочных заболеваний, постоянных стрессов, периодических депрессий. Данная услуга является дополнительной.</p>
                        </div>
                        <p class="service-info">
                            <span class="info-price">4 500 руб</span>
                            <span class="info-delim">&#183;</span>
                            <span class="info-duration">110 мин</span>
                        </p>
                        <a href="" class="popup-button" target="_blank">Записаться</a>
                    </div>
                </div>
            </div>
            <button class="popup-close-button">&#215;</button>
        </div>
        <div class="service-popup" data-id="3">
            <div class="popup-scroller">
                <div class="popup-container">
                    <div class="popup-content">
                        <p class="popup-header">Фирменный массаж 90 мин.</p>
                        <div class="popup-body">
                            <p>Наш фирменный массаж начинается с приятного бонуса (подготовительного этапа) - Кедровой бочки. Именно в комплексе эффект от этих двух процедур будет максимально достигнут. Это уникальный метод оздоровления организма, который снимает усталость, заряжает организм энергией и омолаживает не только тело, но и душу. Длительность подготовительного этапа- 10 минут. Авторская методика массажа COSMOSPA направлена на релаксацию и седативный эффект нервной системы, гармонизацию внутренних процессов в теле. Массаж выполняется с использованием комбинации лучших элементов балийской, тайской и испанской техник с глубокой проработкой мышц спины ладонями и предплечьями. Большое внимание уделяется стопам, ладоням, шейно-воротниковой зоне, голове, поскольку в этих зонах много биологически активных, значимых точек.</p>
                        </div>
                        <p class="service-info">
                            <span class="info-price">4 500 руб</span>
                            <span class="info-delim">&#183;</span>
                            <span class="info-duration">110 мин</span>
                        </p>
                        <a href="" class="popup-button" target="_blank">Записаться</a>
                    </div>
                </div>
            </div>
            <button class="popup-close-button">&#215;</button>
        </div>
        <div class="service-popup" data-id="4">
            <div class="popup-container">
                <div class="popup-content">
                    <p class="popup-header">Массаж антицелюллитный (бедра, ягодицы живот, бока) 60 мин.</p>
                    <div class="popup-body">
                        <p>Наш фирменный массаж начинается с приятного бонуса (подготовительного этапа) - Кедровой бочки. Именно в комплексе эффект от этих двух процедур будет максимально достигнут. Это уникальный метод оздоровления организма, который снимает усталость, заряжает организм энергией и омолаживает не только тело, но и душу. Длительность подготовительного этапа- 10 минут. Авторская методика массажа COSMOSPA направлена на релаксацию и седативный эффект нервной системы, гармонизацию внутренних процессов в теле. Массаж выполняется с использованием комбинации лучших элементов балийской, тайской и испанской техник с глубокой проработкой мышц спины ладонями и предплечьями. Большое внимание уделяется стопам, ладоням, шейно-воротниковой зоне, голове, поскольку в этих зонах много биологически активных, значимых точек.</p>
                    </div>
                    <p class="service-info">
                        <span class="info-price">4 500 руб</span>
                        <span class="info-delim">&#183;</span>
                        <span class="info-duration">110 мин</span>
                    </p>
                    <a href="" class="popup-button" target="_blank">Записаться</a>
                </div>
            </div>
            <button class="popup-close-button">&#215;</button>
        </div>
    </div>
@endsection