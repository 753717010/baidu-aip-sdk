<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2024/9/24
 * Time: 4:22 PM
 * @copyright: ©2024 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace cje\BaiduAIP;

use cje\BaiduAIP\config\Config;
use cje\BaiduAIP\request\AccessToken;
use cje\BaiduAIP\request\AipBodyAnalysis;
use cje\BaiduAIP\request\AipContentCensor;
use cje\BaiduAIP\request\AipFace;
use cje\BaiduAIP\request\AipImageCensor;
use cje\BaiduAIP\request\AipImageClassify;
use cje\BaiduAIP\request\AipImageProcess;
use cje\BaiduAIP\request\AipImageSearch;
use cje\BaiduAIP\request\AipKg;
use cje\BaiduAIP\request\AipNlp;
use cje\BaiduAIP\request\AipOcr;
use cje\BaiduAIP\request\AipSpeech;
use cje\BaiduAIP\request\ServiceProvider;
use Hanson\Foundation\Foundation;

/**
 * @property AccessToken $access_token
 * @property AipBodyAnalysis $bodyAnalysis
 * @property AipContentCensor $contentCensor
 * @property AipFace $face
 * @property AipImageCensor $imageCensor
 * @property AipImageClassify $imageClassify
 * @property AipImageProcess $imageProcess
 * @property AipImageSearch $imageSearch
 * @property AipKg $kg
 * @property AipNlp $nlp
 * @property AipOcr $ocr
 * @property AipSpeech $speech
 */
class BaiduApp extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
    ];

    public function getAppConfig()
    {
        $config = $this->getConfig();
        return new Config($config['app_id'], $config['api_key'], $config['secret_key']);
    }
}
