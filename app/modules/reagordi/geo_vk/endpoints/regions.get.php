<?php

/** @var $collector Phroute\Phroute\RouteCollector */

use Reagordi\GeoVk\Regions;

$collector->get(
  'reagordi/geo_vk/regions.get',
  function () {
    $country_id = Reagordi::$app->context->request->get('country_id');

    if ($country_id <= 0) return api_notfound();

    $data = Regions::getList($country_id);

    if (!$data) return api_notfound();

    return api_ok(null, $data);
  }
);
