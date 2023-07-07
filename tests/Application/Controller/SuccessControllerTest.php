<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SuccessControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/success');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Запрос успешно отправлен');
    }
}
