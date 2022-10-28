<?php
namespace DAO;

use DAO\UserDao as DAOUserDao;
use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use Models\Reservation as Reservation;
use Models\TimeInterval;
use DAO\Connection as Connection;

class KeeperDAO{
   

    private $connection;
    private $tableName= "Keepers";

    public function Add(Keeper $keeper)
    {
        $query = "INSERT INTO".$this->tableName."(id, mail, password, userName, name, surname, userType, compensation, petType) VALUES (:id, :mail, :password, :userName, :name, :surname, :userType, :compensation, :petType)";

        $parameters["id"]           = $keeper->getId();
        $parameters["mail"]         = $keeper->getMail();
        $parameters["password"]     = $keeper->getPassword();
        $parameters["userName"]     = $keeper->getUserName();
        $parameters["name"]         = $keeper->getName();        
        $parameters["surname"]      = $keeper->getSurname();        
        $parameters["userType"]     = $keeper->getUserType();        
        $parameters["compensation"] = $keeper->getCompensation();        
        $parameters["petType"]      = $keeper->getPetType();
        
        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query,$parameters);
    }

    public function GetAll()
    {
        $keepersList = array();

        $query= "SELECT id, mail, password, userName, name, surname, userType, compensation, petType FROM ".$this->tableName;

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
            $keeper->setCompensation ($row["compensation"]);
            $keeper->setPetType ($row["petType"]);

            array_push($keepersList,$keeper);
        }

        return $keepersList;

    }


    public function Remove($id)
    {
        $query= "DELETE FROM ".$this->tableName." WHERE (id = :id)";

        $parameters["id"] = $id;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query,$parameters);
    }
}







?>