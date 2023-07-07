<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Поиск');
    }
}
