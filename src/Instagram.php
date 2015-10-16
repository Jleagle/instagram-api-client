<?php
namespace Jleagle\Instagram;

use Jleagle\Instagram\Sections\Subscriptions;

class Instagram
{
  const API_URL = 'https://api.instagram.com/v1/';
  const API_OAUTH_URL = 'https://api.instagram.com/oauth/authorize';
  const API_OAUTH_TOKEN_URL = 'https://api.instagram.com/oauth/access_token';

  protected static $_apiKey;
  protected static $_apiSecret;
  protected static $_apiCallback;
  protected static $_apiAccessToken;

  /**
   * @return string
   */
  public static function getApiKey()
  {
    return self::$_apiKey;
  }

  /**
   * @param string $apiKey
   */
  public static function setApiKey($apiKey)
  {
    self::$_apiKey = $apiKey;
  }

  /**
   * @return string
   */
  public static function getApiSecret()
  {
    return self::$_apiSecret;
  }

  /**
   * @param string $apiSecret
   */
  public static function setApiSecret($apiSecret)
  {
    self::$_apiSecret = $apiSecret;
  }

  /**
   * @return string
   */
  public static function getApiCallback()
  {
    return self::$_apiCallback;
  }

  /**
   * @param string $apiCallback
   */
  public static function setApiCallback($apiCallback)
  {
    self::$_apiCallback = $apiCallback;
  }

  /**
   * @return string
   */
  public static function getApiAccessToken()
  {
    return self::$_apiAccessToken;
  }

  /**
   * @param string $apiAccessToken
   */
  public static function setApiAccessToken($apiAccessToken)
  {
    self::$_apiAccessToken = $apiAccessToken;
  }

  /**
   * @return Subscriptions
   */
  public static function subscriptions()
  {
    return new Subscriptions();
  }

  //public static function users()
  //{
  //}
  //
  //public static function relationships()
  //{
  //}
  //
  //public static function media()
  //{
  //}
  //
  //public static function comments()
  //{
  //}
  //
  //public static function likes()
  //{
  //}
  //
  //public static function tags()
  //{
  //}
  //
  //public static function locations()
  //{
  //}
  //
  //public static function geographies()
  //{
  //}
}
