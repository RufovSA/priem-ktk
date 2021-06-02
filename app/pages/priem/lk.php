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
use RedBeanPHP\R;

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
            <?php if ($user->comment_1): ?><p><b>Шаг 1.</b> <?= str_replace("\n", '<br />', $user->comment_1) ?>
                </p><?php endif ?>
            <?php if ($user->comment_2): ?><p><b>Шаг 2.</b> <?= str_replace("\n", '<br />', $user->comment_2) ?>
                </p><?php endif ?>
            <?php if ($user->comment_3): ?><p><b>Шаг 3.</b> <?= str_replace("\n", '<br />', $user->comment_3) ?>
                </p><?php endif ?>
            <?php if ($user->comment_4): ?><p><b>Шаг 4.</b> <?= str_replace("\n", '<br />', $user->comment_4) ?>
                </p><?php endif ?>
            <?php if ($user->comment_5): ?><p><b>Шаг 5.</b> <?= str_replace("\n", '<br />', $user->comment_5) ?>
                </p><?php endif ?>
            <?php if ($user->comment_6): ?><p><b>Шаг 6.</b> <?= str_replace("\n", '<br />', $user->comment_6) ?>
                </p><?php endif ?>
            <?php if ($user->comment_7): ?><p><b>Шаг 7.</b> <?= str_replace("\n", '<br />', $user->comment_7) ?>
                </p><?php endif ?>
            <?php if ($user->comment_9): ?><p><b>Шаг 9.</b> <?= str_replace("\n", '<br />', $user->comment_9) ?>
                </p><?php endif ?>
            <a href="<?= HOME_URL ?>/priem/statement.html">
                <button class="btn btn-success" style="margin-top:13px">Изменить заявление</button>
            </a>
        <?php endif ?>
        <?php if ($user->entrant_status == '4'): ?>
            <?php
            $place_1 = null;
            $place_2 = null;
            $place_3 = null;

            $file = DATA_DIR . '/education/specialties/' . md5($user->specialtie1 . $user->type_doc_edu) . '.tmp';
            if (is_file($file)) {
                $file = json_decode(file_get_contents($file), true);
                if (is_array($file)) {
                    $i = 1;
                    foreach ($file as $f) {
                        if ($user->type_certificate == '1' && $f['id'] == $user->id) {
                            $place_1 = $i;
                            break;
                        } elseif ($f['average_score'] <= $user->average_score) {
                            $place_1 = $i;
                            break;
                        }
                        $i++;
                    }
                }
            }

            if ($user->specialtie2 != '' && $user->specialtie2 != 'Выбор специальности') {
                $file = DATA_DIR . '/education/specialties/' . md5($user->specialtie2 . $user->type_doc_edu) . '.tmp';
                if (is_file($file)) {
                    $file = json_decode(file_get_contents($file), true);
                    if (is_array($file)) {
                        $i = 1;
                        foreach ($file as $f) {
                            if ($f['average_score'] <= $user->average_score) {
                                $place_2 = $i;
                                break;
                            }
                            $i++;
                        }
                    }
                }
            }

            if ($user->specialtie3 != '' && $user->specialtie3 != 'Выбор специальности') {
                $file = DATA_DIR . '/education/specialties/' . md5($user->specialtie3 . $user->type_doc_edu) . '.tmp';
                if (is_file($file)) {
                    $file = json_decode(file_get_contents($file), true);
                    if (is_array($file)) {
                        $i = 1;
                        foreach ($file as $f) {
                            if ($f['average_score'] <= $user->average_score) {
                                $place_3 = $i;
                                break;
                            }
                            $i++;
                        }
                    }
                }
            }

            $c_1 = null;
            $c_2 = null;
            $c_3 = null;

            foreach (Reagordi::$app->config->get('education', 'priem', 'specialties') as $faculty) {
                foreach ($faculty['value'] as $specialization) {
                    if ($user->type_doc_edu == $specialization['class'] && $user->specialtie1 == $specialization['name']) {
                        $c_1 = $specialization['count'];
                    }
                    if ($user->type_doc_edu == $specialization['class'] && $user->specialtie2 == $specialization['name']) {
                        $c_2 = $specialization['count'];
                    }
                    if ($user->type_doc_edu == $specialization['class'] && $user->specialtie3 == $specialization['name']) {
                        $c_3 = $specialization['count'];
                    }
                }
            }
            ?>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Место в рейтинге</th>
                    <th class="text-center">Бюджетных мест</th>
                    <th class="text-center">ФИО</th>
                    <th class="text-center">Специальность</th>
                    <th class="text-center">Средний балл</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center"><?= $place_1 ?></td>
                    <td class="text-center"><?= $c_1 ?></td>
                    <td><?= $user->last_name ?> <?= $user->first_name ?> <?= $user->middle_name ?></td>
                    <td><?= $user->specialtie1 ?></td>
                    <td class="text-center"><?= $user->average_score ?></td>
                </tr>
                <?php if (($user->specialtie2 != '' && $user->specialtie2 != 'Выбор специальности') || ($user->specialtie3 != '' && $user->specialtie3 != 'Выбор специальности')): ?>
                <tr>
                    <th colspan="4">Дополнительные специальности</th>
                </tr>
                <?php endif ?>
                <?php if ($user->specialtie2 != '' && $user->specialtie2 != 'Выбор специальности'): ?>
                <tr>
                    <td class="text-center"><?= $place_2 ?></td>
                    <td class="text-center"><?= $c_2 ?></td>
                    <td><?= $user->last_name ?> <?= $user->first_name ?> <?= $user->middle_name ?></td>
                    <td><?= $user->specialtie2 ?></td>
                    <td class="text-center"><?= $user->average_score ?></td>
                </tr>
                <?php endif ?>
                <?php if ($user->specialtie3 != '' && $user->specialtie3 != 'Выбор специальности'): ?>
                <tr>
                    <td class="text-center"><?= $place_3 ?></td>
                    <td class="text-center"><?= $c_3 ?></td>
                    <td><?= $user->last_name ?> <?= $user->first_name ?> <?= $user->middle_name ?></td>
                    <td><?= $user->specialtie3 ?></td>
                    <td class="text-center"><?= $user->average_score ?></td>
                </tr>
                <?php endif ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});
