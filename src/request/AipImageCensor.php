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
 * 黄反识别
 */
class AipImageCensor extends Api
{

    /**
     * antiporn api url
     * @var string
     */
    private $antiPornUrl = 'https://aip.baidubce.com/rest/2.0/antiporn/v1/detect';

    /**
     * antiporn gif api url
     * @var string
     */
    private $antiPornGifUrl = 'https://aip.baidubce.com/rest/2.0/antiporn/v1/detect_gif';

    /**
     * antiterror api url
     * @var string
     */
    private $antiTerrorUrl = 'https://aip.baidubce.com/rest/2.0/antiterror/v1/detect';

    /**
     * @var string
     */
    private $faceAuditUrl = 'https://aip.baidubce.com/rest/2.0/solution/v1/face_audit';

    /**
     * @var string
     */
    private $imageCensorCombUrl = 'https://aip.baidubce.com/api/v1/solution/direct/img_censor';

    /**
     * @var string
     */
    private $imageCensorUserDefinedUrl = 'https://aip.baidubce.com/rest/2.0/solution/v1/img_censor/v2/user_defined';

    /**
     * @var string
     */
    private $antiSpamUrl = 'https://aip.baidubce.com/rest/2.0/antispam/v2/spam';

    /**
     * @var string
     */
    private $textCensorUserDefinedUrl = 'https://aip.baidubce.com/rest/2.0/solution/v1/text_censor/v2/user_defined';

    /**
     * @param string $image 图像读取
     * @return array
     */
    public function antiPorn($image)
    {

        $data = array();
        $data['image'] = base64_encode($image);

        return $this->post($this->antiPornUrl, $data);
    }

    /**
     * @param string $image 图像读取
     * @return array
     */
    public function antiPornGif($image)
    {

        $data = array();
        $data['image'] = base64_encode($image);

        return $this->post($this->antiPornGifUrl, $data);
    }

    /**
     * @param string $image 图像读取
     * @return array
     */
    public function antiTerror($image)
    {

        $data = array();
        $data['image'] = base64_encode($image);

        return $this->post($this->antiTerrorUrl, $data);
    }

    /**
     * @param string $images 图像读取
     * @return array
     */
    public function faceAudit($images, $configId = '')
    {

        // 非数组则处理为数组
        if (!is_array($images)) {
            $images = array(
                $images,
            );
        }

        $data = array(
            'configId' => $configId,
        );

        $isUrl = substr(trim($images[0]), 0, 4) === 'http';
        if (!$isUrl) {
            $arr = array();

            foreach ($images as $image) {
                $arr[] = base64_encode($image);
            }
            $data['images'] = implode(',', $arr);
        } else {
            $urls = array();

            foreach ($images as $url) {
                $urls[] = urlencode($url);
            }

            $data['imgUrls'] = implode(',', $urls);
        }

        return $this->post($this->faceAuditUrl, $data);
    }

    /**
     * @param string $image 图像读取
     * @return array
     */
    public function imageCensorComb($image, $scenes = 'antiporn', $options = array())
    {

        $scenes = !is_array($scenes) ? explode(',', $scenes) : $scenes;

        $data = array(
            'scenes' => $scenes,
        );

        $isUrl = substr(trim($image), 0, 4) === 'http';
        if (!$isUrl) {
            $data['image'] = base64_encode($image);
        } else {
            $data['imgUrl'] = $image;
        }

        $data = array_merge($data, $options);

        return $this->json($this->imageCensorCombUrl, $data);
    }

    /**
     * @param string $image 图像
     * @return array
     */
    public function imageCensorUserDefined($image)
    {
        $data = array();

        $isUrl = substr(trim($image), 0, 4) === 'http';
        if (!$isUrl) {
            $data['image'] = base64_encode($image);
        } else {
            $data['imgUrl'] = $image;
        }

        return $this->post($this->imageCensorUserDefinedUrl, $data);
    }

    /**
     * @param string $text
     * @return array
     */
    public function textCensorUserDefined($text)
    {
        $data = array();

        $data['text'] = $text;

        return $this->post($this->textCensorUserDefinedUrl, $data);
    }

    /**
     * @param string $content
     * @return array
     */
    public function antiSpam($content, $options = array())
    {
        $data = array();
        $data['content'] = $content;

        $data = array_merge($data, $options);

        return $this->post($this->antiSpamUrl, $data);
    }

}
