<?php
/** @var $this Reagordi\Framework\Components */

/** @var $ar_params array */

Reagordi::$app->applicaiton->dbInit();

Reagordi::$app->context->i18n->loadComponentLangFile(__FILE__);

$specialties = Reagordi::$app->config->get('education', 'priem', 'specialties');

$this->view->assign('specialties', $specialties);

$this->includeComponentTemplate();
