<?php

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Command;

use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\MountManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MigrateFilesCommand
 *
 * @package Thepixeldeveloper\Nolimitsexchange\AppBundle\Command
 */
class MigrateFilesCommand extends Command
{
    /**
     * @var MountManager
     */
    protected $mountManager;
    
    /**
     * MigrateFilesCommand constructor.
     *
     * @param MountManager $mountManager
     */
    public function __construct(MountManager $mountManager)
    {
        $this->mountManager = $mountManager;
        
        parent::__construct('app:migrate:files');
    }
    
    protected function configure()
    {
        $this->setDescription('Migrate files from legacy storage to new storage.');
    }
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->movefiles($output, 'former://files', 'coasters://', function($path) {
                return str_replace('files/', '', $path);
            }
        );
    
        $this->movefiles($output, 'former://images', 'screenshots://', function($path) {
                return str_replace('images/', '', $path);
            }
        );
    }
    
    /**
     * @param array $file
     *
     * @return bool
     */
    protected function isDirectory(array $file): bool
    {
        return $file['type'] === 'dir';
    }
    
    /**
     * File realpath.
     *
     * @param array $file
     *
     * @return string
     */
    protected function getRealpath(array $file): string
    {
        return $file['filesystem'] . '://' . $file['path'];
    }
    
    /**
     * @param OutputInterface $output
     * @param string          $source
     * @param string          $destination
     * @param callable        $pathCallback
     */
    protected function movefiles(OutputInterface $output, string $source, string $destination, callable $pathCallback) {
        $files = $this->mountManager->listContents($source, true);
    
        /**
         * @var AwsS3Adapter $adapter
         */
        $adapter = $this->mountManager->getAdapter($destination);
        $adapter->getClient()->registerStreamWrapper();
    
        foreach ($files as $file) {
            if ($this->isDirectory($file)) {
                continue;
            }
            
            $path = $pathCallback($file['path']);
            
            if ($this->mountManager->has($destination . $path)) {
                $output->writeln('Skipping: ' . $path);
                continue;
            }
        
            $output->writeln('Moving: ' . $this->getRealpath($file) . ' -> ' . $destination . $path);
    
            $destinationStream = fopen('s3://' . $adapter->getBucket() . '/' . $adapter->getPathPrefix() . $path, 'w');
            
            stream_copy_to_stream(
                $this->mountManager->readStream($this->getRealpath($file)),
                $destinationStream
            );
    
            fclose($destinationStream);
        }
    }
}
