<?php
namespace Controllers;

use Controllers\OwnerController as OwnerController;
use DAO\PetDao as PetDao;
use Models\Pet as Pet;
use DAO\OwnerDao as OwnerDao;
use Models\Owner as Owner;

class PetController{
    private $PetDao;  
    
    function __construct(){
        $this->PetDao = new PetDao();
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
                    HomeController::showMessage("your file:  ". $file['name'] . ", was uploaded succesfully.");
                   
                } else{
                    HomeController::showMessage("The file is too big.");
                   
                    $this->cancelPetRegister($pet->getId());
                  
                }
            }else{
                HomeController::showMessage("There was an error uploading your file.");
               
                $this->cancelPetRegister($pet->getId());
                
            }
        }else{
            HomeController::showMessage("There was an error uploading files, try again.");
           
            $this->cancelPetRegister($pet->getId());
            
        }

        return $fileName;

    }

    public function uploadFile($photo, $vaxPlanImg, $video){
        require_once(VIEWS_PATH."validate-session.php");
        $user = $_SESSION["loggedUser"];

        $petList = $user->getPetList();
        $pet =  array_pop($petList);
        if(isset($_POST)  )  {

                
                $photoName = $this->checkImgFiles($photo,$user,$pet,'profile');
                          
    
                $vaxImgName = $this->checkImgFiles($vaxPlanImg,$user,$pet,'vaxImg');
    
                $pet->setPhoto($photoName);
                $pet->setVaxPlanImg($vaxImgName);
                
                if($_FILES['video']['size'] != 0){
    
                    $videoFileName =  $this->checkImgFiles($video,$user,$pet,'video');
                    $pet->setVideo($videoFileName); 
                }
                
            }
     
        $this->PetDao->addFilesToPet($pet);
        /// ACA HAY QUE HACER UN UPDATE EN LA TABLA
        /// ACA HAY QUE HACER UN UPDATE EN LA TABLA
        /// ACA HAY QUE HACER UN UPDATE EN LA TABLA
        require_once(VIEWS_PATH."home-owner.php");
    }
   

    public function registerPet($petType, $name, $breed, $size, $observations){
        require_once(VIEWS_PATH."validate-session.php");
        $user = $_SESSION["loggedUser"];

        $pet = new Pet();

        $pet->setPetType($petType);
        $pet->setIdOwner($user->getId());
        $pet->setName($name);
        $pet->setBreed($breed);
        $pet->setSize($size);
        $pet->setObservations($observations);

        $this->PetDao->register($pet);

/////  RENUEVA EL LOGGED USER HACERLO EN CONTROLLER CORRESPONDIENTE
        $ownerDao = new OwnerDAO();
        $user = $ownerDao->getById($pet->getIdOwner());
        $_SESSION["loggedUser"] = $user;

        $petList = $user->getPetList();
        $pet =  array_pop($petList);
                
        require_once(VIEWS_PATH."add-files.php");
    }

    public function cancelPetRegister($idPet){
           
        $this->PetDao->cancelPetRegister($idPet);

        require_once(VIEWS_PATH."home-owner.php");
    }

    public function Index($message = "")
    {
        HomeController::showMessage($message); 
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."login.php");
    }        

    public function showHomeView($userType)
    {
        require_once(VIEWS_PATH."validate-session.php");
        if($userType == "owner"){
            require_once(VIEWS_PATH."home-owner.php");
        }else if($userType == "keeper"){
            require_once(VIEWS_PATH."home-keeper.php");
        }else{
            require_once(VIEWS_PATH."home.php");  // LUEGO SI SE PUEDE SER LOS DOS, LO USAREMOS (contiene todas las opciones)
        }
    }

    public function showAddPet(){
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."add-pet.php");  
    }

    public function showPetList(){
        require_once(VIEWS_PATH."validate-session.php");

        if(isset($_SESSION["loggedUser"])){
          
            require_once(VIEWS_PATH."pet-list.php");  
        }else{
            require_once(VIEWS_PATH."login.php");  
        } 
    }

    public function showMyPetList(){
        $user = $_SESSION["loggedUser"];
        $petList= $user->getPetList();
        if(isset($user)){
            require_once(VIEWS_PATH."pet-list.php");
        }
    }

    public function modifyPet($name, $breed, $size, $observations, $photo, $vaxPlanImg, $video, $petId){
        require_once(VIEWS_PATH."validate-session.php");
        
        $user = $_SESSION["loggedUser"];
        
        $PetDao = new PetDao();
        $pet= $PetDao->getById($petId);

        $pet->setId($petId);
        $pet->setName($name);
        $pet->setBreed($breed);
        $pet->setSize($size);
        $pet->setObservations($observations);

        /*      /// faltan fotos
        if($photo){
            $pet->setPhoto($this->checkImgFiles($photo,$user,$pet,'profile'));
        }
        if($vaxPlanImg){
            $pet->setPhoto($this->checkImgFiles($vaxPlanImg,$user,$pet,'vaxImg'));
        }
        if(!$video){
            $pet->setPhoto($this->checkImgFiles($video,$user,$pet,'video'));
        }
*/
        $this->PetDao->modifyPet($pet); 
                    
/////  RENUEVA EL LOGGED USER
        $ownerDao = new OwnerDAO();
        $user = $_SESSION["loggedUser"];
        $_SESSION["loggedUser"] = $ownerDao->getById($user->getId());

        $OwnerController = new OwnerController();
        $OwnerController->showHomeView("Pet modification succesful");
    }
    

}
?>