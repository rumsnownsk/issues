<?php

namespace app\controllers;

use core\Auth;
use DI\DependencyException;
use DI\NotFoundException;
use League\Plates\Engine;

abstract class CommonController
{
    public $view;
    public $vars = array();

    public function __construct()
    {
        global $container;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        try {
            $this->view = $container->get(Engine::class);
        } catch (DependencyException $e) {
            echo 'DependencyException: ' . $e->getMessage();
        } catch (NotFoundException $e) {
            echo 'NotFoundException: ' . $e->getMessage();
        }

        $auth = new Auth();

        if (isset($_SESSION['auth'])) {

            $auth->setAttributes($_SESSION['auth']);

        };
        $this->vars['auth'] = $auth;

    }

    public function render($pathToView, array $data = array())
    {
        $data = array_merge($this->vars, $data);

        echo $this->view->render($pathToView, $data);
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}