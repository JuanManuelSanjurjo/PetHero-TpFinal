<?php

namespace Controllers;

use DAO\KeeperDAO;
use Models\Keeper;

class KeeperController{
    private $KeeperDao;

    function __construct(){
        $this->KeeperDao = new KeeperDAO();
    }


    public function showTypeOfPet(){
        if(isset($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."type-pets.php");
        }else{
            $home = new HomeController(); // aca o en el contructor?
            $home->Index();
        }
    }

    public function setPetType($size){
       $this->KeeperDao->setPetType($size);
       if(isset($_SESSION["loggedUser"])){
        $this->showHomeView();
       }else{
        $home = new HomeController(); // aca o en el contructor?
        $home->Index();
       }
    }

    public function setCompensation($compensation){
        $this->UserDao->setCompensation($compensation);
        $this->showHomeView();
    }


    public function addAvilability ($dates){
        $this->UserDao->addAvilability($dates);
        $this->showHomeView();      
    }

    public function showHomeView(){
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."home-keeper.php");
    }

    public function register($email, $name, $surname, $pass, $userName, $userType){

        $user = new Keeper();   

        $user->setMail($email);
        $user->setPassword($pass);
        $user->setUserName($userName);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setUserType($userType);
                
        $_SESSION["loggedUser"]= $user; 
        
        $this->KeeperDao->register($user);

    }




    


}

?>