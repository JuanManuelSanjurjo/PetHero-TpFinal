<?php
namespace Models ;
use Models\TimeInterval as TimeInterval;

class Keeper extends User{
    private $compensation;
    private $petType;
    private $availabilityList = array() ;  // OBJETO periodoDeReservas (inicio/fin)

    public function getCompensation()
    {
        return $this->compensation;
    }

    public function setCompensation($compensation)
    {
        $this->compensation = $compensation;

        return $this;
    }

    public function getPetType()
    {
        return $this->petType;
    }

    public function setPetType($petType)
    {
        $this->petType = $petType;

        return $this;
    }

    public function getAvailabilityList()
    {
        return $this->availabilityList;
    }

    public function setAvailabilityList($availabilityList)
    {
        $this->availabilityList = $availabilityList;

        return $this;
    }

    public function addAviailability (TimeInterval $date){

        array_push($this->availabilityList,$date);

    }
}









?>