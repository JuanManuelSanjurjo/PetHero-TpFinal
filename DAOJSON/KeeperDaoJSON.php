<?php
namespace DAOJSON;

//use DAO\UserDao as DAOUserDao;
use Models\Keeper as Keeper;
//use Models\Owner as Owner;
//use Models\User as User;
use Models\Reservation as Reservation;
use Models\TimeInterval;

class KeeperDAO{
    private $keeperList = [];
    private $fileName = ROOT."Data/Keepers.json";

    public function getByEmail($mail){
        $this->retrieveData();

        $keepers = array_filter($this->keeperList, function($keepers) use($mail){
            return $keepers->getMail() == $mail;
        });
        $keepers = array_values($keepers); //Reordering array indexes
        return (count($keepers) > 0) ? $keepers[0] : null;

    }

    public function getById($id){
        $this->retrieveData();

        $keepers = array_filter($this->keeperList, function($keeper) use($id){
            return $keeper->getId() == $id;
        });
        $keepers = array_values($keepers);
        return (count($keepers) > 0) ? $keepers[0] : null;
    }

    public function register(Keeper $keeper){

        $this->retrieveData();

        $keeper->setId($this->getNextId());  // SIGUE INDICANDO EN NULL EL ID      
        
        array_push($this->keeperList, $keeper);

        $this->saveData();

    }

    public function getAll()
    {
        $this->retrieveData();

        return $this->keeperList;
    }

    public function setPetType($size){
        $sessionUser = $_SESSION["loggedUser"];
        $sessionId = $sessionUser->getId();

        $this->retrieveData();
        foreach($this->keeperList as $user){
            if($user->getId() == $sessionId && $user instanceof Keeper)
                $user->setPetType($size);
        }
        $this->saveData();

    }


    public function addAvilability (TimeInterval $date){
        $sessionUser = $_SESSION["loggedUser"];
        $sessionId = $sessionUser->getId();

        $this->retrieveData();
        foreach($this->keeperList as $user){
            if($user->getId() == $sessionId && $user instanceof Keeper){
                $array = $user->getAvailabilityList();
                array_push($array,$date);
                $user->setAvailabilityList($array);
            
            }
        }
        $this->saveData();
    }

    public function setCompensation($compensation){
        $sessionUser = $_SESSION["loggedUser"];
        $sessionId = $sessionUser->getId();

        $this->retrieveData();
        foreach($this->keeperList as $user){
            if($user->getId() == $sessionId && $user instanceof Keeper)
                $user->setCompensation($compensation);
        }
        $this->saveData();

    }

/*
    public function removeUser($id)
        {            
            $this->retrieveData();
            
            $this->userList = array_filter($this->userList, function($user) use($id){                
                return $user->getId() != $id;
            });
            
            $this->saveData();
        }
*/
    
    public function retrieveData(){

        $this->keeperList = [];

             if(file_exists($this->fileName))
             {
                $jsonToDecode = file_get_contents($this->fileName);
                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : [];
                
                foreach($contentArray as $content)
                {
                    
                    $keeper = new Keeper();
                    $keeper->setId($content["id"]);
                    $keeper->setMail($content["mail"]);
                    $keeper->setPassword($content["password"]);
                    $keeper->setUserName($content["userName"]);
                    $keeper->setName($content["name"]);
                    $keeper->setSurname($content["surname"]);
                    $keeper->setUserType($content["userType"]);
                    $keeper->setCompensation($content["compensation"]);
                    $keeper->setPetType($content["petType"]);
                    $keeper->setAvailabilityList($content["availabilityList"]);

                    array_push($this->keeperList, $keeper);
                }
             }
    
    }


    public function saveData(){

        $arrayToEncode = [];

            foreach($this->keeperList as $keeper)
            {
                $valuesArray = [];
                $valuesArray["id"] = $keeper->getId();
                $valuesArray["mail"] = $keeper->getMail();
                $valuesArray["password"] = $keeper->getPassword();
                $valuesArray["userName"] = $keeper->getUserName();
                $valuesArray["name"] = $keeper->getname();
                $valuesArray["surname"] = $keeper->getSurname();
                $valuesArray["userType"] = $keeper->getUserType();
                $valuesArray["compensation"] = $keeper->getCompensation();
                $valuesArray["petType"] = $keeper->getPetType();
                $valuesArray["availabilityList"] = $keeper->getAvailabilityList();              
              
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
    
    }

    private function getNextId()
    {
        $id = 0;
        if(sizeof($this->userList) != 0){
            foreach($this->userList as $user)
            {
                $id = ($user->getId() > $id) ? $user->getId() : $id;

            }   
        }
        return $id+1;
    }


}







?>