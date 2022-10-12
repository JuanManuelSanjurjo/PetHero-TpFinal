<?php
    namespace Controllers;

    class HomeController{
        private $UserDao;  // HAY QUE DEFINIR


        public function Index($message = "")
        {
            echo $message; 
            require_once(VIEWS_PATH."login.php");
        }        

        public function showHomeView($message ="")
        {
            require_once(VIEWS_PATH."home.php");
        }


        public function login($email,$pass){
          
        if($email == "juanmanuelsanjurjo@hotmail.com" && $pass == 123){
            $this->showHomeView();

        }else{
            echo '<script>alert("Las credenciales no coinciden, intente nuevamente")</script>';
            session_destroy(); // no se si va esto aca
            $this->Index();
        }

        }

        public function showRegisterView($message = ""){
            echo $message; // no se si funciona asi o hay que pasar el mensaje de otra manera
            require_once(VIEWS_PATH."register.php");
        }

        public function register($email,$pass,$passRepeat){

            $userList = $this->userDAO->getUsers();// GET DE LISTA DE USUARIOS   HAY QUE IMPLEMENTAR

            if(in_array($email,$userList)){
                echo '<script>alert("Ya existe un usuario registrado con este email")</script>';
                session_destroy(); // no se si va esto aca
                $this->showRegisterView();
            }    
            
            if($pass === $passRepeat){
                //CREAR USER
                $this->showHomeView();
             }else if($pass != $passRepeat){
                $this->showRegisterView("Las contraseñas no coinciden, intentelo nuevamente");
            }

        }









    }
?>