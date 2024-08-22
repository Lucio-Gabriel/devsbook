<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {

    // criando uma view
    public function signin(){
        // verificando se tem mensagem de flash
        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('login', [
            'flash' => $flash
        ]);
    }

    public function signinAction(){
        // recebendo email e senhas
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        // fazendo a verificação
        if($email && $password){

            $token = LoginHandler::verifyLogin($email, $password);
            if($token){
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else{
                $_SESSION['flash'] = 'E-mail e/ou senha não conferem.';
                $this->redirect('/login');
            }
        }   
        else {
            $_SESSION['flash'] = 'Digite os campos de e-mail e/ou senha.';
            $this->redirect('/login');
        }
    }

    public function signup(){
        echo 'cadastro';
    }
}