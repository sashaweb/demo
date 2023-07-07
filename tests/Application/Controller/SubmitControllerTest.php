<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SubmitControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/submit');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Добавление сайта');
    }
}
