<?php
namespace Controllers;

use DAO\UserDao as UserDao;
use Models\User as User;
use Models\Keeper as Keeper;
use Models\Owner as Owner;
use DAO\OwnerDao as OwnerDao;
use DAO\KeeperDAO as KeeperDao;

class HomeController{
    private $UserDao;  
    private $OwnerDao;  
    private $KeeperDao;  

    function __construct(){
      //  $this->UserDao = new UserDao();
        $this->OwnerDao = new OwnerDao();
        $this->KeeperDao = new KeeperDao();
        
    }

    public function register($email, $name, $surname, $pass, $repeatPass, $userName, $userType){

        if(!$this->confirmPassword($pass, $repeatPass)){ 
           // echo '<script>alert("Passwords dont match, try again")</script>'; 
            $this->showRegisterView("Passwords dont match, try again"); 
        }else if($this->userExist($email)){ 
            //echo '<script>alert("There isalready a user registered with this email ")</script>'; 
            session_destroy(); 
            $this->showRegisterView("There isalready a user registered with this email ");
        }
        else{
            if(!$this->checkMail($email)){ 
               // echo '<script>alert("Provide a valid email adress format")</script>'; 
                session_destroy(); 
                $this->showRegisterView("Provide a valid email adress format"); 
            }else if(!$this->checkPassword($pass)){ 
                //echo '<script>alert("Your password must include a minimum of 8 characters, one uppercase, one lowercase and one number to be valid")</script>';
                session_destroy(); 
                $this->showRegisterView("Your password must include a minimum of 8 characters, one uppercase, one lowercase and one number to be valid"); 
            }else{
                if($userType instanceof Keeper){ 
                    $keeperController = new KeeperController();
                    $keeperController->register($email, $name, $surname, $pass, $userName, $userType);
                    $keeperController->showHomeView();

                }else{
                    $OwnerController = new OwnerController();
                    $OwnerController->register($email, $name, $surname, $pass, $userName, $userType);
                    $OwnerController->showHomeView();  
                }
                
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
/*
    public function showHomeView(){
        require_once(VIEWS_PATH."validate-session.php");
        
        $user=$_SESSION["loggedUser"];

        if($user instanceof Owner){
            require_once(VIEWS_PATH."home-owner.php");
        }else if($user instanceof Keeper){
            require_once(VIEWS_PATH."home-keeper.php");
        }else{
            require_once(VIEWS_PATH."home.php");  // LUEGO SI SE PUEDE SER LOS DOS, LO USAREMOS (contiene todas las opciones)
        }
    }
*/
    public function userExist($email){
        $keeper = $this->KeeperDao->getByEmail($email);

        $owner = $this->OwnerDao->getByEmail($email);

        if($keeper != null){
            return $keeper;
        }else if($owner != null){
            return $owner;
        }else{
            return null;
        }
    }

    public function login($email,$pass){
        //$user = $this->UserDao->getByEmail($email);
        $user = $this->userExist($email);

        if($user!=null && $user->getPassword() == $pass){
            $_SESSION["loggedUser"]= $user; 
            
            if($user instanceof Keeper){
                $keeperC = new KeeperController();
                $keeperC->showHomeView();
            }else if($user instanceof Owner){
                $OwnerC = new OwnerController();
                $OwnerC->showHomeView();
            }
        }else{
            //echo '<script>alert("Credentials dont match, try again")</script>';
            session_destroy(); 
            $this->Index("Credentials dont match, try again");
        }
    }


    public function logout(){
        session_destroy();
        $this->Index("Deslogueado exitoso");
    }
   
    public function showRegisterView($message = ""){
        echo $message; // no se si funciona asi o hay que pasar el mensaje de otra manera
        require_once(VIEWS_PATH."register.php");
    }

}   
    
?>