<?php

namespace App\Tests\Application\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/area51');

        $this->assertResponseIsSuccessful();
    }
}
