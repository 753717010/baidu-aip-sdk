<?php
/*
* Copyright (c) 2017 Baidu.com, Inc. All Rights Reserved
*
* Licensed under the Apache License, Version 2.0 (the "License"); you may not
* use this file except in compliance with the License. You may obtain a copy of
* the License at
*
* Http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
* WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
* License for the specific language governing permissions and limitations under
* the License.
*/

namespace cje\BaiduAIP\request;

/**
 * 百度语音
 */
class AipSpeech extends Api
{

    /**
     * url
     * @var string
     */
    public $asrUrl = 'http://vop.baidu.com/server_api';

    /**
     * url
     * @var string
     */
    public $ttsUrl = 'http://tsn.baidu.com/text2audio';

    /**
     * 判断认证是否有权限
     * @param array $authObj
     * @return boolean
     */
    protected function isPermission($authObj)
    {
        return true;
    }

    /**
     * 处理请求参数
     * @param string $url
     * @param array $params
     * @param array $data
     * @param array $headers
     */
    protected function proccessRequest($url, $options = [])
    {
        $token = $options['query']['access_token'] ?? '';

        if (empty($options['json']['cuid'])) {
            $options['json']['cuid'] = md5($token);
        }

        if ($url === $this->asrUrl) {
            $options['json']['token'] = $token;
        } else {
            $options['json']['tok'] = $token;
        }

        unset($options['query']['access_token']);

        return $options;
    }

    /**
     * @param string $speech
     * @param string $format
     * @param int $rate
     * @param array $options
     * @return array
     */
    public function asr($speech, $format, $rate, $options = array())
    {
        $data = array();

        if (!empty($speech)) {
            $data['speech'] = base64_encode($speech);
            $data['len'] = strlen($speech);
        }

        $data['format'] = $format;
        $data['rate'] = $rate;
        $data['channel'] = 1;

        $data = array_merge($data, $options);

        return $this->post($this->asrUrl, $data);
    }

    /**
     * @param string $text
     * @param string $lang
     * @param int $ctp
     * @param array $options
     * @return array
     */
    public function synthesis($text, $lang = 'zh', $ctp = 1, $options = array())
    {
        $data = array();

        $data['tex'] = $text;
        $data['lan'] = $lang;
        $data['ctp'] = $ctp;

        $data = array_merge($data, $options);

        return $this->post($this->ttsUrl, $data);
    }

}
