<?php
/**
 * Проветка "Образование"
 *
 * @package reagorid/education/priem
 * @author Sergej Rufov <support@freeun.ru>
 */

/** @var integer $no_check */

if (!Reagordi::$app->context->request->getPost('checkbox_obraz_one') &&
    !$no_check) {
    Reagordi::$app->context->session->remove('checkbox_obraz_one');
}