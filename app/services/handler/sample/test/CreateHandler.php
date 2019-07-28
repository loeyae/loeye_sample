<?php

/**
 * CreateHandler.php
 *
 * Licensed under the Apache License, Version 2.0 (the "License"),
 * see LICENSE for more details: http://www.apache.org/licenses/LICENSE-2.0.
 *
 * @author  Zhang Yi <loeyae@gmail.com>
 * @version 2019-7-28 23:25:31
 */
namespace app\services\handler\sample\test;
/**
 * CreateHandler
 *
 * @author   Zhang Yi <loeyae@gmail.com>
 */
class CreateHandler extends \app\services\handler\AbstractHandler
{

    /**
     * @var bool is restrict access
     */
    protected $access = true;

    /**
     * @var bool is oauth
     */
    protected $oauth = true;

    /**
     * @var string method
     */
    protected $method = 'GET';

    /**
     * @var object server
     */
    protected $server;

    /**
     * initServer
     *
     * @return Server
     */
    protected function initServer()
    {
        $this->server = new \app\services\server\SampleServer($this->context->getAppConfig());
    }

    /**
     * operate
     *
     * @param array $req req data
     *
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function operate($req)
    {
        $entity = new \app\models\entity\sample\User();
        $entity->setName($this->queryParameter["name"]);
        $entity->setPassword($this->queryParameter["pwd"]);
        return $this->server->createMember($entity);
    }

}
