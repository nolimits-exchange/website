<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\FileRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Handlers\CoasterPublishedHandler;

class ProcessFileUploadCommand extends Command
{
    /**
     * @var FileRepository
     */
    protected $coasterRepository;

    /**
     * ProcessFileUploadCommand constructor.
     *
     * @param FileRepository $coasterRepository
     */
    public function __construct(FileRepository $coasterRepository)
    {
        $this->coasterRepository = $coasterRepository;

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
        $id = $input->getArgument('id');

        /**
         * @var File $coaster
         */
        $coaster = $this->coasterRepository->find($id);
        
        $handler = new CoasterPublishedHandler();
        
        return $handler->handle($coaster);
    }
}
