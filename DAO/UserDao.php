<?php
namespace DAO;


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
        $users = array_values($users); //Reordering array indexes
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
                    $user = new User();
                    $user->setId($content["id"]);
                    $user->setMail($content["mail"]);
                    $user->setPassword($content["password"]);
                    $user->setUserName($content["userName"]);
                    $user->setName($content["name"]);
                    $user->setSurname($content["surname"]);
                    $user->setUserType($content["userType"]);

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

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
    
    }


    private function getNextId()
    {
        $id = 0;
        foreach($this->userList as $user)
        {
            $id = ($user->getId() > $id) ? $user->getId() : $id;
        }
        return $id+1;
    }


}







?>