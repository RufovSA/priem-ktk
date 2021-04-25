<?php
/**
 * Проветка "Общая информация"
 *
 * @package reagorid/education/priem
 * @author Sergej Rufov <support@freeun.ru>
 */

/** @var integer $verify */

use Reagordi\Education\Models\Entrant;

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
            'sex' => Reagordi::$app->context->request->getPost('sex'),
            'phone' => Reagordi::$app->context->request->getPost('phone'),
            'email' => Reagordi::$app->context->request->getPost('email'),
            'password' => $password,
            'entrant_status' => 0,
            'verify' => $verify,
        )
    );
    if ($user_id) {
        Reagordi::$app->context->session->set('user_id', $user_id);
    } else $error[] = 'Неизвестная ошибка';
}
