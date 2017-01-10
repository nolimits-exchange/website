<?php

/*
 * This file is part of HeriJobQueueBundle.
 *
 * (c) Alexandre Mogère
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Thepixeldeveloper\Nolimitsexchange\AppBundle\Services;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Process\Process;

class QueueService extends \Heri\Bundle\JobQueueBundle\Service\QueueService
{
    protected function run($message)
    {
        if (property_exists($this->adapter, 'logger')) {
            $this->adapter->logger = $this->logger;
        }

        try {
            list(
                $commandName,
                $arguments
            ) = $this->getUnseralizedBody($message);

            $this->output->writeLn("<fg=yellow> [x] [{$this->queue->getName()}] {$commandName} received</> ");

            if (!isset($this->command)) {
                $console = 'app/console';
                if (Kernel::VERSION >= 3) {
                    $console = 'bin/console';
                }
                
                $process = new Process(sprintf('%s %s %s %s',
                    'php', $console, $commandName,
                    implode(' ', $arguments)
                ));
                $process->setTimeout($this->processTimeout);
                $process->run();

                if (!$process->isSuccessful()) {
                    throw new \Exception($process->getErrorOutput());
                }

                echo $process->getOutput();
            } else {
                $input = new ArrayInput(array_merge([''], $arguments));
                $command = $this->command->getApplication()->find($commandName);
                $command->run($input, $this->output);
            }

            $this->queue->deleteMessage($message);
            $this->output->writeLn("<fg=green> [x] [{$this->queue->getName()}] {$commandName} done</>");
        } catch (\Exception $e) {
            $this->output->writeLn("<fg=white;bg=red> [!] [{$this->queue->getName()}] FAILURE: {$e->getMessage()}</>");
            $this->adapter->logException($message, $e);
            $this->logger->critical($e->getMessage(), ['type' => get_class($e)]);
        }
    }
}
