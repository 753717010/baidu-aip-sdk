<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2024/9/25
 * Time: 10:47 AM
 * @copyright: ©2024 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace cje\BaiduAIP\request;

use cje\BaiduAIP\BaiduApp;
use cje\BaiduAIP\util\AipImageUtil;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['access_token'] = function (BaiduApp $app) {
            return new AccessToken($app);
        };

        $pimple['bodyAnalysis'] = function (BaiduApp $app) {
            return new AipBodyAnalysis($app);
        };

        $pimple['contentCensor'] = function (BaiduApp $app) {
            return new AipContentCensor($app);
        };

        $pimple['face'] = function (BaiduApp $app) {
            return new AipFace($app);
        };

        $pimple['imageCensor'] = function (BaiduApp $app) {
            return new AipImageCensor($app);
        };

        $pimple['imageClassify'] = function (BaiduApp $app) {
            return new AipImageClassify($app);
        };

        $pimple['imageProcess'] = function (BaiduApp $app) {
            return new AipImageProcess($app);
        };

        $pimple['imageSearch'] = function (BaiduApp $app) {
            return new AipImageSearch($app);
        };

        $pimple['kg'] = function (BaiduApp $app) {
            return new AipKg($app);
        };

        $pimple['nlp'] = function (BaiduApp $app) {
            return new AipNlp($app);
        };

        $pimple['ocr'] = function (BaiduApp $app) {
            return new AipOcr($app);
        };

        $pimple['speech'] = function (BaiduApp $app) {
            return new AipSpeech($app);
        };
    }
}
