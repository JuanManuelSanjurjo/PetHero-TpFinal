<?php
namespace DAO;

use Models\Owner as Owner;
use DAO\Connection as Connection;
use Exception;

class OwnerDAO{

    private $connection;
    private $tableName= "owners";

    public function register(Owner $owner)
    {
        $query = "INSERT INTO ".$this->tableName."(id, mail, password, userName, name, surname, userType) VALUES (:id, :mail, :password, :userName, :name, :surname, :userType)";

        $parameters["id"]           = $owner->getId();
        $parameters["mail"]         = $owner->getMail();
        $parameters["password"]     = $owner->getPassword();
        $parameters["userName"]     = $owner->getUserName();
        $parameters["name"]         = $owner->getName();        
        $parameters["surname"]      = $owner->getSurname();        
        $parameters["userType"]     = $owner->getUserType();
        
        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query,$parameters);
    }

    public function getAll()
    {
        $ownerList = array();

        $query= "SELECT id, mail, password, userName, name, surname, userType FROM ".$this->tableName;

        $this->connection = Connection::GetInstance();

        $result = $this->connection->Execute($query);

        foreach($result as $row)
        {
            $keeper = new Owner();
            $keeper->setId($row["id"]);
            $keeper->setMail ($row["mail"]);
            $keeper->setPassword ($row["password"]);
            $keeper->setUserName ($row["userName"]);
            $keeper->setName ($row["name"]);
            $keeper->setSurname ($row["surname"]);
            $keeper->setUserType ($row["userType"]);

            array_push($ownerList,$keeper);
        }

        return $ownerList;

    }


    public function Remove($id)
    {
        $query= "DELETE FROM ".$this->tableName." WHERE (id = :id)";

        $parameters["id"] = $id;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query,$parameters);
    }


    public function getByEmail($mail)
    {
        try{
            $owner = null;

            $query = "SELECT id, mail, password, userName, name, surname, userType FROM ".$this->tableName." WHERE (mail = :mail)";

            $parameters["mail"] = $mail;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                        
            foreach($results as $row){


                $owner = new Owner();
                $owner->setId($row["id"]);
                $owner->setMail ($row["mail"]);
                $owner->setPassword ($row["password"]);
                $owner->setUserName ($row["userName"]);
                $owner->setName ($row["name"]);
                $owner->setSurname ($row["surname"]);
                $owner->setUserType ($row["userType"]);

            }

            if($owner){
                $PetDAO = new PetDao();
                $petList = $PetDAO->getPetListById($owner->getId()); // hay que hacer esta
                $owner->setPetList($petList);
            }

            return $owner;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }  


    public function getById($id)
    {
        try{
            $owner = null;

            $query = "SELECT id, mail, password, userName, name, surname, userType FROM ".$this->tableName." WHERE (id = :id)";

            $parameters["id"] = $id;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                        
            foreach($results as $row){


                $owner = new Owner();
                $owner->setId($row["id"]);
                $owner->setMail ($row["mail"]);
                $owner->setPassword ($row["password"]);
                $owner->setUserName ($row["userName"]);
                $owner->setName ($row["name"]);
                $owner->setSurname ($row["surname"]);
                $owner->setUserType ($row["userType"]);

            }

            if($owner){
                $PetDAO = new PetDao();
                $petList = $PetDAO->getPetListById($owner->getId()); // hay que hacer esta
                $owner->setPetList($petList);
            }
            return $owner;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }  


}







?>