<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use Models\Pet as Pet;

class OwnerDAO{

    private $OwnerList = [];
    private $fileName = ROOT."Data/Owners.json";


    public function getByEmail($mail){
        $this->retrieveData();

        $owners = array_filter($this->OwnerList, function($owner) use($mail){
            return $owner->getMail() == $mail;
        });
        $owners = array_values($owners); //Reordering array indexes
        return (count($owners) > 0) ? $owners[0] : null;

    }

    public function getById($id){
        $this->retrieveData();

        $owners = array_filter($this->OwnerList, function($owner) use($id){
            return $owner->getId() == $id;
        });
        $owners = array_values($owners);
        return (count($owners) > 0) ? $owners[0] : null;
    }

    public function register(Owner $owner){

        $this->retrieveData();

        $owner->setId($this->getNextId());  // SIGUE INDICANDO EN NULL EL ID      
        
        array_push($this->OwnerList, $owner);

        $this->saveData();

    }

    public function getAll()
    {
        $this->retrieveData();

        return $this->OwnerList;
    }

    public function getPetById($id)
    {
        $sessionUser = $_SESSION["loggedUser"];
        
        foreach($sessionUser->getPetList() as $pet){
            if($pet->getId() == $id ){
                return $pet;
            }
        }

    }

    public function registerPet(Pet $pet){
        $sessionUser = $_SESSION["loggedUser"];
     
        $this->retrieveData();
        $newList = $sessionUser->getPetList();
            
        array_push($newList,$pet);

        $sessionUser->setPetList($newList);

        $this->saveData();
    }

    public function addFilesToPet(Pet $pet){
        $this->retrieveData();
        $sessionUser = $_SESSION["loggedUser"];

        foreach($sessionUser->getPetList() as $pets){
            if($pets->getId() == $pet->getId()){
                $pets->setPhoto($pet->getPhoto());
                $pets->setVaxPlanImg($pet->getVaxPlanImg());
                $pets->setVideo($pet->getVideo());
            }
        }
        $this->saveData();
    }

 
    public function retrieveData(){

        $this->OwnerList = [];

             if(file_exists($this->fileName))
             {
                $jsonToDecode = file_get_contents($this->fileName);
                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : [];
                
                foreach($contentArray as $content)
                {               

                    $owner = new Owner();
                    $owner->setId($content["id"]);
                    $owner->setMail($content["mail"]);
                    $owner->setPassword($content["password"]);
                    $owner->setUserName($content["userName"]);
                    $owner->setName($content["name"]);
                    $owner->setSurname($content["surname"]);
                    $owner->setUserType($content["userType"]);
                    $owner->setPetList($content["petList"]);                    

                    array_push($this->OwnerList, $owner);
                }
             }
    
    }


    public function saveData(){

        $arrayToEncode = [];

            foreach($this->OwnerList as $owner)
            {
                $valuesArray = [];
                $valuesArray["id"] = $owner->getId();
                $valuesArray["mail"] = $owner->getMail();
                $valuesArray["password"] = $owner->getPassword();
                $valuesArray["userName"] = $owner->getUserName();
                $valuesArray["name"] = $owner->getname();
                $valuesArray["surname"] = $owner->getSurname();
                $valuesArray["userType"] = $owner->getUserType();             
                $valuesArray["petList"] = $owner->getPetList();

                array_push($arrayToEncode, $valuesArray);
            }        
            

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
    
    }

    private function getNextId()
    {
        $id = 0;
        if(sizeof($this->OwnerList) != 0){
            foreach($this->OwnerList as $user)
            {
                $id = ($user->getId() > $id) ? $user->getId() : $id;

            }   
        }
        return $id+1;
    }

    private function getNextPetId() // deberia ser privada
    {
        $sessionUser = $_SESSION["loggedUser"];
        $id = 0;
        foreach($sessionUser->getPetList() as $pet)
        {
            $id = ($pet->getId() > $id) ? $pet->getId() : $id;
        }
        return $id+1;
    }


    public function cancelPetRegister($id)
        {            
            $sessionUser = $_SESSION["loggedUser"];
            
            $this->retrieveData();

            $list= $sessionUser->getPetList();

            $list = array_filter($list, function($pet) use($id){                
                return $pet->getId() != $id;
            });
            $sessionUser->setPetList($list);

            $this->saveData();
        }


    


}







?>