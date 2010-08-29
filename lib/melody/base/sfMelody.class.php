<?php
/**
 * Tool Class to create melodies :) on do other stuffs
 *
 * @author Maxime Picaud
 * @since 21 août 2010
 */
class sfMelody
{
  /**
   *
   * @param string $name
   * @param array $config
   *
   * create a melody using the name in the app.yml file
   *
   * @author Maxime Picaud
   * @since 21 août 2010
   */
  public static function getInstance($name, $config = array())
  {
    $default = sfConfig::get('app_melody_'.$name, array());

    $config = array_merge($default, $config);

    $provider = strtolower(isset($config['provider'])?$config['provider']:$name);
    $class = 'sf'.sfInflector::camelize($provider.'_melody');

    $key = isset($config['key'])?$config['key']:null;
    $secret = isset($config['secret'])?$config['secret']:null;
    $token = isset($config['token'])?$config['token']:null;
    $config['name'] = isset($config['name'])?$config['name']:$name;

    $melody = new $class($key, $secret, $token, $config);

    return $melody;
  }
}