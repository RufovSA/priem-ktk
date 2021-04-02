<?php

use RedBeanPHP\R;

$collector->get(
  'company/{id}',
  function ($id) {
    $company = R::load(DB_PREF . 'company', $id);
    if ($company->id == 0) {
      return api_error(
        ['code' => 404, 'msg' => 'Company not found'],
        404,
        'Company not found'
      );
    }
    return api_ok(null, $company);
  }
);
