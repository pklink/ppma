<?php


namespace ppma\Action;


use Illuminate\Database\Capsule\Manager;
use ppma\Action;
use Slim\Container;

abstract class AbstractAction implements Action
{

    /**
     * @var Manager
     */
    protected $db;


    /**
     * AbstractAction constructor
     * @see \Action::__construct()
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->db = $container->get('db');
    }


}