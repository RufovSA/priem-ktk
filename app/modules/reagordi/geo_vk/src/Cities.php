<?php

namespace Reagordi\GeoVk;

use Reagordi;

class Cities
{
  public static function getList($country_id, $region_id)
  {
    $cached_string =
      Reagordi::$app->context->cache->getItem(
        'vk_cities_' . $country_id . '_' . $region_id . '_' . LANGUAGE_ID
      );

    if (!$cached_string->isHit()) {
      $regions = array();

      $data = @json_decode(
        Tools::sendMethod(
          'database.getCities',
          [
            'country_id' => $country_id,
            'region_id' => $region_id,
            'need_all' => 1,
            'count' => 1000,
            'lang' => LANGUAGE_ID
          ]
        ),
        true
      );

      if (isset($data['response']['items'])) {
        $regions = $data['response']['items'];
        $c = $data['response']['count'];
        for ($i = 1000; $i - 1000 < $c; $i = $i + 1000) {
          $data = @json_decode(
            Tools::sendMethod(
              'database.getCities',
              [
                'country_id' => $country_id,
                'region_id' => $region_id,
                'need_all' => 0,
                'offset' => $i,
                'count' => 1000,
                'lang' => LANGUAGE_ID
              ]
            ),
            true
          );
          if (isset($data['response']['items'])) {
            $regions = array_merge($regions, $data['response']['items']);
          }
        }
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
