<?php

/** @var Phroute\Phroute\RouteCollector $collector */

$collector->any('', function () {
    Reagordi::$app->context->setTitle(t('Reagordi - Admin Panel'));
    Reagordi::$app->context->setDescription(t('Reagordi - Admin Panel'));

    ob_start();
    ?>
    <a href="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/statement.html">Заявления абитуриентов</a>
    <?php
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    //throw new \Phroute\Phroute\Exception\HttpRouteNotFoundException();

    return Reagordi::$app->context->view->fech();
});
