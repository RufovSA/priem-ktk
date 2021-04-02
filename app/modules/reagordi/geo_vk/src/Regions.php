<?php

namespace Reagordi\GeoVk;

use Reagordi;

class Regions
{
  public static function getList($country_id)
  {
    $cached_string =
      Reagordi::$app->context->cache->getItem(
        'vk_regions_' . $country_id . '_' . LANGUAGE_ID
      );

    if (!$cached_string->isHit()) {
      $regions = array();

      $data = @json_decode(
        Tools::sendMethod(
          'database.getRegions',
          [
            'country_id' => $country_id,
            'count' => 1000,
            'lang' => LANGUAGE_ID
          ]
        ),
        true
      );

      if (isset($data['response']['items'])) {
        $regions = $data['response']['items'];
        // The cached entry doesn't exist
        $number_of_seconds = 86400;
        $cached_string->set($regions)->expiresAfter($number_of_seconds);
        Reagordi::$app->context->cache->save($cached_string);
      }
    } else {
      $regions = $cached_string->get();
    }
    return $regions;
  }
}
