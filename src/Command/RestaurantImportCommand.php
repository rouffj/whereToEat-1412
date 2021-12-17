<?php

namespace App\Command;

use App\Entity\Address;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RestaurantImportCommand extends Command
{
    protected static $defaultName = 'app:restaurant:import';
    protected static $defaultDescription = 'Add a short description for your command';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('json_file', InputArgument::REQUIRED, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $answer = $io->ask('Do you want to delete previous restaurants in the DB? (yes/no)', 'no', function($answer) {
            $answer = strtolower($answer);

            if (!in_array($answer, ['yes', 'no'])) {
                throw new \InvalidArgumentException('The answer should be "yes" or "no"');
            }

            return $answer;
        });
        
        if ('yes' === $answer) {
            $this->entityManager->getConnection()->executeStatement('DELETE FROM restaurant;');
            $this->entityManager->getConnection()->executeStatement('DELETE FROM address;');
            //$this->entityManager->getConnection()->delete('address', []);
        }

        $json = json_decode(file_get_contents($input->getArgument('json_file')), true);

        foreach ($json['results'] as $restoInfo) {
            $restaurant  = Restaurant::fromGoogleMaps($restoInfo);
            $this->entityManager->persist($restaurant);
            //dump($restaurant);
        }

        $io->success('The import of '.count($json['results']).' restaurants has been successfull');

        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
