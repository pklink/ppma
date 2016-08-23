<?php


namespace ppma\Action;


use Illuminate\Database\Capsule\Manager;
use Monolog\Logger;
use ppma\Action;
use Slim\Container;

abstract class AbstractAction implements Action
{

    /**
     * @var Manager
     */
    protected $db;

    /**
     * @var Logger
     */
    protected $logger;


    /**
     * AbstractAction constructor
     * @see \Action::__construct()
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->db     = $container->get('db');
        $this->logger = $container->get('logger');
    }


}
