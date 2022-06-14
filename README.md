# simple-jwt

> 一个简易的jwt扩展

## 概述
网上基于PHP的jwt扩展很多，但是在开发中小型项目的时候，只是需要一个简单高效的jwt加密扩展，找起来却特别费劲，于是这个扩展就诞生了。不需要复杂的初始化，也不用担心代码臃肿带来的性能损失，简单几行代码就可以生成/验证基于jwt的token。

## 支持的加密方式

- HS256
- HS384
- HS512
- RS256
- RS384
- RS512

## 使用方法

### 生成token

```php
use yupoxiong\jwt\Jwt;

// 初始化jwt
$jwt = new Jwt();
// 当前时间
$time = time();

// 设置加密方式为sha256
$jwt->setAlg('HS256');

// 加密key
$key = '123456';

// 设置加密key
$jwt->setKey($key);

// 设置用户ID
$jwt->setUid($uid);

// 生成唯一的jti
$jti = sha1((string)$uid);

// 设置jti
$jwt->setJti($jti);

// 添加自定义header
$jwt->setHeader('haha', '123');

// 设置签发人
$jwt->setIss('server');

// 设置签发时间
$jwt->setIat($time);

// 设置使用人
$jwt->setAud('client');

// 设置可用时间
$jwt->setNbf($time);

// 设置1小时后过期
$jwt->setExp($time + 3600);

// 自定义claim
$jwt->setClaim('hi001','001');

$token = $jwt->getToken();

```

### 验证token

```php

use yupoxiong\jwt\Jwt;

// 初始化jwt
$jwt = new Jwt();

$result = $jwt->setKey($key)->checkToken($token);

if ($result) {
    // 获取uid
    $uid = $jwt->getUid();
    
    // 获取jti
    $jti = $jwt->getJti();
    
    // 获取自定义的claim
    $hi001 = $jwt->getClaim('hi001');
    
    // 获取整个header数组
    $header = $jwt->getHeader();
    
    // 获取整个payload数组
    $payload = $jwt->getPayload();
    
    // 获取签发人
    $iss = $jwt->getIss();
    // 获取使用人
    $aud = $jwt->getAud();
} else {
    // 验证失败，输出原因
    echo $jwt->getMessage() ;
}
```

## 助手函数

```php
use \yupoxiong\jwt\exception\JwtException;

try {   
    // 生成
    $token = jwt_token('key','uid');
} catch (JwtException $e) {
    // 生成失败
    $msg = $e->getMessage();
}

try {   
    // 验证
    $jwt = jwt_token_check('token','key');
    // 后续操作
    $uid = $jwt->getUid();
} catch (JwtException $e) {
    // 验证失败
    $msg = $e->getMessage();
}

```

更多可参考`src/example/JwtExample.php内示例`

