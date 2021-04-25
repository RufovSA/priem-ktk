<?php

/** @var $collector Phroute\Phroute\RouteCollector */

use Reagordi\Framework\Config\Config;
use Reagordi\Framework\Web\View;

$collector->any(
    'blank.html',
    function () {
        Reagordi::$app->context->setTitle('Ошибка');
        Reagordi::$app->context->setDescription('Внутренняя ошибка');
        Reagordi::$app->context->setRobots('noindex,nofollow');

        ob_start();

        $type = 0;
        $msg = 'Неизвестная ошибка';

        switch (Reagordi::$app->context->request->get('code')) {
            case '1':
                $type = 3;
                $msg = 'Заявление успешно отправлено на обработку';
                break;
            default:

        }
        ?>
        <div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="false"
             data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="false"
             data-timer="null" style="display: block; margin-top: -189px;">

            <?php if ($type == 0): ?>
                <?php Reagordi::$app->context->setTitle('Ошибка'); ?>
            <div class="icon error animateErrorIcon" style="display: block;"><span class="x-mark"><span class="line left"></span><span
                            class="line right"></span></span></div>
                <h2>Ошибка</h2>
            <?php elseif ($type == 1): ?>
                <?php Reagordi::$app->context->setTitle('Предупреждение'); ?>
            <div class="icon warning" style="display: block;"><span class="body"></span> <span class="dot"></span></div>
                <h2>Предупреждение</h2>
            <?php elseif ($type == 2): ?>
                <?php Reagordi::$app->context->setTitle('Информация'); ?>
            <div class="icon info animate" style="display: block;"></div>
                <h2>Информация</h2>
            <?php elseif ($type == 3): ?>
            <?php Reagordi::$app->context->setTitle('Успех'); ?>
            <div class="icon success animate" style="display: block;"><span class="line tip animateSuccessTip"></span>
                <span class="line long animateSuccessLong"></span>
                <div class="placeholder"></div>
                <div class="fix"></div>
            </div>
            <br />
            <?php endif ?>
            <p class="lead text-muted" style="display: block;"><?= $msg ?></p>
            <p>
                <a href="<?= HOME_URL ?>">
                    <button class="confirm btn btn-lg btn-primary" tabindex="1" style="display: inline-block;">На главную</button>
                </a>
            </p>
        </div>
        <?php if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key')): ?>
            <meta http-equiv="refresh" content="3; URL=<?= HOME_URL ?>/priem/statement.html" />
        <?php endif; ?>
        <?php

        View::getInstance()->assign('conteiner', ob_get_clean());

        return View::getInstance()->fech();
    }
);
