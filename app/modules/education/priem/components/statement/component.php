<?php
/** @var $this Reagordi\Framework\Components */

/** @var $ar_params array */

Reagordi::$app->applicaiton->dbInit();

Reagordi::$app->context->i18n->loadComponentLangFile(__FILE__);

$ar_params['page_url'] = isset($ar_params['page_url']) ? $ar_params['page_url'] : '/';

$verify = 0;
if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key')) $verify = 1;

$act = (int)Reagordi::$app->context->request->getPost('act');
$act = $act ? $act : 1;

$error = array();

if (Reagordi::$app->context->request->getPost('update') == 1) {
    $act--;
}

if ($act == 1 && Reagordi::$app->context->session->get('user_id')) {
    $act = 2;
}

if (Reagordi::$app->context->session->get('finish')) {
    $act = 9;
    require_once __DIR__ . '/check/step_9.php';
}

if (Reagordi::$app->context->server->getRequestMethod() == 'POST') {
    $no_check = (int)Reagordi::$app->context->request->getPost('no_check');

    $_act = $act - 1;
    if (is_file(__DIR__ . '/check/step_' . $_act . '.php')) {
        require_once __DIR__ . '/check/step_' . $_act . '.php';
    }
    unset($_act);

    foreach (Reagordi::$app->context->request->getPostList() as $key => $item) {
        Reagordi::$app->context->session->set($key, $item);
    }

    if ($error && !$no_check) {
        $act--;
    }

    if (!Reagordi::$app->context->request->isAjaxRequest()) {
        header('Location: ' . $ar_params['page_url'] . '?act=' . $act);
        exit;
    }
}

if (Reagordi::$app->context->session->get('finish') && $verify) {
    $key = null;
    if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key'))
        $key = Reagordi::$app->config->get('education', 'priem', 'key');
    Reagordi::$app->context->session->destroy();
    if ($key) Reagordi::$app->context->session->set('verify_offline', $key);
    header('Location: ' . HOME_URL . '/blank.html?code=2');
    exit();
}

$list_priem = [
    t('rg_ep_general_information'),
    t('rg_ep_passport_data'),
    t('rg_ep_residential_address'),
    t('rg_ep_education'),
    t('rg_ep_parents'),
    t('rg_ep_choosing_specialty'),
    t('rg_ep_other'),
    t('rg_ep_filling_application'),
];
if (!$verify) $list_priem[] = t('rg_ep_scanned_copies_of_documents');

if ($act > count($list_priem) || $act <= 0) {
    header('Location: ' . $ar_params['page_url']);
    exit();
}

$this->view->assign('verify', $verify);
$this->view->assign('error', $error);
$this->view->assign('act', $act);
$this->view->assign('list_priem', $list_priem);

$this->includeComponentTemplate();
