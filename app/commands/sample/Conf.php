<?php

/**
 * Conf.php
 *
 * Licensed under the Apache License, Version 2.0 (the "License"),
 * see LICENSE for more details: http://www.apache.org/licenses/LICENSE-2.0.
 *
 * @author  Zhang Yi <loeyae@gmail.com>
 * @version SVN: $Id: Zhang Yi $
 */
namespace app\commands\sample;

use loeye\console\Command;
use \Symfony\Component\Console\{
    Input\InputInterface,
    Output\OutputInterface
};

/**
 * Conf
 *
 * @author   Zhang Yi <loeyae@gmail.com>
 */
class Conf extends Command
{

//    protected $name   = 'app:sample\conf';
    protected $args   = [
        ['args', 'required' => false, 'help' => 'args', 'default' => 'default']
    ];
    protected $params = [
        ['params', 'p', 'required' => false, 'help' => 'params', 'default' => 'params']
    ];

    /**
     * process
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    public function process(InputInterface $input, OutputInterface $output)
    {
        $configDirectories = [__DIR__.'/../../conf/sample/app'];

        $fileLocator = new \Symfony\Component\Config\FileLocator($configDirectories);
        $container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
        $loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader($container, $fileLocator);
        $loader->load("master.yml");
        var_dump($loader->getResolver());
        $output->writeln('test a command');
    }

}
