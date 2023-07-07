<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TermsControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/terms');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Правила');
    }
}
