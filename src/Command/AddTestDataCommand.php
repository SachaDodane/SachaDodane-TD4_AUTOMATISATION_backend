<?php

namespace App\Command;

use App\Entity\Building;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddTestDataCommand extends Command
{
    protected static $defaultName = 'app:add-test-data';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this->setDescription('Adds test data to the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Create buildings
        $buildings = [];
        $buildingData = [
            ['Tour Eiffel', 'Champ de Mars, Paris', 1000],
            ['Empire State', 'Manhattan, New York', 2000],
            ['Burj Khalifa', 'Dubai', 3000],
        ];

        foreach ($buildingData as [$name, $address, $capacity]) {
            $building = new Building();
            $building->setName($name)
                    ->setAddress($address)
                    ->setCapacity($capacity);
            
            $this->entityManager->persist($building);
            $buildings[] = $building;
        }

        // Create people
        $peopleData = [
            ['John', 'Doe', 30, 'john@example.com'],
            ['Jane', 'Smith', 25, 'jane@example.com'],
            ['Bob', 'Johnson', 45, 'bob@example.com'],
            ['Alice', 'Brown', 35, 'alice@example.com'],
            ['Charlie', 'Wilson', 28, 'charlie@example.com'],
        ];

        foreach ($peopleData as [$firstName, $lastName, $age, $email]) {
            $person = new Person();
            $person->setFirstName($firstName)
                  ->setLastName($lastName)
                  ->setAge($age)
                  ->setEmail($email)
                  ->setBuilding($buildings[array_rand($buildings)]);
            
            $this->entityManager->persist($person);
        }

        $this->entityManager->flush();

        $output->writeln('Test data has been added successfully!');

        return Command::SUCCESS;
    }
}
