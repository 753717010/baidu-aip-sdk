# 安装PHP SDK

**支持 PHP版本：7.2++**

**Composer安装：**

```
  composer require cje/baidu-aip-sdk
```
# 使用

官方sdk貌似好久没有更新了，我这边自己添加一些新的方法进去

```php
require 'vendor/autoload.php';
$config = [
      'app_id'     => 'your app id',
      'api_key'    => 'your api key',
      'secret_key' => 'your secret key',
      'debug'        => true,
  ];

$app = new \cje\BaiduAIP\BaiduApp($config);

var_dump($app->imageCensor->antiSpam('测试'));
```

# 使用文档

参考[官方网站](http://ai.baidu.com/docs#/Begin/top)
