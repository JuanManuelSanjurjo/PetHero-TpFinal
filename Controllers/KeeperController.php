<?php

namespace Controllers;

use DAO\KeeperDAO;
use Models\Keeper;
use Models\TimeInterval;

class KeeperController{
    private $KeeperDao;


    function __construct(){
        $this->KeeperDao = new KeeperDAO();
    }

    public function keeperExist($email){
        $keeper = $this->KeeperDao->getByEmail($email);
        
        return $keeper;
    }

    public function showKeeperList(){
        $keeperList = $this->KeeperDao->getAll();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."filter-Keepers.php");
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
        $this->KeeperDao->setCompensation($compensation);
        $this->showHomeView();
    }

    public function addAvilability ($dateStart,$dateEnd){
        var_dump($dateStart);
        $date1=date_create($dateStart);
        $date2=date_create($dateEnd);
        
        if(date_diff($date1,$date2) < 0){
            $this->showHomeView("End date cant be less than start date");   
        }else{
            $date = new TimeInterval();
            $date->setStart($date1);
            $date->setEnd($date2);
            var_dump($date);
            
            $this->KeeperDao->addAvilability($date);
        }
    }

    public function showHomeView($message = ""){
        echo $message;
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