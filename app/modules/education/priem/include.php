<?php

use Reagordi\Framework\Loader;

Reagordi::$app->context->i18n->loadModuleLangFile(__DIR__ . '/pages/priem/statement.php');

Loader::registerNamespace('Reagordi\\Education', __DIR__ . '/src');

require __DIR__ . '/lib/ncl/NCLNameCaseRu.php';
