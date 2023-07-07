<?php

return [

    'site_name' => 'Каталог сайтов Украины',

    'all_rights_reserved' => 'Все права защищены.',

    'hosting' => 'Хостинг сайта',

    'main_menu' => [
        'home' => 'Каталог',
        'terms' => 'Правила',
        'search' => 'Поиск',
        'hosting' => 'Хостинг',
        'add' => 'Добавить сайт',
    ],

    'btn' => [
        'create' => 'Создать',
        'delete' => 'Удалить',
        'delete_count' => 'Удалить %count%',
        'edit' => 'Изменить',
        'save' => 'Сохранить',
        'submit' => 'Отправить',
        'add' => 'Добавить',
        'search' => 'Поиск',
        'invoice' => 'Инвойс',
        'generate' => 'Генерировать',  
    ],

    'admin_postfix' => 'Админ',
   
    'admin' => [
        'menu' => [
            'admin' => 'Админ',
            'home' => 'Главная',
            'categories' => 'Категории',
            'errors' => 'Ошибки',
            'settings' => 'Настройки',
            'statistic' => 'Статистика'
        ],
        'label' => [
            'name_uk' => 'Название (Укр)',
            'name_ru' => 'Название (Рус)',
            'parent_id' => 'Parent Id',
            'order' => 'Порядок',
            'alias' => 'Алиас',       
        ]
    ],

    'label' => [
        'name' => 'Название сайта',
        'domain' => 'Домен',
        'email' => 'Емейл',
        'description' => 'Описание',
        'category' => 'Категория',
        'password' => 'Пароль',                   
    ],

    'help_text' => [
        'domain' => 'адрес главной страницы без https и www',
    ],

    'validator' => [
        'has_not_children' => 'Категория не выбрана.'
    ],

    'page' => [
        'home' => [
            'title' => 'Каталог сайтов Украины',
            'meta' => [
                'description' => 'Каталог сайтов Украины. Без обратной ссылки. Удобный поиск сайтов. Качественные и проверенные сайты. Добавить сайт.',
                'keywords' => 'каталог сайтов, без обратной ссылки, добавить сайт, каталог сайтов украина, каталог украинских сайтов',
            ],
            'partners' => 'Партнёры',
            'new_sites' => 'Новые сайты в каталоге',
            'why_register_title' => 'Зачем регистрировать сайт в каталоге сайтов',
            'why_register_text' => '
                <p>Регистрация вашего сайта в каталоге сайтов может быть полезной по нескольким причинам:</p>
                <ul>
                    <li><p>Повышение видимости: Регистрируя ваш сайт в каталоге сайтов, вы можете увеличить его видимость и достичь более широкой аудитории. Каталоги сайтов обычно организованы по теме или категориям, что позволяет пользователям, заинтересованным в определенной нише или теме, легко найти ваш сайт.</p></li>
                    <li><p>Улучшение SEO: Когда вы регистрируете ваш сайт в репутационном каталоге сайтов, это может улучшить ваши усилия по оптимизации для поисковых систем (SEO). Каталоги сайтов считаются надежными источниками информации, поэтому наличие вашего сайта в каталоге может помочь установить его в качестве авторитета в вашей нише.</p></li>
                    <li><p>Бэклинки: Многие каталоги сайтов позволяют вам включить бэклинк на ваш сайт. Бэклинки важны для SEO, так как они сигнализируют поисковым системам, что другие сайты доверяют вашему контенту и считают его ценным. Регистрируя ваш сайт в каталоге сайтов и включая бэклинк, вы можете улучшить его позиции в поисковых системах.</p></li>
                </ul>
                <p>В целом, регистрация вашего сайта в каталоге сайтов может быть полезным инструментом для повышения видимости, улучшения SEO и создания бэклинков. Однако важно выбирать репутационные каталоги сайтов и следовать их руководствам по регистрации, чтобы убедиться, что ваш сайт будет указан точно и этично.</p>
            ',
        ],
        'terms' => [
            'title' => 'Правила',
            'meta' => [
                'description' => 'Правила использования каталога сайтов. Требования к сайту. Каталог сайтов Украины.',
                'keywords' => 'каталог сайтов, каталог сайтов украина, продвижение сайтов, правила использования',
            ],
            'req_title' => 'Требования к веб-сайту',
            'req_li_1' => 'Email должен быть действительным.',
            'req_li_2' => 'Название сайта должно состоять из нескольких слов и соответствовать содержимому сайта.',
            'req_li_3' => 'URL адресом сайта должен быть домен 1-го или 2-го уровня, в международной или украинской доменной зоне.',
            'req_li_4' => 'Категория должна соответствовать содержимому сайта.',
            'req_li_5' => 'Краткое описание сайта должно состоять из нескольких предложений, связанных между собой по смыслу, которые дают представление о содержимом сайта.',
            'req_li_6' => 'Подробное описание сайта должно представлять подробную информацию о сайте. Текст подробного описания не должен быть продолжением краткого описания. Подробное описание можно указать и после добавления сайта в каталог, для этого нужно написать письмо на <a href="mailto:info@catalog.org.ua">info@catalog.org.ua</a>, в котором указать адрес сайта и текст описания.',
            'req_li_7' => 'Содержимое сайта не должно никаким образом нарушать законы Украины.',
            'add_title' => 'Добавление сайта в каталог',
            'add_li_1' => 'Размещение сайта в каталоге является платным и составляет %price% грн. Сайт размещается в каталоге сроком на 3 года.',
            'add_li_2' => 'Сайт будет рассмотрен и добавлен в каталог если он соответствует всем требованиям.',
            'add_li_3' => 'При добавлении сайта, информация о нём может быть изменена, для устранения грамматических ошибок, неправильных категорий, ошибок в URL-адресе и прочее.',
            'add_li_4' => 'Информация о сайте, который был добавлен в каталог, добавляется и на страницы каталога в <a href="https://www.facebook.com/sitescatalog">Facebook</a> и <a href="https://twitter.com/sitescatalog">Twitter</a>.',
        ],
        'search' => [
            'title' => 'Поиск',
            'meta' => [
                'description' => 'Поиск сайта в каталоге сайтов Украины. Найди сайт прямо сейчас.',
                'keywords' => 'поиск сайтов, каталог сайтов, каталог сайтов украина',
            ],
            'name_or_domain' => 'название или домен',
            'not_found' => 'Ничего не найдено. Измените условие поиска.'
        ],
        'submit' => [
            'title' => 'Добавление сайта',
            'meta' => [
                'description' => 'Добавить сайт в каталог. Без обратной ссылки. Каталог сайтов Украины.',
                'keywords' => 'добавить сайт, регистрация сайта, каталог сайтов, каталог сайтов украина',
            ],
            'payment_alert' => 'Добавление сайта в каталог является платным и составляет %price% гривен',
        ],
        'confirmation' => [
            'title' => 'Подтверджение запроса',
            'already_confirmed' => 'Неверный код подтверждения или запрос уже был подтверждён',
            'successfully_confirmed' => 'Запрос на добавление сайта в каталог успешно подтверждён.'
                . '<br>В течении ближайшего времени ваш сайт будет проверен '
                . '<br>и в случае успешной модерации вам будет отправлено письмо с реквизитами для оплаты.',
        ],
        'success' => [
            'title' => 'Запрос успешно отправлен',
            'text' => 'Запрос на добавление сайта в каталог успешно отправлен!'
            .'<br>На e-mail, указанный вами должно прийти письмо с ссылкой для подтверждения.'
            .'<br>Подтвердите запрос, перейдя по ссылке.'
            .'<br>Неподтверждённый длительное время запрос рассмотрен не будет  и будет удалён.',
        ],
        'admin' => [
            'home' => [
                'title' => 'Сайты',
            ],
            'categories' => [
                'title' => 'Категории',
            ],
            'categories_create' => [
                'title' => 'Создание категории',
                'list' => 'Категории',
            ],
            'categories_edit' => [
                'title' => 'Изменение категории',
                'list' => 'Категории',
            ],
            'statistic' => [
                'title' => 'Статистика',
            ],
            'settings' => [
                'title' => 'Настройки',
                'sitemap' => 'Sitemap',
                'creation_date' => 'Дата создания',
                'not_found' => 'не найдено',
                'link' => 'Ссылка',
            ],
            'login' => [
                'title' => 'Логин',
            ],
        ],
    ],

    'emails' => [
        'confirmation' => [
            'subject' => 'Подтверждение запроса',
            'title' => 'Подтверждение запроса',
            'text' => 'Для подтверждения запроса на добавление сайта в каталог, перейдите по ссылке ниже',
            'button' => 'Подтвердить запрос',
        ],
        'invoice' => [
            'subject' => 'Модерация прошла успешно',
            'title' => 'Модерация прошла успешно',
            'text' => 'Сайт <strong>%domain%</strong> успешно прошёл модерацию и готов к добавлению в каталог.'
                        . '<br>Для добавления сайта в каталог пополните на <b>%price% гривен</b> номер <span style="white-space: nowrap;"> <b>%phone%</b>.</span>'
                        . '<br>Обязательно подтвердите пополнение, ответив на это письмо, укажите время оплаты и url-адрес сайта.'
                        . '<br>Сайт будет добавлен в каталог в течении 3 рабочих дней после подтверждения оплаты.',
        ],
        'added' => [
            'subject' => 'Сайт добавлен в каталог',
            'title' => 'Сайт добавлен в каталог',
            'text' => 'Сайт успешно добавлен в Каталог сайтов Украины.',
        ],        
    ]

];