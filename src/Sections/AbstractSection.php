<?php
namespace Jleagle\Instagram\Sections;

use Jleagle\CurlWrapper\Curl;
use Jleagle\CurlWrapper\Response;
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
    $response = Curl::get(Instagram::API_URL . $path, $data)->run();
    return self::_handleResponse($response);
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
    $response = Curl::post(Instagram::API_URL . $path, $data)->run();
    return self::_handleResponse($response);
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
    $response = Curl::delete(Instagram::API_URL . $path, $data)->run();
    return self::_handleResponse($response);
  }

  /**
   * @param Response $response
   *
   * @return array
   *
   * @throws BadRequestException
   * @throws RateLimitException
   */
  protected function _handleResponse(Response $response)
  {
    $code = $response->getHttpCode();
    $error = $response->getErrorMessage();

    switch($code)
    {
      case 0:
      case 200:
        return $response->getJson();
      case 429:
        throw new RateLimitException($error, $code);
      default:
        throw new BadRequestException($error, $code);
    }
  }
}
