<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use Models\Pet as Pet;
use Models\Reservation as Reservation;
use DAO\Connection as Connection;
use Exception;

class ReservationDAO{
   

    private $connection;
    private $tableName= "reservation";

    public function register(Reservation $reservation)
    {
        try{
            $query = "INSERT INTO".$this->tableName."(reservationNumber, owner, keeper, compensation, dateStart, dateEnd, pet, confirmation) VALUES (:reservationNumber, :owner, :keeper, :compensation, :dateStart, :dateEnd, :pet, :confirmation)";

            $parameters["reservationNumber"]= $reservation->getReservationNumber();
            $parameters["owner"]            = $reservation->getOwner();
            $parameters["keeper"]           = $reservation->getKeeper();
            $parameters["compensation"]     = $reservation->getCompensation();
            $parameters["dateStart"]        = $reservation->getDateStart();
            $parameters["dateEnd"]          = $reservation->getDateEnd();
            $parameters["pet"]              = $reservation->getPet();
            $parameters["confirmation"]     = $reservation->getConfirmation();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);
        }catch(Exception $ex){
            throw $ex;
        } 

    }

    public function getAll()
    {
        try{
            
            $reservationList = array();
            $query= "SELECT reservationNumber, owner, keeper, compensation, dateStart, dateEnd, pet, confirmation FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $reservation = new Reservation();
                $reservation->setReservationNumber($row["reservationNumber"]);
                $reservation->setOwner($row["owner"]);
                $reservation->setKeeper($row["keeper"]);
                $reservation->setCompensation($row["compensation"]);
                $reservation->setDateStart($row["dateStart"]);
                $reservation->setDateEnd($row["dateEnd"]);
                $reservation->setPet($row["pet"]);
                $reservation->setConfirmation($row["confirmation"]);
                
                array_push($availabilityList,$reservation);
            }

            return $reservationList;
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

    public function getReservationByKeeper($keeperID){
        
       try{

       
        $query= "SELECT reservationNumber, owner, keeper, compensation, dateStart, dateEnd, pet, confirmation FROM ".$this->tableName."WHERE (keeper = :keeperID)";

        $this->connection = Connection::GetInstance();

        $result = $this->connection->Execute($query);

        $reservation = new Reservation();
        $reservation->setReservationNumber($result["reservationNumber"]);
        $reservation->setOwner($result["owner"]);
        $reservation->setKeeper($result["keeper"]);
        $reservation->setCompensation($result["compensation"]);
        $reservation->setDateStart($result["dateStart"]);
        $reservation->setDateEnd($result["dateEnd"]);
        $reservation->setPet($result["pet"]);
        $reservation->setConfirmation($result["confirmation"]);
              
            
        return $reservation;
                
       }catch(Exception $ex){
            throw $ex;
       }
    }
    
  
    
}

?>