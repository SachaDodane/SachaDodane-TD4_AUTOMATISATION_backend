<?php

namespace App\Tests\Entity;

use App\Entity\Building;
use App\Entity\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    private Person $person;

    protected function setUp(): void
    {
        $this->person = new Person();
    }

    public function testGetterAndSetter(): void
    {
        $this->person->setFirstName('John');
        $this->person->setLastName('Doe');
        $this->person->setAge(30);
        $this->person->setEmail('john@example.com');

        $this->assertEquals('John', $this->person->getFirstName());
        $this->assertEquals('Doe', $this->person->getLastName());
        $this->assertEquals(30, $this->person->getAge());
        $this->assertEquals('john@example.com', $this->person->getEmail());
    }

    public function testBuildingAssociation(): void
    {
        $building = new Building();
        $building->setName('Test Building')
                ->setAddress('123 Test Street')
                ->setCapacity(100);

        $this->person->setBuilding($building);
        $this->assertSame($building, $this->person->getBuilding());

        $this->person->setBuilding(null);
        $this->assertNull($this->person->getBuilding());
    }
}
