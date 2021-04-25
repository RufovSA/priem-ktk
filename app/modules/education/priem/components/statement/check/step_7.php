<?php
/**
 * Проветка "Прочее"
 *
 * @package reagorid/education/priem
 * @author Sergej Rufov <support@freeun.ru>
 */

/** @var integer $no_check */

if (!Reagordi::$app->context->request->getPost('checkbox_obsaga') &&
    !$no_check) {
    Reagordi::$app->context->session->remove('checkbox_obsaga');
}

if (!Reagordi::$app->context->request->getPost('checkbox_olimpiada') &&
    !$no_check) {
    Reagordi::$app->context->session->remove('checkbox_olimpiada');
}
