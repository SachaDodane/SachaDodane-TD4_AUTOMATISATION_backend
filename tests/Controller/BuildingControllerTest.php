<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BuildingControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/building/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Buildings List');
    }
}
