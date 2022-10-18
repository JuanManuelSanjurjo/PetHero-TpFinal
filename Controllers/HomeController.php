<?php
namespace Controllers;

use DAO\UserDao as UserDao;
use Models\User as User;
use Models\Keeper as Keeper;
use Models\Owner as Owner;

class HomeController{
    private $UserDao;  

    function __construct(){
        $this->UserDao = new UserDao();
    }

    public function register($email, $name, $surname, $pass, $repeatPass, $userName, $userType){

        if(!$this->confirmPassword($pass, $repeatPass)){
            echo '<script>alert("Passwords dont match, try again")</script>';
            $this->showRegisterView();
        }else if($this->UserDao->getByEmail($email)){
            echo '<script>alert("There isalready a user registered with this email ")</script>';
            session_destroy(); // NO SE SI CON EL FRAMEWORK ESTO VA ACA
            $this->showRegisterView();
        }
        else{
            if(!$this->checkMail($email)){
                echo '<script>alert("Provide a valid email adress format")</script>';
                session_destroy(); // NO SE SI CON EL FRAMEWORK ESTO VA ACA
                $this->showRegisterView();
            }else if(!$this->checkPassword($pass)){
                echo '<script>alert("Your password must include a minimum of 8 characters, one uppercase, one lowercase and one number to be valid")</script>';
                session_destroy(); // NO SE SI CON EL FRAMEWORK ESTO VA ACA
                $this->showRegisterView();
            }else{
                if($userType == "keeper"){
                    $user = new Keeper();  
                }else{
                    $user = new Owner();  
                }
                $user->setMail($email);
                $user->setPassword($pass);
                $user->setUserName($userName);
                $user->setName($name);
                $user->setSurname($surname);
                $user->setUserType($userType);

                $_SESSION["loggedUser"]= $user; 
    
                $this->UserDao->register($user);
                
                $this->showHomeView($user->getUserType());
            }
        }  
    }

    public function checkMail($email){
        $regexEmail = "/^([a-z\\d\\._-]{1,30})@([a-z\\d_-]{2,15})\\.([a-z]{2,8})(\\.[a-z]{2,8})?$/";
        if(preg_match($regexEmail,$email)){
            return true;
        }
        return false;
    }
    public function checkPassword($password){
        $regexPassword = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\\S+$).{8,15}$/";
        if(preg_match($regexPassword,$password)){
            return true;
        }
        return false;
    }

    public function confirmPassword($pass,$repeat){
        if($pass === $repeat){
            return true;
        }
        return false;
    }

    public function Index($message = "")
    {
        echo $message; 
        require_once(VIEWS_PATH."login.php");
    }        

    public function showHomeView(){
        require_once(VIEWS_PATH."validate-session.php");
        
        $user=$_SESSION["loggedUser"];

        if($user->getUserType()== "owner"){  // o instance of
            require_once(VIEWS_PATH."home-owner.php");
        }else if($user->getUserType()== "keeper"){  // o instance of
            require_once(VIEWS_PATH."home-keeper.php");
        }else{
            require_once(VIEWS_PATH."home.php");  // LUEGO SI SE PUEDE SER LOS DOS, LO USAREMOS (contiene todas las opciones)
        }
    }

    public function showKeeperList(){
        $keeperList = $this->UserDao->getKeepers();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."keeper-list.php");
    }

    public function showTypeOfPet(){
        if(isset($_SESSION["loggedUser"])){
            require_once(VIEWS_PATH."type-pets.php");
        }else{
            $this->Index();
        }
    }

    public function setPetType($size){
       $this->UserDao->setPetType($size);
       if(isset($_SESSION["loggedUser"])){
        $this->showHomeView($_SESSION["loggedUser"]->getUserType());
       }else{
        $this->Index();
       }
    }

    public function setCompensation($compensation){
        $this->UserDao->setCompensation($compensation);
        $this->showHomeView($_SESSION["loggedUser"]->getUserType());
    }


    public function addAvilability ($dates){
        $this->UserDao->addAvilability($dates);
        $this->showHomeView($_SESSION["loggedUser"]->getUserType());
    }

    public function login($email,$pass){
        $user = $this->UserDao->getByEmail($email);
      
        if($user!=null && $user->getPassword() == $pass){
            $_SESSION["loggedUser"]= $user; 
            $this->showHomeView($user->getUserType());
        }else{
            echo '<script>alert("Credentials dont match, try again")</script>';
            session_destroy(); // no se si va esto aca
            $this->Index();
        }
    }
    public function logout(){
        session_destroy();
        $this->Index();
    }
   
    public function showRegisterView($message = ""){
        echo $message; // no se si funciona asi o hay que pasar el mensaje de otra manera
        require_once(VIEWS_PATH."register.php");
    }

}   
    
?> 