<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriesControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/categories/goods-and-services');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Товары и услуги');
    }
}
