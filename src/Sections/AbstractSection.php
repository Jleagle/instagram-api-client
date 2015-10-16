<?php
namespace Jleagle\Instagram\Sections;

use Curl\Curl;
use Jleagle\Instagram\Exceptions\BadRequestException;
use Jleagle\Instagram\Exceptions\RateLimitException;
use Jleagle\Instagram\Instagram;

abstract class AbstractSection
{
  /**
   * @param string $path
   * @param array  $data
   *
   * @return array
   *
   * @throws BadRequestException
   */
  protected function get($path, $data = [])
  {
    $curl = new Curl();
    $curl->get(Instagram::API_URL . $path, $data);

    return self::_handleResponse($curl);
  }

  /**
   * @param string $path
   * @param array  $data
   *
   * @return array
   *
   * @throws BadRequestException
   */
  protected function post($path, $data = [])
  {
    $curl = new Curl();
    $curl->post(Instagram::API_URL . $path, $data);

    return self::_handleResponse($curl);
  }

  /**
   * @param string $path
   * @param array  $data
   *
   * @return array
   *
   * @throws BadRequestException
   */
  protected function delete($path, $data = [])
  {
    $curl = new Curl();
    $curl->delete(Instagram::API_URL . $path, $data);

    return self::_handleResponse($curl);
  }

  /**
   * @param Curl $curl
   *
   * @return array
   *
   * @throws BadRequestException
   * @throws RateLimitException
   */
  protected function _handleResponse(Curl $curl)
  {
    switch($curl->error_code)
    {
      case 0:
      case 200:
        return json_decode($curl->response, true);
      case 429:
        throw new RateLimitException($curl->error_message, $curl->error_code);
      default:
        throw new BadRequestException($curl->error_message, $curl->error_code);
    }
  }
}
