<?php

namespace Reagordi\GeoVk;

use Reagordi;

class Tools
{
  const VK_VER = '5.130';

  public static function sendMethod($method, $params)
  {
    $url = 'https://api.vk.com/method/' . $method;
    $params['v'] = isset($params['v']) ? $params['v'] : self::VK_VER;
    $params['access_token'] =
      isset($params['access_token']) ? $params['access_token'] :
        Reagordi::$app->config->get('reagordi', 'geo_vk', 'service_key');
    return self::httpGetContents($url, $params);
  }

  /**
   * Отправка запроса к другому серверу
   *
   * @param string $file URL путь
   * @param array $post_params массив POST параметров
   * @return string
   */
  public static function httpGetContents($file, $post_params = false)
  {
    $data = false;
    if (stripos($file, 'http://') !== 0 and stripos($file, 'https://') !== 0) {
      return false;
    }
    if (function_exists('curl_init')) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $file);
      if (is_array($post_params)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_params));
      }
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $data = curl_exec($ch);
      curl_close($ch);
      if ($data !== false) {
        return $data;
      }
    }
    if (preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen'))) {
      if (is_array($post_params)) {
        $file .= '?' . http_build_query($post_params);
      }
      $data = @file_get_contents($file);
      if ($data !== false) {
        return $data;
      }
    }
    return false;
  }
}
