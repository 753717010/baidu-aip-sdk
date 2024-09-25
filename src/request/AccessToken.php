<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2024/9/25
 * Time: 10:39 AM
 * @copyright: ©2024 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace cje\BaiduAIP\request;

use cje\BaiduAIP\BaiduApp;
use cje\BaiduAIP\exception\Exception;
use GuzzleHttp\Exception\ClientException;
use Hanson\Foundation\AbstractAccessToken;

class AccessToken extends AbstractAccessToken
{
    /**
     * @var BaiduApp
     */
    protected $app;

    /**
     * 接口权限
     */
    protected $scope;

    /**
     * 获取access token url
     * @var string
     */
    protected $accessTokenUrl = 'https://aip.baidubce.com/oauth/2.0/token';

    protected $tokenJsonKey = 'access_token';

    protected $expiresJsonKey = 'expires_in';

    public function getTokenFromServer()
    {
        try {
            $response = $this->app->http->get($this->accessTokenUrl, array(
                'grant_type' => 'client_credentials',
                'client_id' => $this->app->getAppConfig()->getApiKey(),
                'client_secret' => $this->app->getAppConfig()->getSecretKey(),
            ));
            $obj = json_decode($response->getBody(), true);
            return $obj;
        } catch (ClientException $exception) {
            return json_decode($exception->getResponse()->getBody(), true);
        }
    }

    public function checkTokenResponse($result)
    {
        if (isset($result['error'])) {
            throw new Exception($result['error_description']);
        }
    }

    public function getCacheKey()
    {
        return $this->app->getAppConfig()->getAppId();
    }

    public function setScope($scope, $expires = 86400)
    {
        if ($expires) {
            $this->getCache()->save($this->getCacheKey() . '_scope', $scope, $expires);
        }

        $this->scope = $scope;

        return $this;
    }

    public function getScope()
    {
        $cached = $this->getCache()->fetch($this->getCacheKey() . '_scope') ?: $this->scope;

        if (empty($cached)) {
            $this->getToken(true);
            return $this->scope;
        }

        return $cached;
    }
}
