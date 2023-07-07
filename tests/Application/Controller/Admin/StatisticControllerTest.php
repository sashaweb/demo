<?php

namespace App\Tests\Application\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Repository\UserRepository;

class StatisticControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sashaon@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/secret/statistic');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Статистика');
    }
}
