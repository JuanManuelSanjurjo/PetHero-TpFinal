<?php

namespace Controllers;

use DAO\OwnerDAO;
use Models\Owner;

class OwnerController{
    private $OwnerDao;

    function __construct(){
        $this->OwnerDao = new OwnerDAO();
    }

    public function ownerExist($email){
        $owner = $this->OwnerDao->getByEmail($email);
        
        return $owner;
    }

    public function showHomeView($message = ""){
        echo $message;
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."home-owner.php");
    }
  
    public function register($email, $name, $surname, $pass, $userName, $userType){

        $user = new Owner();   

        $user->setMail($email);
        $user->setPassword($pass);
        $user->setUserName($userName);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setUserType($userType);
                
        $_SESSION["loggedUser"]= $user; 
        
        $this->OwnerDao->register($user);

        
    }

   

    


}

?>