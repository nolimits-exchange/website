<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use League\Flysystem\MountManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListFilesCommand extends Command
{
    /**
     * @var MountManager
     */
    protected $mountManager;
    
    /**
     * ListFiles constructor.
     *
     * @param MountManager $mountManager
     */
    public function __construct(MountManager $mountManager)
    {
        $this->mountManager = $mountManager;
        
        parent::__construct();
    }
    
    protected function configure()
    {
        //
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $contents = $this->mountManager->listContents('ephemeral://', true);
        
        foreach ($contents as $content) {
            if ($content['type'] === 'file') {
                $output->writeln($content['basename']);
            }
        }
    }
}
