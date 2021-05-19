<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('zachislenie.html', function () {
    Reagordi::$app->context->setTitle('Зачисление');
    Reagordi::$app->context->setDescription('Зачисление');

    ob_start();
    ?>
    <div class="card-box table-responsive">
        Приказы о зачислении после 15 августа 2021 г.
    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});