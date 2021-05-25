<?php
/**
 * Reagordi CMS Generator
 *
 * @package reagordi/cms
 * @subpackage generate-page
 * @copyright Reagordi (c) 2020
 * @create-date 01.02.2021 10:53:12
 */

use Reagordi\Education\Models\Entrant;

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->get('priem/lk.html', function () {
    Reagordi::getInstance()->getApplication()->dbInit();

    Reagordi::$app->context->setTitle('Личный кабинет');
    Reagordi::$app->context->setDescription('Личный кабинет');

    if (Reagordi::$app->context->request->get('logout') == '1') {
        Reagordi::$app->context->request->cookie->remove('phone');
        Reagordi::$app->context->request->cookie->remove('password');
    }

    if (!is_auth()) {
        header('Location: ' . HOME_URL . '/login.html');
        exit();
    }

    $user = is_auth();

    ob_start();
    ?>
    <div class="card-box table-responsive">
        <h1>Добро пожаловать, <?= $user->last_name ?> <?= $user->first_name ?> <?= $user->middle_name ?>!</h1>
        <h2>Статус заявки:
            <?php if ($user->entrant_status == '0'): ?>
                <span class="color-red">Заявление не заполенно</span>
            <?php elseif ($user->entrant_status == '1'): ?>
                <span class="color-red">Документы не загруженны</span>
            <?php elseif ($user->entrant_status == '2'): ?>
                <span class="color-red">На обработке</span>
            <?php elseif ($user->entrant_status == '3'): ?>
                <span class="color-red">На изменении</span>
            <?php elseif ($user->entrant_status == '4'): ?>
                <span style="color: green">Завершена</span>
            <?php endif ?>
        </h2>
        <?php if ($user->entrant_status == '3'): ?>
            <h3>Замечания</h3>
            <?php if ($user->comment_1): ?><p><b>Шаг 1.</b> <?= str_replace("\n", '<br />', $user->comment_1) ?></p><?php endif ?>
            <?php if ($user->comment_2): ?><p><b>Шаг 2.</b> <?= str_replace("\n", '<br />', $user->comment_2) ?></p><?php endif ?>
            <?php if ($user->comment_3): ?><p><b>Шаг 3.</b> <?= str_replace("\n", '<br />', $user->comment_3) ?></p><?php endif ?>
            <?php if ($user->comment_4): ?><p><b>Шаг 4.</b> <?= str_replace("\n", '<br />', $user->comment_4) ?></p><?php endif ?>
            <?php if ($user->comment_5): ?><p><b>Шаг 5.</b> <?= str_replace("\n", '<br />', $user->comment_5) ?></p><?php endif ?>
            <?php if ($user->comment_6): ?><p><b>Шаг 6.</b> <?= str_replace("\n", '<br />', $user->comment_6) ?></p><?php endif ?>
            <?php if ($user->comment_7): ?><p><b>Шаг 7.</b> <?= str_replace("\n", '<br />', $user->comment_7) ?></p><?php endif ?>
            <?php if ($user->comment_9): ?><p><b>Шаг 9.</b> <?= str_replace("\n", '<br />', $user->comment_9) ?></p><?php endif ?>
            <a href="<?= HOME_URL ?>/priem/statement.html">
                <button class="btn btn-success" style="margin-top:13px">Изменить заявление</button>
            </a>
        <?php endif ?>
    </div>
        <?php
        Reagordi::$app->context->view->assign('sitebar', true);
        Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

        return Reagordi::$app->context->view->fech();
    });
