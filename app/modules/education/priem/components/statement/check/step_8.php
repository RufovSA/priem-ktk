<?php
/**
 * Проветка "Заполнение заявления"
 *
 * @package reagorid/education/priem
 * @author Sergej Rufov <support@freeun.ru>
 */

use Reagordi\Education\Models\Entrant;

if (Reagordi::$app->context->session->get('finish')) return false;

$school_subject = Reagordi::$app->context->session->get('school_subject');
$user_id = Reagordi::$app->context->session->get('user_id');
$session = Reagordi::$app->context->session->getAll();
unset(
    $session['user_id'],
    $session['last_name'],
    $session['first_name'],
    $session['middle_name'],
    $session['sex'],
    $session['place_birth'],
    $session['bdate'],
    $session['citizenship'],
    $session['phone'],
    $session['email'],
    $session['password'],
    $session['password2'],
    $session['school_subject'],
    $session['act'],
    $session['sid']
);

$count = 0;
$sum = 0;
foreach ($school_subject as $v) {
    if ($v['estimation'] >= 3 && $v['estimation'] <= 5) {
        $count++;
        $sum += $v['estimation'];
    }
}
$session['entrant_status'] = 1;
$session['average_score'] = $sum / $count;
$session['school_subject'] = json_encode($school_subject);

if (!$user_id) {
    $error[] = 'Неизвестная ошибка';
    Reagordi::$app->context->session->destroy();
    return false;
}

$user_id = Entrant::addEntrant($session, $user_id);

Reagordi::$app->context->session->set('finish', 1);
