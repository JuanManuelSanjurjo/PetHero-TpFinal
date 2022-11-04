<?php
namespace DAO;

use Models\TimeInterval;
use DAO\Connection as Connection;
use Exception;

class AvailabilityDAO{

    private $connection;
    private $tableName= "timeinterval";

    public function addAvilability(TimeInterval $timeInterval)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (id, start, end, idKeeper) VALUES (:id, :start, :end, :idKeeper)";

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


    public function getById($idKeeper)
    {
        try{
            
            $availabilityList = array();

            $query = "SELECT id, start, end, idKeeper FROM ". $this->tableName . " WHERE (idKeeper = :idKeeper)";
            
            $parameters["idKeeper"] = $idKeeper;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
            
            foreach($results as $row){
            
                $timeInterval = new TimeInterval();

                $timeInterval->setId($row["id"]);
                $timeInterval->setStart ($row["start"]);
                $timeInterval->setEnd ($row["end"]);
                $timeInterval->setIdKeeper ($row["idKeeper"]);
                
                array_push($availabilityList,$timeInterval);
            
            }
            return $availabilityList;
           
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  



    public function setCompensation($compensation){
       
    }

    public function setPetType($size){
       
    }
    
 
    
}

?>