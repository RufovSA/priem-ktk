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
    'priem/entrant/{id:i}',
    function ($id) {
        Reagordi::getInstance()->getApplication()->dbInit();

        if (Reagordi::$app->context->request->cookie->get('verify_offline') != Reagordi::$app->config->get('education', 'priem', 'key')) {
            header('Location: /');
            exit();
        }

        if (is_file(DATA_DIR . '/education/reception/' . $id . '/' . Reagordi::$app->context->request->getQuery('file') . '.pdf')) {
            header("Content-type:application/pdf");
            echo file_get_contents(DATA_DIR . '/education/reception/' . $id . '/' . Reagordi::$app->context->request->getQuery('file') . '.pdf');
            exit;
        }

        $entrant = Entrant::get($id);

        if (!$entrant) {
            header('Location: /');
            exit();
        }

        Reagordi::$app->context->setTitle($entrant->last_name . ' ' . $entrant->first_name . ' ' . $entrant->middle_name);
        Reagordi::$app->context->setDescription($entrant->last_name . ' ' . $entrant->first_name . ' ' . $entrant->middle_name);

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

        foreach ($entrant as $key => $value) {
            $sessions->set($key, $value);
        }
        //$sessions->remove('school_subject');
        $_SESSION['school_subject'] = json_decode($entrant->school_subject, true);

        if (Reagordi::$app->context->request->getQuery('act') == 'entrant.pdf') {
            getEntrant($sessions);
            exit;
        }

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

            $user_id = Entrant::addEntrant($_POST, $entrant->id);

            // Старые
            $_count = Entrant::countSpecialization(1, $entrant->specialtie1, 0);
            $_type_certificate = 'copy';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($entrant->specialtie1 . $entrant->type_doc_edu) . '_' . $_type_certificate . '.tmp', $_count);

            $_count = Entrant::countSpecialization(1, $entrant->specialtie1, 1);
            $_type_certificate = 'origin';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($entrant->specialtie1 . $entrant->type_doc_edu) . '_' . $_type_certificate . '.tmp', $_count);

            $_count = Entrant::countSpecialization(2, $entrant->specialtie1, 0);
            $_type_certificate = 'copy';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($entrant->specialtie1 . $entrant->type_doc_edu) . '_' . $_type_certificate . '.tmp', $_count);

            $_count = Entrant::countSpecialization(2, $entrant->specialtie1, 1);
            $_type_certificate = 'origin';
            file_put_contents(DATA_DIR . '/education/rating/' . md5($entrant->specialtie1 . $entrant->type_doc_edu) . '_' . $_type_certificate . '.tmp', $_count);

            // Новые
            $_count = Entrant::countSpecialization(1, $_POST['specialtie1'], 0);
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

            Reagordi::$app->context->session->setFlash('finish', 1);
            header('Location: ' . HOME_URL . Reagordi::$app->context->server->getRequestUri());
            exit;
        }

        ob_start();
        ?>
        <?php if (Reagordi::$app->context->session->hasFlash('finish')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                Изменения успешно сохранены
            </div>
        <?php endif ?>
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
                    <li class="">
                        <a href="#v-panel6" data-toggle="tab" aria-expanded="true">6. Выбор специальности</a>
                    </li>
                    <li class="">
                        <a href="#v-panel7" data-toggle="tab" aria-expanded="true">7. Прочее</a>
                    </li>
                    <li class="">
                        <a href="#v-panel8" data-toggle="tab" aria-expanded="true">8. Заполнение заявления</a>
                    </li>
                    <li class="">
                        <a href="#v-panel9" data-toggle="tab" aria-expanded="true">9. Скан-копии документов</a>
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
                    <div class="tab-pane" id="v-panel6">
                        <?php require_once dirname(dirname(__DIR__)) . '/components/statement/templates/defalut/include/step_6.php'; ?>
                    </div>
                    <div class="tab-pane" id="v-panel7">
                        <?php require_once dirname(dirname(__DIR__)) . '/components/statement/templates/defalut/include/step_7.php'; ?>
                    </div>
                    <div class="tab-pane" id="v-panel8">
                        <div class="col-md-12 m-b-20">
                            <a href="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/entrant/<?= $id ?>?act=entrant.pdf"
                               target="_blank">
                                <span>Заявление поступающего</span>
                                <span>(1 Мб)</span>
                                <span style="float: right"><?= date('d.m.Y H:i') ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="v-panel9">
                        <?php if (is_file(DATA_DIR . '/education/reception/' . $id . '/application.pdf')): ?>
                        <div class="col-md-12 m-b-20">
                            <a href="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/entrant/<?= $id ?>?file=application#application.pdf"
                               target="_blank">
                                <span>Заявление поступающего</span>
                                <span>(1 Мб)</span>
                                <span style="float: right"><?= date('d.m.Y H:i') ?></span>
                            </a>
                        </div>
                        <?php endif ?>
                        <?php if (is_file(DATA_DIR . '/education/reception/' . $id . '/passport.pdf')): ?>
                        <div class="col-md-12 m-b-20">
                            <a href="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/entrant/<?= $id ?>?file=passport#passport.pdf"
                               target="_blank">
                                <span>Документ, удостоверяющий личность (паспорт)</span>
                                <span>(1 Мб)</span>
                                <span style="float: right"><?= date('d.m.Y H:i') ?></span>
                            </a>
                        </div>
                        <?php endif ?>
                        <?php if (is_file(DATA_DIR . '/education/reception/' . $id . '/certificate.pdf')): ?>
                        <div class="col-md-12 m-b-20">
                            <a href="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/entrant/<?= $id ?>?file=certificate#certificate.pdf"
                               target="_blank">
                                <span>Документ об образовании</span>
                                <span>(1 Мб)</span>
                                <span style="float: right"><?= date('d.m.Y H:i') ?></span>
                            </a>
                        </div>
                        <?php endif ?>
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