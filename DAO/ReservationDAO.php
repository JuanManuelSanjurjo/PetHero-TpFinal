<?php
namespace DAO;

use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\User as User;
use Models\Pet as Pet;
use Models\Reservation as Reservation;
use Models\TimeInterval;

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
                    $reservation->setOwner($this->setOwners($content));
                    $reservation->setKeeper($this->setKeepers($content));
                    $reservation->setCompensation($content["compensation"]);
                    $reservation->setReservationPeriod($this->setTimeIntervals($content));
                    $reservation->setPet($this->setPets($content));
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
                $valuesArray["compensation"]= $reservation->getCompensation();
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
            
            if($booked->getKeeper()->getId()==$keeperID){

                array_push($fileContent,$booked);

            }

        }
        
        return $FiltredList;
    }
    



    private function setOwners($content){
        $newOwner= new Owner();

        $newOwner->setId([$content["owner"]["id"]]);
        $newOwner->setMail([$content["owner"]["mail"]]);
        $newOwner->setPassword([$content["owner"]["password"]]);
        $newOwner->setUserName([$content["owner"]["userName"]]);
        $newOwner->setName([$content["owner"]["name"]]);
        $newOwner->setSurname([$content["owner"]["surname"]]);
        $newOwner->setUserType([$content["owner"]["userType"]]);
        $newOwner->setPetList([$content["owner"]["petList"]]);



        return $newOwner;
    }

    private function setKeepers($content){
        $newKeeper= new Keeper();

        $newKeeper->setId([$content["keeper"]["id"]]);
        $newKeeper->setMail([$content["keeper"]["mail"]]);
        $newKeeper->setPassword([$content["keeper"]["password"]]);
        $newKeeper->setUserName([$content["keeper"]["userName"]]);
        $newKeeper->setName([$content["keeper"]["name"]]);
        $newKeeper->setSurname([$content["keeper"]["surname"]]);
        $newKeeper->setUserType([$content["keeper"]["userType"]]);
        $newKeeper->setCompensation([$content["keeper"]["compensation"]]);
        $newKeeper->setPetType([$content["keeper"]["petType"]]);
        $newKeeper->setAvailabilityList([$content["keeper"]["availabilityList"]]);


        return $newKeeper;
    }

    private function setTimeIntervals($content){
        $newTimeInterval= new TimeInterval();
        
        $newTimeInterval->setStart([$content["reservationPeriod"]["start"]]);
        $newTimeInterval->setEnd([$content["reservationPeriod"]["end"]]);
        


        return $newTimeInterval;
    }

    private function setPets($content){
       
        $pet = new Pet();
        $pet->setId($content["pet"]["id"]);
        $pet->setIdOwner($content["pet"]["idOwner"]);
        $pet->setName($content["pet"]["name"]);
        $pet->setPhoto($content["pet"]["photo"]);
        $pet->setBreed($content["pet"]["breed"]);
        $pet->setSize($content["pet"]["size"]);
        $pet->setVaxPlanImg($content["pet"]["vaxPlanImg"]);
        $pet->setVideo($content["pet"]["video"]);
        $pet->setObservations($content["pet"]["observations"]);
        $pet->setPetType($content["pet"]["petType"]);


        return $pet;
    }

}









?>