<?php

use RedBeanPHP\R;

$collector->get(
  'company',
  function () {
    $company = R::findAll(DB_PREF . 'company');

    return api_ok(null, $company);
  }
);
