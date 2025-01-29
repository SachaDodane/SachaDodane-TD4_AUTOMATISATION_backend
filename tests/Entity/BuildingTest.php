<?php

namespace App\Tests\Entity;

use App\Entity\Building;
use App\Entity\Person;
use PHPUnit\Framework\TestCase;

class BuildingTest extends TestCase
{
    private Building $building;

    protected function setUp(): void
    {
        $this->building = new Building();
    }

    public function testGetterAndSetter(): void
    {
        $this->building->setName('Test Building');
        $this->building->setAddress('123 Test Street');
        $this->building->setCapacity(100);

        $this->assertEquals('Test Building', $this->building->getName());
        $this->assertEquals('123 Test Street', $this->building->getAddress());
        $this->assertEquals(100, $this->building->getCapacity());
    }

    public function testAddAndRemovePerson(): void
    {
        $person = new Person();
        $person->setFirstName('John')
               ->setLastName('Doe')
               ->setAge(30)
               ->setEmail('john@example.com');

        $this->building->addPerson($person);
        $this->assertCount(1, $this->building->getPeople());
        $this->assertTrue($this->building->getPeople()->contains($person));

        $this->building->removePerson($person);
        $this->assertCount(0, $this->building->getPeople());
        $this->assertFalse($this->building->getPeople()->contains($person));
    }
}
