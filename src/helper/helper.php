<?php
/**
 * 助手函数
 * @author yupoxiong<i@yupoxiong.com>
 */


use yupoxiong\jwt\exception\JwtException;
use yupoxiong\jwt\Jwt;

if (!function_exists('jwt_token')) {
    /**
     * 生成jwt token
     * @throws JwtException
     */
    function jwt_token($key, $uid = null, $alg = 'HS256', $header = [], $payload = []): string
    {
        if (empty($key)) {
            throw new JwtException('Key/PrivateKey不能为空');
        }

        $jwt = new yupoxiong\jwt\Jwt();

        $jwt->setAlg($alg);

        switch ($alg) {
            case Jwt::ALG['RS256']:
            case Jwt::ALG['RS384']:
            case Jwt::ALG['RS512']:
                $jwt->setPrivateKey($key);
                break;
            default:
                $jwt->setKey($key);
                break;
        }

        if ($uid !== null) {
            $jwt->setUid($uid);
        }

        if (count($header) > 0) {
            foreach ($header as $name => $value) {
                $jwt->setHeader($name, $value);
            }
        }

        if (count($payload) > 0) {
            foreach ($payload as $name => $value) {
                $jwt->setClaim($name, $value);
            }
        }

        return $jwt->getToken();
    }

}


if (!function_exists('jwt_token_check')) {
    /**
     * 生成jwt token
     * @throws JwtException
     */
    function jwt_token_check($token, $key): Jwt
    {
        if (empty($key)) {
            throw new JwtException('Key/PublicKey不能为空');
        }

        $jwt = new yupoxiong\jwt\Jwt();

        $jwt->setPublicKey($key);
        $jwt->setKey($key);

        $result = $jwt->checkToken($token);
        if ($result !== true) {
            throw new JwtException($jwt->getMessage());
        }
        return $jwt;
    }
}