<?php 
namespace Models;


class Payment{
    private  $id;
    private $idReservation ;
    private $fileName;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getIdReservation()
    {
        return $this->idReservation;
    }

    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;

        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    
}










?>