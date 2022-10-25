<?php
namespace Models;

use Models\Owner as Owner;
use Models\Keeper as Keeper;
use Models\ReservationPeriod as ReservationPeriod;

class Reservation{

    private $reservationNumber;
    private $owner;
    private $keeper;
    private $reservationPeriod; //TimeInterval
    private $pet;    
    private $confirmation;  //se setea null y se cambia a true or false

    /**
     * Get the value of owner
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @return  self
     */ 
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get the value of keeper
     */ 
    public function getKeeper()
    {
        return $this->keeper;
    }

    /**
     * Set the value of keeper
     *
     * @return  self
     */ 
    public function setKeeper($keeper)
    {
        $this->keeper = $keeper;

        return $this;
    }

    /**
     * Get the value of reservationPeriod
     */ 
    public function getReservationPeriod()
    {
        return $this->reservationPeriod;
    }

    /**
     * Set the value of reservationPeriod
     *
     * @return  self
     */ 
    public function setReservationPeriod($reservationPeriod)
    {
        $this->reservationPeriod = $reservationPeriod;

        return $this;
    }

    /**
     * Get the value of pet
     */ 
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * Set the value of pet
     *
     * @return  self
     */ 
    public function setPet($pet)
    {
        $this->pet = $pet;

        return $this;
    }

    /**
     * Get the value of confirmation
     */ 
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * Set the value of confirmation
     *
     * @return  self
     */ 
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;

        return $this;
    }

    /**
     * Get the value of reservationNumber
     */ 
    public function getReservationNumber()
    {
        return $this->reservationNumber;
    }

    /**
     * Set the value of reservationNumber
     *
     * @return  self
     */ 
    public function setReservationNumber($reservationNumber)
    {
        $this->reservationNumber = $reservationNumber;

        return $this;
    }
}

?>