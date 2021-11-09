<?php
/**
 * 测试用例
 */
namespace yupoxiong\jwt\tests;


use PHPUnit\Framework\TestCase as BaseTestCase;
use yupoxiong\jwt\Jwt;


class TestCase extends BaseTestCase
{

    public function testGetToken()
    {
        $jwt = new Jwt();

        $jwt->setKey('122');

        $jwt->setHeader('name','value');
        $jwt->getHeader();
        $jwt->setClaim('name','value');
        $jwt->getClaim('name');

        var_dump($jwt->getToken());

    }

}