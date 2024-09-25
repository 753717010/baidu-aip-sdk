<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2024/9/24
 * Time: 4:12 PM
 * @copyright: ©2024 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace cje\BaiduAIP\config;

class Config
{
    /**
     * appId
     * @var string
     */
    protected $appId = '';

    /**
     * apiKey
     * @var string
     */
    protected $apiKey = '';

    /**
     * secretKey
     * @var string
     */
    protected $secretKey = '';

    /**
     * 权限
     * @var array
     */
    protected $scope = 'brain_all_scope';

    public $version = '2_2_17';

    /**
     * @param string $appId
     * @param string $apiKey
     * @param string $secretKey
     */
    public function __construct($appId, $apiKey, $secretKey)
    {
        $this->appId = trim($appId);
        $this->apiKey = trim($apiKey);
        $this->secretKey = trim($secretKey);
    }

    /**
     * 获取 app id
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * 获取 api key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * 获取 secret key
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }
}
