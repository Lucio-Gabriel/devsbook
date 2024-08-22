<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class HomeController extends Controller {

    // vai armazenar o usuario que está logado
    private $loggedUser;

    // primeiro que vai executar e vai verificar se o user está logado
    public function __construct(){
        $this->loggedUser = LoginHandler::checkLogin();
        if($this->loggedUser === false){
            $this->redirect('/login');
        }
    }
    
    public function index() {
        $this->render('home', ['nome' => 'Bonieky']);
    }

}