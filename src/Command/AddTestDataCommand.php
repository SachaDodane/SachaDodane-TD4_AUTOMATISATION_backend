<?php

namespace App\Command;

use App\Entity\Building;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:add-test-data',
    description: 'Adds test data to the database using Faker'
)]
class AddTestDataCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();

        // Create buildings
        $buildings = [];
        for ($i = 0; $i < 5; $i++) {
            $building = new Building();
            $building->setName($faker->company)
                    ->setAddress($faker->address)
                    ->setCapacity($faker->numberBetween(50, 1000));
            
            $this->entityManager->persist($building);
            $buildings[] = $building;
        }

        // Create people
        for ($i = 0; $i < 20; $i++) {
            $person = new Person();
            $person->setFirstName($faker->firstName)
                  ->setLastName($faker->lastName)
                  ->setAge($faker->numberBetween(18, 80))
                  ->setEmail($faker->email)
                  ->setBuilding($faker->randomElement($buildings));
            
            $this->entityManager->persist($person);
        }

        $this->entityManager->flush();

        $output->writeln('Test data has been added successfully using Faker!');
        $output->writeln(sprintf('Created %d buildings and %d people', count($buildings), 20));

        return Command::SUCCESS;
    }
}
