<?php
/**
 * Reagordi CMS Generator
 *
 * @package reagordi/cms
 * @subpackage generate-page
 * @copyright Reagordi (c) 2020
 * @create-date 01.02.2021 10:53:12
 */

use Reagordi\Framework\Web\Asset;
use Reagordi\Education\Models\Entrant;

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any(
    'priem/entrant-new.html',
    function () {
        Reagordi::getInstance()->getApplication()->dbInit();

        if (Reagordi::$app->context->request->cookie->get('verify_offline') != Reagordi::$app->config->get('education', 'priem', 'key')) {
            header('Location: /');
            exit();
        }

        Reagordi::$app->context->setTitle('Новое заявление');
        Reagordi::$app->context->setDescription('Новое заявление');

        Asset::getInstance()->addCss(
            'https://snipp.ru/cdn/select2/4.0.13/dist/css/select2.min.css',
            100
        );
        Asset::getInstance()->addJs(
            'https://snipp.ru/cdn/select2/4.0.13/dist/js/select2.min.js',
            100
        );
        Asset::getInstance()->addJs(
            'https://snipp.ru/cdn/select2/4.0.13/dist/js/i18n/ru.js',
            100
        );
        $sessions = Reagordi::$app->context->session;
        $admin = true;
        $admin_new = true;

        if (Reagordi::$app->context->server->getRequestMethod() == 'POST') {
            $count = 0;
            $sum = 0;
            foreach ($_POST['school_subject'] as $v) {
                if ($v['estimation'] >= 3 && $v['estimation'] <= 5) {
                    $count++;
                    $sum += $v['estimation'];
                }
            }
            //$_POST['entrant_status'] = 1;
            $_POST['average_score'] = $sum / $count;
            $_POST['school_subject'] = json_encode($_POST['school_subject']);
            //$_POST['password'] = Reagordi::$app->security->generatePasswordHash('123456');

            $user_id = Entrant::addEntrant($_POST);

            // Новые
            /*$_count = Entrant::countSpecialization(1, $_POST['specialtie1'], 0);
            $_type_certificate = 'copy';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($_POST['specialtie1'] . '1') . '_' . $_type_certificate . '.tmp', $_count);

            $_count = Entrant::countSpecialization(1, $_POST['specialtie1'], 1);
            $_type_certificate = 'origin';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($_POST['specialtie1'] . '1') . '_' . $_type_certificate . '.tmp', $_count);

            $_count = Entrant::countSpecialization(2, $_POST['specialtie1'], 0);
            $_type_certificate = 'copy';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($_POST['specialtie1'] . '2') . '_' . $_type_certificate . '.tmp', $_count);

            $_count = Entrant::countSpecialization(2, $_POST['specialtie1'], 1);
            $_type_certificate = 'origin';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($_POST['specialtie1'] . '2') . '_' . $_type_certificate . '.tmp', $_count);

            Reagordi::$app->context->session->setFlash('finish', 1);*/
            header('Location: ' . HOME_URL . '/' . Reagordi::$app->options->get('url', 'admin_path') . '/priem/entrant/' . $user_id . '#v-panel6');
            exit;
        }

        ob_start();
        ?>
        <form method="post">
            <div class="tabs-vertical-env">
                <ul class="nav tabs-vertical">
                    <li class="active">
                        <a href="#v-panel1" data-toggle="tab" aria-expanded="false">1. Общая информация</a>
                    </li>
                    <li class="">
                        <a href="#v-panel2" data-toggle="tab" aria-expanded="false">2. Паспортные данные</a>
                    </li>
                    <li class="">
                        <a href="#v-panel3" data-toggle="tab" aria-expanded="false">3. Адрес проживания</a>
                    </li>
                    <li class="">
                        <a href="#v-panel4" data-toggle="tab" aria-expanded="true">4. Образование</a>
                    </li>
                    <li class="">
                        <a href="#v-panel5" data-toggle="tab" aria-expanded="true">5. Родители</a>
                    </li>
                </ul>

                <div class="tab-content" style="width:100%">
                    <div class="tab-pane active" id="v-panel1">
                        <?php require_once dirname(dirname(__DIR__)) . '/components/statement/templates/defalut/include/step_1.php'; ?>
                    </div>
                    <div class="tab-pane" id="v-panel2">
                        <?php require_once dirname(dirname(__DIR__)) . '/components/statement/templates/defalut/include/step_2.php'; ?>
                    </div>
                    <div class="tab-pane" id="v-panel3">
                        <?php require_once dirname(dirname(__DIR__)) . '/components/statement/templates/defalut/include/step_3.php'; ?>
                    </div>
                    <div class="tab-pane" id="v-panel4">
                        <?php require_once dirname(dirname(__DIR__)) . '/components/statement/templates/defalut/include/step_4.php'; ?>
                    </div>
                    <div class="tab-pane" id="v-panel5">
                        <?php require_once dirname(dirname(__DIR__)) . '/components/statement/templates/defalut/include/step_5.php'; ?>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button id="ep_but_next" class="ladda-button btn btn-default" data-style="expand-right">Сохранить
                </button>
            </div>
        </form>
        <?php
        $key = null;
        if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key'))
            $key = Reagordi::$app->config->get('education', 'priem', 'key');
        $sessions->destroy();
        if ($key) Reagordi::$app->context->session->set('verify_offline', $key);
        Reagordi::$app->context->view->assign('conteiner', ob_get_clean());


        return Reagordi::$app->context->view->fech();
    });