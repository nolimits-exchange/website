<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\File;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Repository\SaveableInterface;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\UploadCoasterService;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Services\UploadScreenshotService;

class ProcessFileUploadCommand extends Command
{
    /**
     * @var UploadCoasterService
     */
    protected $uploadCoasterService;

    /**
     * @var UploadScreenshotService
     */
    protected $uploadScreenshotService;

    /**
     * @var SaveableInterface
     */
    protected $coasterRepository;

    /**
     * ProcessFileUploadCommand constructor.
     *
     * @param UploadCoasterService $uploadCoasterService
     * @param UploadScreenshotService $uploadScreenshotService
     * @param SaveableInterface $coasterRepository
     */
    public function __construct(
        UploadCoasterService $uploadCoasterService,
        UploadScreenshotService $uploadScreenshotService,
        SaveableInterface $coasterRepository
    ) {
        $this->uploadCoasterService = $uploadCoasterService;
        $this->uploadScreenshotService = $uploadScreenshotService;
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

        /**
         * Reasons for the coaster not being found.
         *
         * 1. The database was seeded during development, thus changing IDs.
         */
        if (null === $coaster) {
            return 0;
        }

        $coasterUploadReturnCode    = $this->uploadCoasterService->execute($id, $coaster->getCoasterExt());
        $screenshotUploadReturnCode = $this->uploadScreenshotService->execute($id, $coaster->getScreenshotExt());

        $returnCode = $coasterUploadReturnCode === 0 && $screenshotUploadReturnCode === 0;

        if ($returnCode) {
            $this->setDoneStatus($coaster);
        }

        return 0; // Tolerate broken stuff
    }

    protected function setDoneStatus(File $coaster)
    {
        $coaster->setStatus(File::PUBLISHED);

        $this->coasterRepository->save($coaster);
    }
}
