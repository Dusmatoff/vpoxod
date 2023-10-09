<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testAddition()
    {
        $client = static::createClient();

        $data = [
            'num1' => 1,
            'num2' => 2,
            'operation' => '+'
        ];

        $client->request('POST', '/calculator', [], [], [], json_encode($data));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"result":3,"calculated":"1 + 2"}', $client->getResponse()->getContent());
    }

    public function testSubtraction()
    {
        $client = static::createClient();

        $data = [
            'num1' => 10,
            'num2' => 4,
            'operation' => '-'
        ];

        $client->request('POST', '/calculator', [], [], [], json_encode($data));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"result":6,"calculated":"10 - 4"}', $client->getResponse()->getContent());
    }

    public function testMultiplication()
    {
        $client = static::createClient();

        $data = [
            'num1' => 6,
            'num2' => 7,
            'operation' => '*'
        ];

        $client->request('POST', '/calculator', [], [], [], json_encode($data));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"result":42,"calculated":"6 * 7"}', $client->getResponse()->getContent());
    }

    public function testDivision()
    {
        $client = static::createClient();

        $data = [
            'num1' => 20,
            'num2' => 4,
            'operation' => '/'
        ];

        $client->request('POST', '/calculator', [], [], [], json_encode($data));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"result":5,"calculated":"20 \/ 4"}', $client->getResponse()->getContent());
    }

    public function testDivisionByZero()
    {
        $client = static::createClient();

        $data = [
            'num1' => 10,
            'num2' => 0,
            'operation' => '/'
        ];

        $client->request('POST', '/calculator', [], [], [], json_encode($data));

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"error":"Division by zero is not allowed."}', $client->getResponse()->getContent());
    }

    public function testInvalidOperation()
    {
        $client = static::createClient();

        $data = [
            'num1' => 5,
            'num2' => 3,
            'operation' => 'invalid'
        ];

        $client->request('POST', '/calculator', [], [], [], json_encode($data));

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertEquals('{"error":"Invalid operation."}', $client->getResponse()->getContent());
    }
}

