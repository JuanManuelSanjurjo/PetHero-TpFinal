<?php
namespace DAOJSON;

use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;

class UserDao{
    private $userList = [];
    private $fileName = ROOT."Data/Users.json";
 

    public function getByEmail($mail){
        $this->retrieveData();
        
        $users = array_filter($this->userList, function($user) use($mail){
            return $user->getMail() == $mail;
        });
        $users = array_values($users); //Reordering array indexes
        return (count($users) > 0) ? $users[0] : null;

    }

    public function getById($id){
        $this->retrieveData();

        $users = array_filter($this->userList, function($user) use($id){
            return $user->getId() == $id;
        });
        $users = array_values($users);
        return (count($users) > 0) ? $users[0] : null;
    }

    public function register(User $user){

        $this->retrieveData();

        $user->setId($this->getNextId());  // SIGUE INDICANDO EN NULL EL ID      
        
        array_push($this->userList, $user);

        $this->saveData();

    }

    public function getAll()
    {
        $this->retrieveData();

        return $this->userList;
    }

    public function getKeepers(){
        $this->retrieveData();
        $keeperList = [];

        foreach($this->userList as $user){
            if($user->getUserType() == "keeper"){
                array_push($keeperList,$user);
            }
        }
        return $keeperList;
    }

    public function setPetType($size){
        $sessionUser = $_SESSION["loggedUser"];
        $sessionId = $sessionUser->getId();

        $this->retrieveData();
        foreach($this->userList as $user){
            if($user->getId() == $sessionId && $user instanceof Keeper)
                $user->setPetType($size);
        }
        $this->saveData();

    }

    public function addAvilability ($dates){
        $sessionUser = $_SESSION["loggedUser"];
        $sessionId = $sessionUser->getId();

        $this->retrieveData();
        foreach($this->userList as $user){
            if($user->getId() == $sessionId && $user instanceof Keeper){
                $array = $user->getAvailabilityList();
                array_push($array,$dates);
                $user->setAvailabilityList($array);
            
            }
        }
        $this->saveData();
    }

    public function setCompensation($compensation){
        $sessionUser = $_SESSION["loggedUser"];
        $sessionId = $sessionUser->getId();

        $this->retrieveData();
        foreach($this->userList as $user){
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

        $this->userList = [];

             if(file_exists($this->fileName))
             {
                $jsonToDecode = file_get_contents($this->fileName);
                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : [];
                
                foreach($contentArray as $content)
                {
                    if($content["userType"]=="keeper"){
                        $user = new Keeper();
                        $user->setId($content["id"]);
                        $user->setMail($content["mail"]);
                        $user->setPassword($content["password"]);
                        $user->setUserName($content["userName"]);
                        $user->setName($content["name"]);
                        $user->setSurname($content["surname"]);
                        $user->setUserType($content["userType"]);
                        $user->setCompensation($content["compensation"]);
                        $user->setPetType($content["petType"]);
                        $user->setAvailabilityList($content["availabilityList"]);

                    }else if($content["userType"]=="owner"){

                        $user = new Owner();
                        $user->setId($content["id"]);
                        $user->setMail($content["mail"]);
                        $user->setPassword($content["password"]);
                        $user->setUserName($content["userName"]);
                        $user->setName($content["name"]);
                        $user->setSurname($content["surname"]);
                        $user->setUserType($content["userType"]);
                        $user->setPetList($content["petList"]);
                    }

                    array_push($this->userList, $user);
                }
             }
    
    }


    public function saveData(){

        $arrayToEncode = [];

            foreach($this->userList as $user)
            {
                $valuesArray = [];
                $valuesArray["id"] = $user->getId();
                $valuesArray["mail"] = $user->getMail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["userName"] = $user->getUserName();
                $valuesArray["name"] = $user->getname();
                $valuesArray["surname"] = $user->getSurname();
                $valuesArray["userType"] = $user->getUserType();

                if( $valuesArray["userType"] =="keeper"){
                    $valuesArray["compensation"] = $user->getCompensation();
                    $valuesArray["petType"] = $user->getPetType();
                    $valuesArray["availabilityList"] = $user->getAvailabilityList();
                }elseif($valuesArray["userType"] =="owner"){
                    $valuesArray["petList"] = $user->getPetList();
                }
              
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