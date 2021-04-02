<?php

/** @var $this Reagordi\Framework\Components */
/** @var $ar_params array */

Reagordi::$app->context->i18n->loadComponentLangFile(__FILE__);

if (Reagordi::$app->config->get('reagordi', 'social', 'auth', 'social_auth') ===
  false) {
  return;
}

$this->includeComponentTemplate();
