<?php
/**
 * Проветка "Адрес проживания"
 *
 * @package reagorid/education/priem
 * @author Sergej Rufov <support@freeun.ru>
 */

/** @var integer $no_check */

if (!Reagordi::$app->context->request->getPost('checkbox_addres_pass_noselect') &&
    !$no_check) {
    Reagordi::$app->context->session->remove('checkbox_addres_pass_noselect');
}

if (!Reagordi::$app->context->request->getPost('checkbox_addres_fact_noselect') &&
    !$no_check) {
    Reagordi::$app->context->session->remove('checkbox_addres_fact_noselect');
}

if (!Reagordi::$app->context->request->getPost('checkbox_addres_fact') &&
    !$no_check) {
    Reagordi::$app->context->session->remove('checkbox_addres_fact');
}
