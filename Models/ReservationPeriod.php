<?php
namespace Models;


class ReservationPeriod{

    private $startDate; //objeto date
    private $finishDate;

    /**
     * Get the value of startDate
     */ 
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of finishDate
     */ 
    public function getFinishDate()
    {
        return $this->finishDate;
    }

    /**
     * Set the value of finishDate
     *
     * @return  self
     */ 
    public function setFinishDate($finishDate)
    {
        $this->finishDate = $finishDate;

        return $this;
    }
}

?>