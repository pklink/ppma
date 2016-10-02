<?php


namespace ppma\Action;


use Illuminate\Database\Capsule\Manager;
use Monolog\Logger;
use ppma\Action;
use Slim\Container;
use Slim\Http\Request;

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
     * AbstractAction constructor
     * @see \Action::__construct()
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->db       = $container->get('db');
        $this->logger   = $container->get('logger');
        $this->settings = $container->get('settings');
    }

    /**
     * @param Request $request
     * @param string $neededPermission
     * @return bool
     */
    protected function hasAccessTo(Request $request, string $neededPermission) {
        /* @var \stdClass $token */
        $token = $request->getAttribute('token');

        return in_array($neededPermission, $token->user->permissions);
    }

}
