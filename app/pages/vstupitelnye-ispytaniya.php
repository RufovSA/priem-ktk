<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('vstupitelnye-ispytaniya.html', function () {
    Reagordi::$app->context->setTitle('Вступительные испытания');
    Reagordi::$app->context->setDescription('Вступительные испытания');

    ob_start();
    ?>
    <div class="card-box table-responsive">
        Прием абитуриентов производится на конкурсной основе только по результатам среднего балла аттестата
    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});