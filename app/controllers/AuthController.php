<?php
/**
 * Created by PhpStorm.
 * User: rum
 * Date: 14.01.20
 * Time: 21:00
 */

namespace app\controllers;


use core\Auth;
use app\models\User;

class AuthController extends CommonController
{
    public function loginAction(){
        if (Auth::isLogin()){
            redirect();
        }

        if ($this->autoLogin()){
            redirect('/');
        };

        if (!empty($_POST)) {
            if (Auth::login()) {
//                dd($_SESSION['auth']);
                redirect('/');
            } else {
                Auth::getErrors();
                redirect();
            }
        }

        $this->render('auth/login');
    }

    protected function autoLogin(){
        if (isset($_COOKIE['password_cookie_token']) && !empty($_COOKIE['password_cookie_token'])) {

            $user = User::query()->where('password_cookie_token', $_COOKIE['password_cookie_token'])->first();
            if ($user) {

                $_SESSION['auth'] = $user->attributesToArray();
                return true;

            } else return false;

        } else return false;
    }



    public function authAjaxAction(){

        if (!$this->isAjax()){
            redirect('/');
        }

        if (Auth::login()){
            $data = [
                'code'=>200
            ];
        } else {
            $data = [
                'code' => 422,
                'errors' => Auth::getErrors()
            ];
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function logoutAction()
    {
        if (Auth::isLogin()) {
            $auth = $_SESSION['auth'];
            $user = User::find($auth['id']);
            $user->password_cookie_token = '';
            $user->save();

            setcookie('password_cookie_token', '', time()-3600*24*30*12, '/');
            session_unset();
        }

        redirect('/');
    }

}