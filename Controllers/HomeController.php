<?php
namespace Controllers;

use DAO\UserDao as UserDao;
use Models\User as User;

class HomeController{
    private $UserDao;  

    function __construct(){
        $this->UserDao = new UserDao();
        
    }

    public function register($email, $name, $surname, $password, $repeatPass, $userName, $userType){

        if(!$this->confirmPassword($password, $repeatPass)){
            echo '<script>alert("Las contraseñas no coinciden, intente nuevamente")</script>';
            $this->showRegisterView();
        }else if($this->UserDao->getByEmail($email)){
            echo '<script>alert("Ya existe un usuario registrado con este email")</script>';
            session_destroy(); // NO SE SI CON EL FRAMEWORK ESTO VA ACA
            $this->showRegisterView();
        }
        else{
            if(!$this->checkMail($email)){
                echo '<script>alert("Ingrese un formato de Email valido")</script>';
                session_destroy(); // NO SE SI CON EL FRAMEWORK ESTO VA ACA
                $this->showRegisterView();
            }else if(!$this->checkPassword($password)){
                echo '<script>alert("Su contraseña debe tener un minimo de 8 caracteres, una mayuscula,  un numero y una minusculas para ser valido ")</script>';
                session_destroy(); // NO SE SI CON EL FRAMEWORK ESTO VA ACA
                $this->showRegisterView();
            }else{
                $user = new User();
                $user->setMail($email);
                $user->setPassword($password);
                $user->setUserName($userName);
                $user->setName($name);
                $user->setSurname($surname);
                $user->setUserType($userType);
    
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

    public function showKeeperList(){

        /// HAY QUE HACER VISTA Y FUNCION
    }


    public function login($email,$pass){
        $user = $this->UserDao->getByEmail($email);
      
        if($user!=null && $user->getPassword() == $pass){
            $this->showHomeView($user->getUserType());
        }else{
            echo '<script>alert("Las credenciales no coinciden, intente nuevamente")</script>';
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