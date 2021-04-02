<?php

use Reagordi\Framework\Context;
use RedBeanPHP\R;

$collector->put(
  'company/{id}',
  function ($id) {
    $name = Context::getCurrent()->getRequest()->getJson('name');

    if (mb_strlen($name) < 3) {
      return api_error(null, 8, 'Invalid request');
    }

    $company = R::load(DB_PREF . 'company', $id);
    if ($company->id == 0) {
      return api_error(
        ['code' => 404, 'msg' => 'Company not found'],
        404,
        'Company not found'
      );
    }

    $company->name = $name;
    $id = R::store($company);

    return api_ok(
      null,
      [
        'company' => $id
      ]
    );
  }
);
