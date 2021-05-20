<?php

/** @var $collector Phroute\Phroute\RouteCollector */

use Reagordi\GeoVk\Cities;
use Reagordi\GeoVk\Countries;
use Reagordi\GeoVk\Regions;
use Dompdf\Dompdf;

$collector->any('priem/statement.pdf', function () {

    $session = Reagordi::$app->context->session;

    if (!Reagordi::$app->context->session->has('user_id')) {
        header('Location: ' . HOME_URL);
        exit();
    }

    getEntrant($session);

});
