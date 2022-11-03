<?php
namespace DAO;

use Models\TimeInterval;
use DAO\Connection as Connection;
use Exception;

class AvailabilityDAO{

    private $connection;
    private $tableName= "timeinterval";

    public function register(TimeInterval $timeInterval)
    {
        try{
            $query = "INSERT INTO".$this->tableName."(id, start, end, idKeeper) VALUES (:id, :start, :end, :idKeeper)";

            $parameters["id"]           = $timeInterval->getId();
            $parameters["start"]        = $timeInterval->getStart();
            $parameters["end"]          = $timeInterval->getEnd();
            $parameters["idKeeper"]     = $timeInterval->getIdKeeper();
            

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);
        }catch(Exception $ex){
            throw $ex;
        } 

    }

    public function getAll()
    {
        try{
            
            $availabilityList = array();
            $query= "SELECT id, start, end, idKeeper FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $timeInterval = new TimeInterval();
                $timeInterval->setId($row["id"]);
                $timeInterval->setStart ($row["start"]);
                $timeInterval->setEnd ($row["end"]);
                $timeInterval->setIdKeeper ($row["idKeeper"]);
                
                array_push($availabilityList,$timeInterval);
            }

            return $availabilityList;
        }catch(Exception $ex){
            throw $ex;
        }

    }


    public function Remove($id)
    {
        try{
        $query= "DELETE FROM ".$this->tableName." WHERE (id = :id)";

        $parameters["id"] = $id;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query,$parameters);
        }catch(Exception $ex){
            throw $ex;
        }
    }
    /*

    public function getByEmail($mail)
    {
        try{
            
            $query = "SELECT id, mail, password, userName, name, surname, userType, compensation, petType FROM ".$this->tableName."WHERE (mail = :mail)";
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query);
            
            
            $keeper = new Keeper();
            $keeper->setId($results["id"]);
            $keeper->setMail ($results["mail"]);
            $keeper->setPassword ($results["password"]);
            $keeper->setUserName ($results["userName"]);
            $keeper->setName ($results["name"]);
            $keeper->setSurname ($results["surname"]);
            $keeper->setUserType ($results["userType"]);
            $keeper->setCompensation ($results["compensation"]);
            $keeper->setPetType ($results["petType"]);

              
            
            return $keeper;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  



    public function setCompensation($compensation){
       
    }

    public function setPetType($size){
       
    }
    
    */
    
}

?>