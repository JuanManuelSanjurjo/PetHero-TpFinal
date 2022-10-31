<?php

namespace Controllers;

use DAO\OwnerDAO;
use Models\Owner;
use Models\Pet as Pet;

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


    public function showMyPetList(){

        $user = $_SESSION["loggedUser"];
         if(isset($_SESSION["loggedUser"])){
             require_once(VIEWS_PATH."pet-list.php");
         }
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
        
        $this->OwnerDao->register($user);

        
    }

    public function registerPet($petType, $name, $breed, $size, $observations){
        require_once(VIEWS_PATH."validate-session.php");
        $user = $_SESSION["loggedUser"];

        $pet = new Pet();

        $pet->setIdOwner($user->getId());
        $pet->setName($name);
        $pet->setBreed($breed);
        $pet->setSize($size);
        $pet->setObservations($observations);
        $pet->setPetType($petType);

        $this->OwnerDao->registerPet($pet);

        require_once(VIEWS_PATH."add-files.php");

        //require_once(VIEWS_PATH."home-owner.php");
    }


    
    private function checkImgFiles($file,$user,$pet,$type){
        $fileExtExplode = explode('.',$file['name']);
        $fileExt = strtolower(end( $fileExtExplode));
        
        if($type !='video'){
            if($type == 'vaxImg'){
                $fileName = $user->getId() . '_' . $pet->getId() .'_vaxplan.' . $fileExt;
            }elseif($type == 'profile'){
                $fileName = $user->getId() . '_' . $pet->getId() . '.' . $fileExt;
            }
            $fileDestination = ROOT.VIEWS_PATH."user-images/" . $fileName ;

            $allowed = array('jpeg','jpg','pdf','gif','png','jfif');
    
            $size = 50000000;

        }else{
            $fileName = $user->getId() . '_' . $pet->getId() .'_video.' . $fileExt;
            $fileDestination = ROOT.VIEWS_PATH."user-videos/" . $fileName ;
            $allowed = array('mkv','mov','mp4','264','mpg4','avi');

            $size = 2000000000;
        }

        if(in_array($fileExt,$allowed)){
            if($file['error'] == 0){
                if($file['size'] < $size ){   //20mb
                    move_uploaded_file($file['tmp_name'],$fileDestination);
                    echo '<script>alert("your file:  ' . $file['name'] . ', was uploaded succesfully")</script>';
                } else{
                    echo '<script>alert("The file is too big")</script>';
                    $this->cancelPetRegister($pet->getId());
                    unlink($fileDestination);
                }
            }else{
                echo '<script>alert("There was an error uploading your file")</script>';
                $this->cancelPetRegister($pet->getId());
                unlink($fileDestination);
            }
        }else{
            echo '<script>alert("there was an error uploading files, try again")</script>';
            $this->cancelPetRegister($pet->getId());
            unlink($fileDestination);
        }

        return $fileName;
    }

    public function uploadFile(){
        require_once(VIEWS_PATH."validate-session.php");
        $user = $_SESSION["loggedUser"];
        $dao = $this->OwnerDao;
        $pet = $dao->getPetById($dao->getNextPetId()-1);

        $size = (int) $_SERVER['CONTENT_LENGTH'];   

        if(isset($_POST)  )  {

                $photo = $_FILES['photo'];
                    
                $photoName = $this->checkImgFiles($photo,$user,$pet,'profile');
    
                $vaxPlanImg = $_FILES['vaxPlanImg'];
    
                $vaxImgName = $this->checkImgFiles($vaxPlanImg,$user,$pet,'vaxImg');
    
                $pet->setPhoto($photoName);
                $pet->setVaxPlanImg($vaxImgName);
                
                if($_FILES['video']['size'] != 0){
                    $video = $_FILES['video'];
    
                    $videoFileName =  $this->checkImgFiles($video,$user,$pet,'video');
                    $pet->setVideo($videoFileName); 
                }
                
            }

            
        $this->OwnerDao->addFilesToPet($pet);
        require_once(VIEWS_PATH."home-owner.php");
    }
    


    public function cancelPetRegister($idPet){
        $this->OwnerDao->cancelPetRegister($idPet);
        require_once(VIEWS_PATH."home-owner.php");
    }


   

    


}

?>