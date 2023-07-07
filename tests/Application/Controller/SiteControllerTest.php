<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SiteControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/site/avto-razborka-revansh.com');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Автореванш');
    }
}
