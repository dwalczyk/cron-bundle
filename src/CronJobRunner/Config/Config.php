<?php

declare(strict_types=1);

namespace Dawid\CronBundle\CronJobRunner\Config;

final class Config
{
    public function __construct(
        private readonly array $commands = []
    ) {
    }

    public function getPreparedCommands(): array
    {
        return \array_map(function(array $command) {
            return $this->prepareCommand($command);
        }, $this->commands);
    }

    private function prepareCommand(array $array): Command
    {
        $args = $opts = $multiVOpts = [];

        foreach ($array['arguments'] as $name => $value) {
            $args[] = new CommandArgument($name, $value);
        }

        foreach ($array['options'] as $name => $value) {
            $opts[] = new CommandOption($name, $value);
        }

        foreach ($array['multi_value_options'] as $name => $value) {
            $multiVOpts[] = new CommandOption($name, $value);
        }

        return new Command($array['name'], $array['cron_expression'], $args, $opts, $multiVOpts, $array['enabled']);
    }
}
