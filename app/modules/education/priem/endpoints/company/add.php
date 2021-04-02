<?php

use Reagordi\Framework\Context;
use RedBeanPHP\R;

$collector->post(
  'company',
  function () {
    $name = Context::getCurrent()->getRequest()->getJson('name');
    $start_date = (int)Context::getCurrent()->getRequest()->getJson('start_date');
    $end_date = (int)Context::getCurrent()->getRequest()->getJson('end_date');

    if (mb_strlen($name) < 3) {
      return api_error(null, 8, 'Invalid request');
    }
    if ($start_date > $end_date) {
      return api_error(null, 8, 'Invalid request');
    }

    $company = R::xdispense(DB_PREF . 'company');
    $company->name = $name;
    $company->start_date = $start_date;
    $company->end_date = $end_date;
    $id = R::store($company);
    return api_created(
      null,
      [
        'company' => $id
      ]
    );
  }
);
