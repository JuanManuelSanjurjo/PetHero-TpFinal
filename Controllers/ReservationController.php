<?php
namespace Controllers;

use DAO\UserDao as UserDao;
use Models\User as User;
use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\Pet as Pet;
use Models\TimeInterval as TimeInterval;
use DAO\OwnerDAO as OwnerDAO;
use DAO\KeeperDAO as KeeperDao;
use DAO\PetDao as PetDAO;
use DAO\ReservationDAO as ReservationDAO;
use Models\Reservation;

class ReservationController{

    private $OwnerDao;  
    private $KeeperDao;
    private $ReservationDAO;
    private $PetDAO;

    
    function __construct(){
        $this->OwnerDao = new OwnerDAO();
        $this->KeeperDao = new KeeperDao();
        $this->ReservationDAO = new ReservationDAO();
        $this->PetDAO = new PetDao();              
    }

    public function makeReservation("parametros"){

        $this->ReservationDAO->makeReservation("parametros");
        ///resolver vista y pase de parametros a funcion
        
    }

    public function showKeeperList(){
        $keeperList=$this->KeeperDao->getAll();
        $user = $_SESSION["loggedUser"];
        $petList = $user->getPetList();
        
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."filter-Keepers.php");
        require_once(VIEWS_PATH."keeper-list.php");
    }

    public function showKeeperListToFiltrate ($Pet,$dateStart,$dateEnd)
    {
       
        
        $KeepersAvailable = array();
        $keeperList=$this->KeeperDao->getAll();
        $ReservationList= $this->ReservationDAO->getAll();

        foreach($keeperList as $keeper){
            $availabilityList=$this->keeper->getAvailabilityList();
            foreach($availabilityList as $availability){
                if($dateStart>=$availability->date->start && $dateEnd<=$availability->date->end)
                {
                    array_push($KeepersAvailable,$keeper);
                }
            }

        }

        foreach($ReservationList as $reservation)
        {
            





        }



      







    }

   public function showAllReservation(){
    $keeper = $_SESSION["loggedUser"];
    $ReservationList = $this->ReservationDAO->getReservationByKeeper($keeper->getId());

    require_once(VIEWS_PATH."validate-session.php");
    require_once(VIEWS_PATH."reservation-list.php");



   }


   


















}



?>