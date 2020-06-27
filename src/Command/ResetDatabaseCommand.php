<?php


namespace App\Command;


use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class ResetDatabaseCommand extends Command
{
    private $kernel;

    protected static $defaultName = 'app:reset:db';

    public function __construct(KernelInterface $kernel, string $name = null)
    {
        parent::__construct($name);
        $this->kernel = $kernel;
    }

    protected function configure()
    {
        $this->setName(self::$defaultName);
        $this->setDescription("ReCreate database ; Update schema ; Load fixtures");
        $this->setHelp("De l'aide si besoin");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Suppression de la base de données...");
        // rm db
        $this->dropDatabase();
        $output->writeln("Suppression successful.");
        // create db
        $this->createDatabase($output);
        $output->writeln("Database created.");
        // update schema
        $this->updateSchema();
        $output->writeln("Schema updated.");
        // load fixtures
        return Command::SUCCESS;
    }

    protected function dropDatabase()
    {
        $console = new Application($this->kernel);
        $console->setAutoExit(false);
        $input = new ArrayInput([
            'command' => 'doctrine:database:drop',
            '-f' => true
        ]);

        $ouput = new BufferedOutput();
        $console->run($input, $ouput);
        $content = $ouput->fetch();
        dump($content);
    }

    protected function createDatabase(OutputInterface $output)
    {
        $command = $this->getApplication()->find('doctrine:database:create');
        $args = [];
        $input = new ArrayInput($args);
        $returnCode = $command->run($input, $output);
        dump($returnCode);
        return Command::SUCCESS;
    }

    protected function updateSchema()
    {
        $console = new Application($this->kernel);
        $console->setAutoExit(false);
        $input = new ArrayInput([
            'command' => 'doctrine:schema:update',
            '--force' => true
        ]);
        $ouput = new BufferedOutput();
        $console->run($input, $ouput);
        $content = $ouput->fetch();
        dump($content);
        return Command::SUCCESS;
    }
}
