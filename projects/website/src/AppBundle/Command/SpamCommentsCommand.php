<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Command;

use Doctrine\ORM\EntityRepository;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Entity\FileRating;
use Thepixeldeveloper\Nolimitsexchange\AppBundle\Spam\ClassifierInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SpamCommentsCommand extends Command
{
    /**
     * @var ClassifierInterface
     */
    protected $classifier;
    
    /**
     * @var EntityRepository
     */
    protected $fileRatingsRepository;

    /**
     * @param ClassifierInterface       $classifierInterface
     * @param EntityRepository $repository
     */
    public function __construct(ClassifierInterface $classifierInterface, EntityRepository $repository)
    {
        $this->classifier = $classifierInterface;
        $this->fileRatingsRepository = $repository;
        
        parent::__construct();
    }
    
    protected function configure()
    {
        $this
            ->setName('spam:ratings')
            ->setDescription('Finds and removes comments spam')
            ->addOption('remove', null, InputOption::VALUE_NONE, 'Remove spam');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $limit = 41000;
        
        /**
         * @var FileRating[] $publicRatings
         */
        $publicRatings = $this->fileRatingsRepository->findRatingsToSpamProcess($limit);
        $publicRatingsIterator = $publicRatings->iterate();
        
        $progress = new ProgressBar($output, $limit);
        $progress->start();
        
        $spamRatingIds = [];
        $total = 0;
        
        foreach ($publicRatingsIterator as $rating) {

            /**
             * @var FileRating $ratingObject
             */
            $ratingObject = $rating[0];
            $comment      = $ratingObject->getComment();

            $isSpam = $this->classifier->isSpam($comment);
            
            $total++;

            if ($isSpam) {
                $spamRatingIds[] = $ratingObject->getId();
            }

            $progress->advance();
            
            $this->fileRatingsRepository->detach($ratingObject);
        }

        $progress->finish();
        
        $output->writeln('');
        $output->writeln('');
        $output->writeln('(spam: '.count($spamRatingIds).')');
        $output->writeln('(ham: '.($total - count($spamRatingIds)).')');
        $output->writeln('('. sprintf('%.2f', 100 * ($total ? count($spamRatingIds) / $total : 0)) .'%)');

        if ($input->getOption('remove')) {
            $output->writeln('');
            $output->writeln('Approved for removal');
            $this->fileRatingsRepository->removeSpamRatings($spamRatingIds);
        }
    }
}
