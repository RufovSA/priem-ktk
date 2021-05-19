<?php
/**
 * Reagordi CMS Generator
 *
 * @package reagordi/cms
 * @subpackage generate-page
 * @copyright Reagordi (c) 2020
 * @create-date 01.02.2021 10:53:12
 */

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->get('priem/verify.html', function () {
    $key = Reagordi::$app->context->request->get('key');

    if ($key == Reagordi::$app->config->get('education', 'priem', 'key')) {
        Reagordi::$app->context->session->set('verify_offline', $key);
    }
    if (Reagordi::$app->context->request->get('act') == 'admin') {
        Reagordi::$app->context->request->cookie->add('verify_offline', $key);
        header('Location: ' . HOME_URL . '/' . Reagordi::$app->options->get('url', 'admin_path'));
        exit();
    }
    header('Location: ' . HOME_URL . '/priem/statement.html');
    exit();
});
