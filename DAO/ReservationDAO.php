<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use Models\Reservation as Reservation;

class ReservationDAO{
    private $reservationList = [];
    private $fileName = ROOT."Data/Reservations.json";


    public function getByReservationNumber($reservationNumber){
        $this->retrieveData();

        $reservation = array_filter($this->reservationList, function($reservation) use($reservationNumber){
            return $reservation->getByReservationNumber() == $reservationNumber;
        });
        $reservation = array_values($reservation); //Reordering array indexes
        return (count($reservation) > 0) ? $reservation[0] : null;

    }

    public function register(Reservation $reservation){

        $this->retrieveData();

        $reservation->setReservationNumber($this->getNextReservationNumber());  // SIGUE INDICANDO EN NULL EL ID      
        
        array_push($this->reservationList, $reservation);

        $this->saveData();

    }

    public function getAll()
    {
        $this->retrieveData();

        return $this->reservationList;
    }

   
    public function retrieveData(){

        $this->reservationList = [];

             if(file_exists($this->fileName))
             {
                $jsonToDecode = file_get_contents($this->fileName);
                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : [];
                
                foreach($contentArray as $content)
                {
                    
                    $reservation = new Reservation();
                    $reservation->setReservationNumber($content["reservationNumber"]);
                    $reservation->setOwner($content["owner"]);
                    $reservation->setKeeper($content["keeper"]);
                    $reservation->setCompensation($content["compensation"]);
                    $reservation->setReservationPeriod($content["reservationPeriod"]);
                    $reservation->setPet($content["pet"]);
                    $reservation->setConfirmation($content["confirmation"]);
                                  

                    array_push($this->reservationList, $reservation);
                }
             }
    
    }


    public function saveData(){

        $arrayToEncode = [];

            foreach($this->reservationList as $reservation)
            {
                $valuesArray = [];
                $valuesArray["reservationNumber"] = $reservation->getByReservationNumber();
                $valuesArray["owner"] = $reservation->getOwner();
                $valuesArray["keeper"] = $reservation->getKeeper();
                $valuesArray["compensation"] = $reservation->getCompensation();
                $valuesArray["reservationPeriod"] = $reservation->getReservationPeriod();
                $valuesArray["pet"] = $reservation->getPet();
                $valuesArray["confirmation"] = $reservation->getConfirmation();
                              
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
    
    }

    public function getNextReservationNumber()
    {
        $reservationNumber = 0;
        if(sizeof($this->reservationList) != 0){
            foreach($this->reservationList as $reservation)
            {
                $reservationNumber = ($reservation->getReservationNumber() > $reservation) ? $reservation->getReservationNumber() : $reservationNumber;

            }   
        }
        return $reservationNumber+1;
    }

    public function getReservationByKeeper($keeperID){
        $this->retrieveData();

        $FiltredList=array();

        foreach($this->reservationList as $booked){
            
            if($booked->getKeeper()->getId()== $keeperID){

                array_push($fileContent,$booked);

            }

        }
        
        return $FiltredList;
    }



}





?>