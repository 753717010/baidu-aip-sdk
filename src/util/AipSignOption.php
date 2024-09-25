<?php
/**
 * Created By PhpStorm
 * User: 风哀伤
 * Date: 2024/9/24
 * Time: 4:19 PM
 * @copyright: ©2024 浙江禾匠信息科技
 * @link: http://www.zjhejiang.com
 */

namespace cje\BaiduAIP\util;

class AipSignOption
{
    const EXPIRATION_IN_SECONDS = 'expirationInSeconds';

    const HEADERS_TO_SIGN = 'headersToSign';

    const TIMESTAMP = 'timestamp';

    const DEFAULT_EXPIRATION_IN_SECONDS = 1800;

    const MIN_EXPIRATION_IN_SECONDS = 300;

    const MAX_EXPIRATION_IN_SECONDS = 129600;
}