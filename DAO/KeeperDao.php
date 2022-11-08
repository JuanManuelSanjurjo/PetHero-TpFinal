<?php
namespace DAO;

use DAO\UserDao as DAOUserDao;
use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use Models\Reservation as Reservation;
use Models\TimeInterval as TimeInterval;
use DAO\Connection as Connection;
use DAO\AvailabilityDAO as AvailabilityDAO;
use DAO\ReservationDAO as ReservationDAO;
use Exception;

class KeeperDAO{
   

    private $connection;
    private $tableName= "keepers";

    public function register(Keeper $keeper)
    {
        try{
            $query = "INSERT INTO ".$this->tableName."(id, mail, password, userName, name, surname, userType, compensation, petType) VALUES (:id, :mail, :password, :userName, :name, :surname, :userType, :compensation, :petType)";

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
        }catch(Exception $ex){
            throw $ex;
        } 

    }

    public function addAvilability(TimeInterval $date){
        $AvailabilityDAO = new AvailabilityDAO();
        $AvailabilityDAO->addAvilability($date);
    }

    public function getAll()
    {
        try{
            
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

            foreach($keepersList as $keeper){
                $AvailabilityDAO = new AvailabilityDAO();
                $availabilityList = $AvailabilityDAO->getById($keeper->getId());
                $keeper->setAvailabilityList($availabilityList);
            }

            return $keepersList;

        }catch(Exception $ex){
            throw $ex;
        }

    }


    public function getFilteredList($pet, $dateStart, $dateEnd){
        
        $filteredKeeperList = array();
        $PetDao = new PetDao();
        $petTosearch = $PetDao->getById($pet);

        foreach($this->getAll() as $keeper){
            $availabilities = $keeper->getAvailabilityList();
            foreach($availabilities as $interval){
                if($dateStart >= $interval->getStart() && $dateEnd <= $interval->getEnd() ){
                    if($petTosearch->getPetType() == "cat"){
                        array_push($filteredKeeperList,$keeper);
                    }elseif($petTosearch->getPetType() == "dog" && $keeper->getPetType() == $petTosearch->getSize()){
                        array_push($filteredKeeperList,$keeper);
                    }

                }
            }
        }

        $reservationDAO = new ReservationDAO();
        $reservationList =  $reservationDAO->getAll();
                
        foreach($filteredKeeperList as $keeper){

            foreach($reservationList as $reservation){

                if($keeper->getId() == $reservation->getKeeper()->getId()){
                   /*
                    echo " en primer if ";
                    echo $keeper->getName(). " ";
                    echo $reservation->getPet()->getPetType() . " ";
                    echo $petTosearch->getPetType() . " ";
                    echo $dateStart . " ";
                    echo $reservation->getDateStart() ;
                    echo $dateEnd . " ";
                    echo $reservation->getDateEnd() ;
                    */
                  
                    if(($dateStart >=  $reservation->getDateStart() && $dateStart <= $reservation->getDateEnd()) || ($dateEnd >=  $reservation->getDateStart() && $dateEnd <= $reservation->getDateEnd())){
                        echo " en segundo if   ";

                        if($reservation->getPet()->getPetType() != $petTosearch->getPetType()  ){
                            echo " en tercer if";
                            unset($filteredKeeperList[array_search($keeper, $filteredKeeperList)]);           
                        }else if($reservation->getPet()->getPetType() == "dog"  && $reservation->getPet()->getSize() != $petTosearch->getSize()){
                            echo " en cuarto if";
                            unset($filteredKeeperList[array_search($keeper, $filteredKeeperList)]);           
                        }

                    }
                }
            }
        }   
        $filteredKeeperList = array_unique($filteredKeeperList, SORT_REGULAR);  // Entrega una sola instancia de cada Keeper
        return $filteredKeeperList;
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


    public function getByEmail($mail)
    {
        try{
            
            $keeper = null;

            $query = "SELECT id, mail, password, userName, name, surname, userType, compensation, petType FROM ". $this->tableName . " WHERE (mail = :mail)";
            
            $parameters["mail"] = $mail;
         
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                         
            foreach($results as $row){
            
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
            
            }
            if($keeper){
                $AvailabilityDAO = new AvailabilityDAO();
                $availabilityList = $AvailabilityDAO->getById($keeper->getId());
                $keeper->setAvailabilityList($availabilityList);

            }
            
            return $keeper;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  
    
       public function getById($id)
    {
        try{
            
            $keeper = null;

            $query = "SELECT id, mail, password, userName, name, surname, userType, compensation, petType FROM ". $this->tableName . " WHERE (id = :id)";
            
            $parameters["id"] = $id;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                         
            foreach($results as $row){
            
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
            
            }
            if($keeper){
                $AvailabilityDAO = new AvailabilityDAO();
                $availabilityList = $AvailabilityDAO->getById($keeper->getId());
                $keeper->setAvailabilityList($availabilityList);

            }
            
            return $keeper;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function setCompensation($compensation, $id){

        try{  
            $query= "UPDATE ".$this->tableName." SET compensation = :compensation WHERE (id = ". $id .")";
                  
            $parameters["compensation"] = $compensation;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);

        }
        catch(Exception $ex){
            throw $ex;
        }
       
    }

    public function setPetType($petType, $id){
        try{  
            $query= "UPDATE ".$this->tableName." SET petType = :petType WHERE (id = ". $id .")";
                  
            $parameters["petType"] = $petType;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);

        }
        catch(Exception $ex){
            throw $ex;
        }
       
    }


}


?>