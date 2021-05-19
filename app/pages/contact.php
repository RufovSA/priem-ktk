<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('contact.html', function () {
    Reagordi::$app->context->setTitle('Контакты');
    Reagordi::$app->context->setDescription('Контакты');

    ob_start();
    ?>
    <div class="card-box table-responsive">
        <p><strong>Адрес:</strong> Грабцевское шоссе, дом 126&nbsp;Калуга&nbsp;Калужская область&nbsp;248009&nbsp;Россия</p>
        <p><strong>Секретарь приёмной комиссии</strong>: Михалева Снежана Александровна</p>
        <p><strong>E-mail:&nbsp;</strong><a href="mailto:priem.ktk@yandex.ru"></a><a href="mailto:priem.ktk@yandex.ru">priem.ktk@yandex.ru</a><br><strong>Телефон:&nbsp;</strong><a href="tel:4842521827">(4842) 52-17-03</a>,  &nbsp;<a href="tel:4842521834">(4842)52-18-34</a></p>
        <p><strong>Пн — Пят, 08.30 — 16.30</strong></p>
        <p><a rel="noreferrer noopener" href="http://www.ktk40.ru/" target="_blank">http://www.ktk40.ru</a></p>
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A3a521b07948c9bb78fdd8aa3e2436fbb86af1f7d60dd033f261f839003adb7b3&amp;source=constructor" width="100%" height="240" frameborder="0"></iframe>

    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});