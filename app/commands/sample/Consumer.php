<?php

/**
 * Consumer.php
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"),
 * see LICENSE for more details: http://www.apache.org/licenses/LICENSE-2.0.
 * 
 * @author  Zhang Yi <loeyae@gmail.com>
 * @version SVN: $Id: Zhang Yi $
 */

namespace app\commands\sample;

use \loeye\console\Command;
use \PhpAmqpLib\ {
    Connection\AMQPStreamConnection,
    Exception\AMQPRuntimeException,
    Message\AMQPMessage
};
use \Symfony\Component\Console\ {
    Input\InputInterface,
    Output\OutputInterface,
    Style\SymfonyStyle
};

const WAIT_BEFORE_RECONNECT_uS = 1000000;

/**
 * Consumer
 *
 * @author   Zhang Yi <loeyae@gmail.com>
 */
class Consumer extends Command {

    protected $name = 'app:sample-consumer';
    protected $desc = 'sample amqp consumer with multi process';
    protected $args = [
        ['property', 'required' => true, 'help' => 'property name']
    ];
//    protected $params = [
//        ['params', 'p', 'required' => false, 'help' => 'params', 'default' => 'params']
//    ];

    /**
     *
     * @var \loeye\base\AppConfig
     */
    protected $appConfig;

    /**
     * process
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    public function process(InputInterface $input, OutputInterface $output): void
    {
        $property         = $input->getArgument('property');
        $this->appConfig  = $this->loadAppConfig($property);
        $rabbitmqSettings = $this->appConfig->getSetting('rabbitmq');
        $ui               = new SymfonyStyle($input, $output);
        $pool            = [];
        foreach ($rabbitmqSettings as $rabbitmqSetting) {
            foreach ($rabbitmqSetting['queue'] as $queueSetting) {
                $pool[]  = $process = new \Swoole\Process(function() use ($ui, $rabbitmqSetting, $queueSetting) {
                    $this->consume($ui, $rabbitmqSetting['servers'], $queueSetting);
                });
            }
        }

        foreach ($pool as $process) {
            $process->start();
        }

        for ($n = count($pool); $n--;) {
            $status = \Swoole\Process::wait(true);
            echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
        }
        $output->writeln('test a command');
    }

    /**
     * consume
     * 
     * @param SymfonyStyle $ui              instance of SymfonyStyle
     * @param array        $rabbitmqServers rabbitmq servers setting
     * @param array        $rabbitmqQueue   rabbitmq queue setting
     * 
     * @return void
     */
    protected function consume(SymfonyStyle $ui, array $rabbitmqServers, array $rabbitmqQueue): void
    {
        while (true) {
            $connection = static::connect($rabbitmqServers);
            try {
                \register_shutdown_function(function($connection) {
                    $connection->close();
                }, $connection);

                $queue       = $rabbitmqQueue['name'];
                $consumerTag = $rabbitmqQueue['tag'];
                $channel     = $connection->channel();
                $channel->queue_declare($queue, false, true, false, false);
                if (isset($rabbitmqQueue['exchange'])) {
                    $type = isset($rabbitmqQueue['exchange_type']) ? $rabbitmqQueue['exchange_type'] : 'topic';
                    $channel->exchange_declare($rabbitmqQueue['exchange'], $type);
                    $routing_key = isset($rabbitmqQueue['routing_key']) ? $rabbitmqQueue['routing_key'] : '';
                    $channel->queue_bind($queue, $rabbitmqQueue['exchange'], $routing_key);
                }
                $callback  = isset($rabbitmqQueue['callback']) ? $rabbitmqQueue['callback'] : null;
                $ack = isset($rabbitmqQueue['ack']) ? $rabbitmqQueue['ack'] : false;
                $channel->basic_consume($queue, $consumerTag, false, false, false, false, function(AMQPMessage $message) use ($ui, $queue, $callback, $ack) {
                    if (is_callable($callback)) {
                        call_user_func($callback, $message, $ui);
                    } else {
                        $ui->comment(sprintf('The %s\'s consumer got message: %s', $queue, $message->getBody()));
                    }
                    if ($ack) {
                        $message->get('channel')->basic_ack($message->get('delivery_tag'));
                    }
                });
                while ($channel->is_consuming()) {
                    $channel->wait();
                }
            } catch (AMQPRuntimeException $e) {
                $ui->error($e->getTraceAsString());
                self::cleanupConnection($connection);
                usleep(\app\commands\sample\WAIT_BEFORE_RECONNECT_uS);
            } catch (\RuntimeException $e) {
                $ui->error($e->getTraceAsString());
                self::cleanupConnection($connection);
                usleep(\app\commands\sample\WAIT_BEFORE_RECONNECT_uS);
            } catch (\ErrorException $e) {
                $ui->error($e->getTraceAsString());
                self::cleanupConnection($connection);
                usleep(\app\commands\sample\WAIT_BEFORE_RECONNECT_uS);
            }
        }
    }

    /**
     * connect
     * 
     * @param array $rabbitmqServers rabbitmq settings
     * 
     * @return AMQPStreamConnection
     */
    static public function connect(array $rabbitmqServers): AMQPStreamConnection
    {
        return AMQPStreamConnection::create_connection($rabbitmqServers,
                        [
                            'insist'             => false,
                            'login_method'       => 'AMQPLAIN',
                            'login_response'     => null,
                            'locale'             => 'zh_CN',
                            'connection_timeout' => 3.0,
                            'read_write_timeout' => 3.0,
                            'context'            => null,
                            'keepalive'          => false,
                            'heartbeat'          => 0
        ]);
    }

    /**
     * cleanupConnection
     * 
     * @param AMQPStreamConnection $connection instance of AMQPStreamConnection
     * 
     * @return void
     */
    static public function cleanupConnection(AMQPStreamConnection $connection): void
    {
        try {
            if ($connection !== null) {
                $connection->close();
            }
        } catch (\ErrorException $e) {
            \loeye\base\Logger::error($e->getTraceAsString());
        }
    }
    
    /**
     * 
     * @param AMQPMessage $message
     * @param SymfonyStyle $ui
     * 
     * @return void
     */
    static public function exec(AMQPMessage $message, SymfonyStyle $ui): void
    {
        $ui->error(sprintf('process %s got message: %s', posix_getpid(), $message->body));
    }

}
