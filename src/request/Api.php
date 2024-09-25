<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2024/9/25
 * Time: 10:32 AM
 * @copyright: ©2024 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace cje\BaiduAIP\request;

use cje\BaiduAIP\BaiduApp;
use cje\BaiduAIP\exception\Exception;
use cje\BaiduAIP\util\AipSampleSigner;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    /**
     * 是否是云的老用户
     * @var bool
     */
    protected $isCloudUser;

    /**
     * @var BaiduApp
     */
    private $app;

    /**
     * @var string 所需权限
     */
    protected $scope = 'brain_all_scope';

    /**
     * @var string sdk 版本
     */
    protected $version = '2_2_17';

    /**
     * 反馈接口
     * @var string
     */
    protected $reportUrl = 'https://aip.baidubce.com/rpc/2.0/feedback/v1/report';

    /**
     * @param BaiduApp $app
     */
    public function __construct(BaiduApp $app)
    {
        $this->app = $app;
    }

    public function isCloudUser()
    {
        if (is_null($this->isCloudUser)) {
            $scope = $this->app->access_token->getScope();
            $this->isCloudUser = $scope && in_array($this->scope, explode(' ', $scope));
        }
        return $this->isCloudUser;
    }

    /**
     * @param string $method HTTP method
     * @param string $url
     * @param array $param 参数
     * @return array
     */
    private function getAuthHeaders($method, $url, $params = array(), $headers = array())
    {

        //不是云的老用户则不用在header中签名 认证
        if ($this->isCloudUser() === false) {
            return $headers;
        }

        $obj = parse_url($url);
        if (!empty($obj['query'])) {
            foreach (explode('&', $obj['query']) as $kv) {
                if (!empty($kv)) {
                    list($k, $v) = explode('=', $kv, 2);
                    $params[$k] = $v;
                }
            }
        }

        //UTC 时间戳
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');
        $headers['Host'] = isset($obj['port']) ? sprintf('%s:%s', $obj['host'], $obj['port']) : $obj['host'];
        $headers['x-bce-date'] = $timestamp;

        //签名
        $headers['authorization'] = AipSampleSigner::sign(array(
            'ak' => $this->app->getAppConfig()->getApiKey(),
            'sk' => $this->app->getAppConfig()->getSecretKey(),
        ), $method, $obj['path'], $headers, $params, array(
            'timestamp' => $timestamp,
            'headersToSign' => array_keys($headers),
        ));

        return $headers;
    }

    /**
     * 添加公共参数
     * @param array $params
     */
    protected function proccessRequest($url, $options = [])
    {
        $params = [
            'aipSdk' => 'php',
            'aipSdkVersion' => $this->version,
        ];

        $options['query'] = array_merge($options['query'], $params);
        return $options;
    }

    /**
     * 反馈
     *
     * @param $feedback
     * @return array
     * @throws Exception
     */
    public function report($feedback)
    {
        $data = array();
        $data['feedback'] = $feedback;
        return $this->request($this->reportUrl, $data);
    }

    /**
     * Api 请求
     * @param string $url
     * @param array $options
     * @return mixed
     * @throws Exception
     */
    protected function request($url, $options = [])
    {
        try {
            // 设置默认值
            $options = array_merge([
                'method' => 'GET',
                'query' => [],
                'data' => [],
                'headers' => []
            ], $options);

            if ($this->isCloudUser() === false) {
                $params['access_token'] = $this->app->access_token->getToken();
                $options['query'] = $params;
            }
            // 特殊处理
            $options = $this->proccessRequest($url, $options);

            $headers = $this->getAuthHeaders($options['method'], $url, $options['query'], $options['headers']);
            $options['headers'] = $headers;

            $response = $this->getHttp()->request($options['method'], $url, $options);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
        }
        return $this->result(json_decode($response->getBody(), true));
    }

    protected function result($result)
    {
        if (isset($result['error'])) {
            throw new Exception($result['error_description']);
        }
        if (isset($result['error_code']) && $result['error_code'] !== 0) {
            throw new Exception($result['error_msg']);
        }
        return $result;
    }

    public function post($url, $data, $headers = [])
    {
        return $this->request($url, ['method' => 'POST', RequestOptions::FORM_PARAMS => $data, RequestOptions::HEADERS => $headers]);
    }

    public function json($url, $data, $headers = [])
    {
        return $this->request($url, ['method' => 'POST', RequestOptions::JSON => $data, RequestOptions::HEADERS => $headers]);
    }
}
