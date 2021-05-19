<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('', function () {
    Reagordi::$app->context->setTitle('Главная');
    Reagordi::$app->context->setDescription('Описание главной страницы');

    ob_start();
?>
    <div class="card-box table-responsive">
        <?php Reagordi::$app->context->components->includeComponent(
            'education:priem',
            'rating',
            'defalut',
            array(),
            false
        ); ?>
    </div>
<?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});