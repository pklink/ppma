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
     * @var array
     */
    protected $settings;

    /**
     * @var \stdClass
     */
    protected $user;


    /**
     * AbstractAction constructor
     * @see \Action::__construct()
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->user     = $container['jwt']->user;
        $this->db       = $container->get('db');
        $this->logger   = $container->get('logger');
        $this->settings = $container->get('settings');
    }

    /**
     * @param string $neededPermission
     * @return bool
     */
    protected function hasAccessTo(string $neededPermission) {
        return in_array($neededPermission, $this->user->permissions);
    }

}
