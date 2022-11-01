<?php
namespace DAO;

use Exception;
use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;

class OwnerDAO{

    private $connection;
    private $tableName= "Owners";

    public function register(Owner $owner)
    {
        $query = "INSERT INTO".$this->tableName."(id, mail, password, userName, name, surname, userType) VALUES (:id, :mail, :password, :userName, :name, :surname, :userType)";

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
            $keeper = new Keeper();
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

/*
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

    */
    public function getByEmail($mail)
    {
        try{
            
            $query = "SELECT id, mail, password, userName, name, surname, userType FROM ".$this->tableName."WHERE (mail = :mail)";
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query);
            
            
            $owner = new Owner();
            $owner->setId($results["id"]);
            $owner->setMail ($results["mail"]);
            $owner->setPassword ($results["password"]);
            $owner->setUserName ($results["userName"]);
            $owner->setName ($results["name"]);
            $owner->setSurname ($results["surname"]);
            $owner->setUserType ($results["userType"]);

              
            
            return $owner;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  


}







?>