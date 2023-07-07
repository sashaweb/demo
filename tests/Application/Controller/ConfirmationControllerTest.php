<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConfirmationControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/confirmation/incorrectcode');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Подтверджение запроса');
    }
}
