<?php

namespace Dawid\CronBundle\CronJobRunner;

use Dawid\CronBundle\CronJobRunner\Config\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;

final class CommandRunner
{
    private Application $console;

    public function __construct(KernelInterface $kernel)
    {
        $this->console = new Application($kernel);
        $this->console->setAutoExit(false);
    }

    public function run(
        Command $command,
        OutputInterface $output = null
    ): void
    {
        $output->writeln('');
        $output->writeln(sprintf('<bg=yellow;options=bold>%s (%s)</>', $command->id, $command->name));

        if (!$command->enabled) {
            $output->writeln(sprintf('<comment>Command %s (%s) is not enabled. Skipped.</comment>', $command->id, $command->name));
            return;
        }

        $arguments = [];
        foreach ($command->arguments as $argument) {
            $arguments[$argument->name] = $argument->value;
        }

        $options = [];
        foreach ($command->options as $option) {
            $options[$option->getNameWithMinusPrefix()] = $option->value;
        }

        $multiValueOptions = [];
        foreach ($command->multiValueOptions as $option) {
            $multiValueOptions[$option->getNameWithMinusPrefix()] = $option->value;
        }

        $commandParamPart = ['command' => $command->name];
        $params = array_merge($commandParamPart, $arguments, array_merge($options, $multiValueOptions));

        $input = new ArrayInput($params);

        try {
            $this->console->run($input, $output);
        } catch (\Exception $exception) {
            $output->writeln(
                sprintf('<error>Exception [%s]: %s</error>', get_class($exception), $exception->getMessage()),
                OutputInterface::VERBOSITY_QUIET
            );

            $output->writeln($exception->getTraceAsString(), OutputInterface::VERBOSITY_QUIET);
        }
    }
}