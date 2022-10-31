<?php

namespace Models;

class TimeInterval{
    public $start;
    public $end;

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
}






?>