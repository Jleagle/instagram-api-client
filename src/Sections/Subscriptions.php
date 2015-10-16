<?php
namespace Jleagle\Instagram\Sections;

use Jleagle\Instagram\Instagram;

class Subscriptions extends AbstractSection
{
  const PATH = 'subscriptions';

  const TYPE_ALL = 'all';
  const TYPE_TAG = 'tag';
  const TYPE_USER = 'user';
  const TYPE_LOCATION = 'location';
  const TYPE_GEOGRAPHY = 'geography';

  const ASPECT_MEDIA = 'media';

  /**
   * @param string $verifyToken
   *
   * @return array
   */
  public function subscribeToUsers($verifyToken = null)
  {
    $query = [
      'client_id'     => Instagram::getApiKey(),
      'client_secret' => Instagram::getApiSecret(),
      'object'        => self::TYPE_USER,
      'aspect'        => self::ASPECT_MEDIA,
      'callback_url'  => Instagram::getApiCallback(),
      'verify_token'  => $verifyToken,
    ];
    return self::post(self::PATH, $query);
  }

  /**
   * @param string $tag
   * @param string $verifyToken
   *
   * @return array
   */
  public function subscribeToTag($tag, $verifyToken = null)
  {
    $query = [
      'client_id'     => Instagram::getApiKey(),
      'client_secret' => Instagram::getApiSecret(),
      'object'        => self::TYPE_TAG,
      'aspect'        => self::ASPECT_MEDIA,
      'object_id'     => str_replace('#', '', $tag),
      'callback_url'  => Instagram::getApiCallback(),
      'verify_token'  => $verifyToken,
    ];
    return self::post(self::PATH, $query);
  }

  /**
   * @param int    $locaionId
   * @param string $verifyToken
   *
   * @return array
   */
  public function subscribeToLocation($locaionId, $verifyToken = null)
  {
    $query = [
      'client_id'     => Instagram::getApiKey(),
      'client_secret' => Instagram::getApiSecret(),
      'object'        => self::TYPE_LOCATION,
      'aspect'        => self::ASPECT_MEDIA,
      'object_id'     => $locaionId,
      'callback_url'  => Instagram::getApiCallback(),
      'verify_token'  => $verifyToken,
    ];
    return self::post(self::PATH, $query);
  }

  /**
   * @param float  $latitude
   * @param float  $longitude
   * @param int    $radiusMeters
   * @param string $verifyToken
   *
   * @return array
   */
  public function subscribeToGeography(
    $latitude, $longitude, $radiusMeters, $verifyToken = null
  )
  {
    $query = [
      'client_id'     => Instagram::getApiKey(),
      'client_secret' => Instagram::getApiSecret(),
      'object'        => self::TYPE_GEOGRAPHY,
      'aspect'        => self::ASPECT_MEDIA,
      'lat'           => $latitude,
      'lng'           => $longitude,
      'radius'        => $radiusMeters,
      'callback_url'  => Instagram::getApiCallback(),
      'verify_token'  => $verifyToken,
    ];
    return self::post(self::PATH, $query);
  }

  /**
   * @return array
   */
  public function listSubscriptions()
  {
    $query = [
      'client_id'     => Instagram::getApiKey(),
      'client_secret' => Instagram::getApiSecret(),
    ];
    return self::get(self::PATH, $query);
  }

  /**
   * @param int $SubscriptionId
   *
   * @return array
   */
  public function unsubscribeById($SubscriptionId)
  {
    $query = [
      'client_id'     => Instagram::getApiKey(),
      'client_secret' => Instagram::getApiSecret(),
      'id'            => $SubscriptionId,
    ];
    return self::delete(self::PATH, $query);
  }

  /**
   * @param string $typeConstant
   *
   * @return array
   */
  public function unsubscribeByType($typeConstant)
  {
    $query = [
      'client_id'     => Instagram::getApiKey(),
      'client_secret' => Instagram::getApiSecret(),
      'object'        => $typeConstant,
    ];
    return self::delete(self::PATH, $query);
  }
}
