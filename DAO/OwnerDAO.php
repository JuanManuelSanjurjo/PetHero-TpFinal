<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use FFI\Exception;

class OwnerDAO{

    private $connection;
    private $tableName= "Owners";

    public function Add(Owner $owner)
    {
        try{
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

        }catch(Exception $e){
            throw $e;
        }
    }

    public function GetAll()
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

    public function GetByEmail($mail)
    {
            try{
                $user = null;

                $query = "SELECT id, mail, password, userName, name, surname, userType, compensation, petType FROM ".$this->tableName."WHERE (mail = :mail)";
                
                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query);

                foreach($results as $row)
                {
                    $keeper = new Owner();
                    

                }
                return $keeper;
        }catch(Exception $ex){
            throw $ex;
        }
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


}







?>