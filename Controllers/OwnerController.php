<?php

namespace Controllers;

use Models\Owner;
use DAO\OwnerDAO as OwnerDAO;
//use Models\Pet as Pet;

class OwnerController{
    private $OwnerDAO;

    function __construct(){
        $this->OwnerDAO = new OwnerDAO();
    }

    public function ownerExist($email){
        $owner = $this->OwnerDAO->getByEmail($email);
        return $owner;
    }

    public function showHomeView($message = ""){
        
        if($message){
            HomeController::showMessage($message);
        }
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."home-owner.php");
    }


    public function showMyPetList(){
        $user = $_SESSION["loggedUser"];
        $list = $user->getPetList();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."pet-list.php");
     }

     public function showAddPet(){
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."add-pet.php");  
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
        
        $this->OwnerDAO->register($user);

    }

    public function removePet($petId){
        
       $this->OwnerDAO->removePet($petId);
       $ownerDao = new OwnerDAO();
       $user = $_SESSION["loggedUser"];
       $_SESSION["loggedUser"] = $ownerDao->getById($user->getId());
       
       HomeController::showMessage("Pet removed succesfully");
        $this->showMyPetList();
    }

    public function showPetModify(){
        $user = $_SESSION["loggedUser"];
        $list = $user->getPetList();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."modify-pet.php");

    }

    

}

?>