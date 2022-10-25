<?php
namespace Controllers;

use DAO\PetDao as PetDao;
use Models\Pet as Pet;
use DAO\UserDao as UserDao;
use Models\User as User;

class PetController{
    private $PetDao;  
    private $UserDao;  
    
    function __construct(){
        $this->PetDao = new PetDao();
        $this->UserDao = new UserDao();
    }

    public function registerPet($petType, $name, $breed, $size, $photo, $vaxPlanImg, $observations){
        $user = $_SESSION["loggedUser"];

        $pet = new Pet();
        
        $pet->setPetType($petType);
        $pet->setIdOwner($user->getId());
        $pet->setName($name);
        $pet->setPhoto($photo);
        $pet->setBreed($breed);
        $pet->setSize($size);
        $pet->setVaxPlanImg($vaxPlanImg);
        $pet->setObservations($observations);
        
        $this->PetDao->register($pet); 

        require_once(VIEWS_PATH."home-owner.php");
    }

    public function Index($message = "")
    {
        echo $message; 
        require_once(VIEWS_PATH."login.php");
    }        

    public function showHomeView($userType)
    {
        if($userType == "owner"){
            require_once(VIEWS_PATH."home-owner.php");
        }else if($userType == "keeper"){
            require_once(VIEWS_PATH."home-keeper.php");
        }else{
            require_once(VIEWS_PATH."home.php");  // LUEGO SI SE PUEDE SER LOS DOS, LO USAREMOS (contiene todas las opciones)
        }
    }

    public function showAddPet(){
        require_once(VIEWS_PATH."add-pet.php");  
    }

    public function showPetList(){

        if(isset($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."pet-list.php");  
        }else{
            require_once(VIEWS_PATH."login.php");  
        } 
    }

    public function showMyPetList(){
        $petList=$this->PetDao->getAll();
        if(isset($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."pet-list.php");
        }
    }

    
    
    
}
?>