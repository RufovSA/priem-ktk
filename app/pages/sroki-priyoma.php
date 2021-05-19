<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('sroki-priyoma.html', function () {
    Reagordi::$app->context->setTitle('Сроки приёма');
    Reagordi::$app->context->setDescription('Сроки приёма');

    ob_start();
    ?>
    <div class="card-box table-responsive">
        <p>Приём заявлений на очную форму осуществляется</p>

        <p>с <strong>01 июня по 15 августа 2021 г.</strong></p>

        <p>&nbsp;Приём заявлений на заочную форму осуществляется</p>

        <p>с <strong>01 июня по 01 октября 2021 г.</strong></p>

        <p>&nbsp;При наличии свободных мест приём документов продлевается</p>
    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});