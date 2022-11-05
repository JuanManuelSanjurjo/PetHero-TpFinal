<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use Models\Pet as Pet;
use Models\Reservation as Reservation;
use DAO\Connection as Connection;
use DAO\OwnerDAO as OwnerDAO;
use DAO\KeeperDao as KeeperDao;
use DAO\PetDao as PetDao;


use Exception;

class ReservationDAO{
   
    private $connection;
    private $tableName = "reservation";

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
                
                array_push($reservationList,$reservation);
            }

            foreach($reservationList as $row){
                $ownerDAO = new OwnerDAO();
                $owner=$ownerDAO->getById($row->getOwner());
                $row->setOwner($owner);

                $keeperDAO= new keeperDao();
                $keeper = $keeperDAO->getById($row->getKeeper()); ///Hacerla en el keeper
                $row->setKeeper($keeper);

                $petDao = new PetDao();
                $pet = $petDao->getById($row->getPet());
                $row->setPet($pet);
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

       
        $query= "SELECT reservationNumber, owner, keeper, compensation, dateStart, dateEnd, pet, confirmation FROM ".$this->tableName." WHERE (keeper = :keeperID)";

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
            
            array_push($reservationList,$reservation);
        }
              
        foreach($reservationList as $row){
            $ownerDAO = new OwnerDAO();
            $owner=$ownerDAO->getById($row->getOwner());
            $row->setOwner($owner);

            $keeperDAO= new keeperDao();
            $keeper = $keeperDAO->getById($row->getKeeper()); ///Hacerla en el keeper
            $row->setKeeper($keeper);

            $petDao = new PetDao();
            $pet = $petDao->getById($row->getPet());
            $row->setPet($pet);
        }
            
        return $reservation;
                
       }catch(Exception $ex){
            throw $ex;
       }


       
    }

    
    public function getAllReservationsById($keeperID){
        
        try{
            
            $reservationList = array();
            $query= "SELECT reservationNumber, owner, keeper, compensation, dateStart, dateEnd, pet, confirmation FROM ". $this->tableName ." WHERE (keeper =" . 256 .");";
            
           // $parameters["keeper"] = $keeperID;
           
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
                
                array_push($reservationList,$reservation);
            }
            
            foreach($reservationList as $row){
                $ownerDAO = new OwnerDAO();
                $owner = $ownerDAO->getById($row->getOwner());
                $row->setOwner($owner);
                
                $keeperDAO= new keeperDao();
                $keeper = $keeperDAO->getById($row->getKeeper()); ///Hacerla en el keeper
                $row->setKeeper($keeper);

                $petDao = new PetDao();
                $pet = $petDao->getById($row->getPet());
                $row->setPet($pet);
            }
            
            return $reservationList;
        }catch(Exception $ex){
            throw $ex;
        }
        
        
    }
    
        public function setConfirmation ($reservationId, $onfirmation){
    
        }

        public function makeReservation (){
    
        }
    

        
    
    
}

?>