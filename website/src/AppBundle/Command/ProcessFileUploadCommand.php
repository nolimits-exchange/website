<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers\Coaster\UploadFinishedHandler;

class ProcessFileUploadCommand extends Command
{
    /**
     * @var FileRepository
     */
    protected $coasterRepository;
    
    /**
     * @var UploadFinishedHandler
     */
    protected $handler;
    
    /**
     * ProcessFileUploadCommand constructor.
     *
     * @param FileRepository        $coasterRepository
     * @param UploadFinishedHandler $handler
     */
    public function __construct(FileRepository $coasterRepository, UploadFinishedHandler $handler)
    {
        $this->coasterRepository = $coasterRepository;
        $this->handler = $handler;
        
        parent::__construct();
    }
    
    protected function configure()
    {
        $this
            ->setName('process:file_upload')
            ->setDescription('Process file uploads')
            ->addArgument(
                'id',
                InputArgument::OPTIONAL,
                'File ID'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $this->coasterRepository->find(
            $input->getArgument('id')
        );
        
        return (int) $this->handler->handle($file);
    }
}
