<?php

namespace Models;

class TimeInterval{
    public $id;
    public $start;
    public $end;
    public $idKeeper;

      public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }
    

/*
    public function __sleep() {
    }

    public function __wakeup() {
    }
*/

    /**
     * Get the value of idKeeper
     */ 
    public function getIdKeeper()
    {
        return $this->idKeeper;
    }

    /**
     * Set the value of idKeeper
     *
     * @return  self
     */ 
    public function setIdKeeper($idKeeper)
    {
        $this->idKeeper = $idKeeper;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}






?>