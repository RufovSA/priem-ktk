<?php
/** @var $this Reagordi\Framework\Components */

/** @var $ar_params array */

use Reagordi\Education\Models\Entrant;

Reagordi::$app->applicaiton->dbInit();

Reagordi::$app->context->i18n->loadComponentLangFile(__FILE__);

$ar_params['page_url'] = isset($ar_params['page_url']) ? $ar_params['page_url'] : '/';

$act = (int)Reagordi::$app->context->request->getPost('act');
$act = $act ? $act : 1;

$error = array();

if (Reagordi::$app->context->request->getPost('update') == 1) {
    $act--;
}

if (Reagordi::$app->context->server->getRequestMethod() == 'POST') {
    $no_check = (int)Reagordi::$app->context->request->getPost('no_check');

    if ($act == 2) {
        if (Reagordi::$app->context->request->getPost('password') &&
            mb_strlen(Reagordi::$app->context->request->getPost('password')) <= 5) {
            $error[] = 'Пароль должен быть больше 6 символов';
        }

        if (Reagordi::$app->context->request->getPost('password') &&
            Reagordi::$app->context->request->getPost('password') !=
            Reagordi::$app->context->request->getPost('password2')) {
            $error[] = 'Введённые пароли не совподают';
        }

        if (Reagordi::$app->context->request->getPost('email') &&
            !Reagordi::$app->context->session->get('user_id')) {

            if (Entrant::isEmail(Reagordi::$app->context->request->getPost('email'))) {
                $error[] = 'Данный E-Mail уже зарегистрирован';
            }

            if (Entrant::isPhone(Reagordi::$app->context->request->getPost('phone'))) {
                $error[] =
                    'Данный номер телефона уже зарегистрирован уже зарегистрирован';
            }

            $password =
                Reagordi::$app->security->generatePasswordHash(
                    Reagordi::$app->context->request->getPost('password')
                );
            $user_id = Entrant::addEntrant(
                array(
                    'last_name' => Reagordi::$app->context->request->getPost('last_name'),
                    'first_name' => Reagordi::$app->context->request->getPost(
                        'first_name'
                    ),
                    'middle_name' => Reagordi::$app->context->request->getPost(
                        'middle_name'
                    ),
                    'place_birth' => Reagordi::$app->context->request->getPost(
                        'place_birth'
                    ),
                    'bdate' => Reagordi::$app->context->request->getPost('bdate'),
                    'citizenship' => Reagordi::$app->context->request->getPost(
                        'citizenship'
                    ),
                    'phone' => Reagordi::$app->context->request->getPost('phone'),
                    'email' => Reagordi::$app->context->request->getPost('email'),
                    'password' => $password,
                    'entrant_status' => 0
                )
            );
            if ($user_id) {
                Reagordi::$app->context->session->set('user_id', $user_id);
            } else $error[] = 'Неизвестная ошибка';
        }
    }

    foreach (Reagordi::$app->context->request->getPostList() as $key => $item) {
        Reagordi::$app->context->session->set($key, $item);
    }

    if ($act == 4 &&
        !Reagordi::$app->context->request->getPost('checkbox_addres_pass_noselect') &&
        !$no_check) {
        Reagordi::$app->context->session->remove('checkbox_addres_pass_noselect');
    }

    if ($act == 4 &&
        !Reagordi::$app->context->request->getPost('checkbox_addres_fact_noselect') &&
        !$no_check) {
        Reagordi::$app->context->session->remove('checkbox_addres_fact_noselect');
    }

    if ($act == 4 &&
        !Reagordi::$app->context->request->getPost('checkbox_addres_fact') &&
        !$no_check) {
        Reagordi::$app->context->session->remove('checkbox_addres_fact');
    }

    if ($act == 5 &&
        !Reagordi::$app->context->request->getPost('checkbox_obraz_one') &&
        !$no_check) {
        Reagordi::$app->context->session->remove('checkbox_obraz_one');
    }

    if ($act == 8 &&
        !Reagordi::$app->context->request->getPost('checkbox_obsaga') &&
        !$no_check) {
        Reagordi::$app->context->session->remove('checkbox_obsaga');
    }

    if ($act == 8 &&
        !Reagordi::$app->context->request->getPost('checkbox_olimpiada') &&
        !$no_check) {
        Reagordi::$app->context->session->remove('checkbox_olimpiada');
    }

    if ($error && !$no_check) {
        $act--;
    }

    if (!Reagordi::$app->context->request->isAjaxRequest()) {
        header('Location: ' . $ar_params['page_url'] . '?act=' . $act);
        exit;
    }
}

if ($act == 1 && Reagordi::$app->context->session->get('user_id')) {
    $act = 2;
}

$list_priem = [
    t('General information'),
    t('Passport data'),
    t('Residential address'),
    t('Education'),
    t('Parents'),
    t('Choosing a specialty'),
    t('Other'),
    'Заполнение заявления',
    t('Scanned copies of documents'),
    //t( 'Confirmation of data' )
];

if ($act > count($list_priem) || $act <= 0) {
    header('Location: ' . $ar_params['page_url']);
    exit();
}

$this->view->assign('error', $error);
$this->view->assign('act', $act);
$this->view->assign('list_priem', $list_priem);

$this->includeComponentTemplate();
