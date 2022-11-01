<?php

namespace Controllers;

use DAOJSON\KeeperDAO as KeeperDAO;
use DAOJSON\OwnerDAO as OwnerDAO;
use DAOJSON\PetDao as PetDao;
use DAOJSON\UserDao as UserDao;
use DAO\ReservationDAO as ReservationDAO;
use Models\Keeper as Keeper;
use Models\TimeInterval as TimeInterval;
use Models\Owner as Owner;
use Models\Pet as Pet;
use Models\Reservation as Reservation;

class ReservationController{
    private $OwnerDAO;
    private $KeeperDAO;
    private $PetDAO;
    private $ReservationDAO;

    function __construct()
    {
        $this->OwnerDAO = new OwnerDAO();
        $this->KeeperDAO = new KeeperDAO();
        $this->PetDAO = new PetDao();
        $this->ReservationDAO = new ReservationDAO();

    }

    

















}










































?>