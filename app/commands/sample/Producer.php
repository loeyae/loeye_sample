<?php

/**
 * Producer.php
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"),
 * see LICENSE for more details: http://www.apache.org/licenses/LICENSE-2.0.
 * 
 * @author  Zhang Yi <loeyae@gmail.com>
 * @version SVN: $Id: Zhang Yi $
 */
namespace app\commands\sample;

use \app\commands\sample\Consumer,
    \loeye\console\Command;
use \PhpAmqpLib\ {
    Exchange\AMQPExchangeType,
    Message\AMQPMessage
};
use \Symfony\Component\Console\ {
    Input\InputInterface,
    Output\OutputInterface,
    Style\SymfonyStyle
};

/**
 * Producer
 *
 * @author   Zhang Yi <loeyae@gmail.com>
 */
class Producer extends Command {

    protected $name   = 'app:sample-producer';
    protected $desc   = 'sample amqp producer';
    protected $args   = [
        ['property', 'required' => true, 'help' => 'property name'],
        ['message', 'required' => true, 'help' => 'message'],
    ];
    protected $params = [
        ['queue', 'u', 'required' => false, 'help' => 'queue name', 'default' => null],
        ['exchange', 'e', 'required' => false, 'help' => 'exchange name', 'default' => null],
        ['exchange-type', 't', 'required' => false, 'help' => 'exchange type', 'default' => AMQPExchangeType::TOPIC],
        ['routing', 'r', 'required' => false, 'help' => 'routing key', 'default' => null],
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
        $property         = $input->getArgument('property');
        $msg              = $input->getArgument('message');
        $message          = new AMQPMessage($msg);
        $queue            = $input->getOption('queue');
        $exchange         = $input->getOption('exchange');
        $exchangeType     = $input->getOption('exchange-type');
        $routing          = $input->getOption('routing');
        $this->appConfig  = $this->loadAppConfig($property);
        $rabbitmqSettings = $this->appConfig->getSetting('rabbitmq');
        $ui               = new SymfonyStyle($input, $output);
        $connection       = Consumer::connect($rabbitmqSettings[0]['servers']);
        $channel          = $connection->channel();
        if ($exchange) {
            $channel->exchange_declare($exchange, $exchangeType, $routing);
        }
        if ($queue) {
            $channel->queue_declare($queue, false, true, false, false);
            $channel->basic_publish($message);
        } else {
            $channel->basic_publish($message, $exchange, $routing);
        }
        $ui->writeln('send message success');
    }

}
