<?php

namespace Reagordi\GeoVk;

use Reagordi;

class Countries
{
  public static function getList()
  {
    $cached_string =
      Reagordi::$app->context->cache->getItem('vk_countries_' . LANGUAGE_ID);

    if (!$cached_string->isHit()) {
      $countries = array();

      $data = @json_decode(
        Tools::sendMethod(
          'database.getCountries',
          [
            'need_all' => 1,
            'count' => 1000,
            'lang' => LANGUAGE_ID
          ]
        ),
        true
      );

      if (isset($data['response']['items'])) {
        $countries = $data['response']['items'];
        // The cached entry doesn't exist
        $number_of_seconds = 86400;
        $cached_string->set($countries)->expiresAfter($number_of_seconds);
        Reagordi::$app->context->cache->save($cached_string);
      }
    } else {
      $countries = $cached_string->get();
    }
    return $countries;
  }
}