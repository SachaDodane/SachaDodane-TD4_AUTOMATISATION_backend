<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PersonControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/person/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'People List');
    }
}
