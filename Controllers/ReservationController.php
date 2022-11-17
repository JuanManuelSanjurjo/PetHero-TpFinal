<?php
namespace Controllers;

use Controllers\KeeperController as KeeperController;
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
use DateTimeZone;
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

    public function makeReservation($pet, $owner, $keeper, $dateStart, $dateEnd){ // PONER PARAMETROS

        $reservation = new Reservation();
        $newPet = new Pet();
        $newPet->setId($pet);
        $reservation->setPet($newPet);

        $newOwner = new Owner();
        $newOwner->setId($owner);
        $reservation->setOwner($newOwner);

        $newKeeper = new Keeper();
        $newKeeper->setId($keeper);
        $reservation->setKeeper($newKeeper);

        $reservation->setDateStart($dateStart);
        $reservation->setDateEnd($dateEnd);
        $reservation->setCompensation($reservation->getCompensation());

        $this->ReservationDAO->makeReservation($reservation);

        $ownerController = new OwnerController();
        $ownerController->showHomeView("The reservation has been made and was sent to the keeper for confirmation");
        
    }

    public function setConfirmation($confirmation, $reservationId){
        if($confirmation == "confirm"){
            $this->ReservationDAO->setConfirmation($reservationId, true);
        }else{
            $this->ReservationDAO->setConfirmation($reservationId, false);
        }
        HomeController::showMessage("Status updated");
        $this->showAllReservations();
        // hay que hacer esta en el DAO
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


   public function showAllReservations(){
        $user = $_SESSION["loggedUser"];
        $ReservationList = $this->ReservationDAO->getAllReservationsById($user->getId());
                     
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."reservation-list.php");             
   }

   public function showHistoricReservations(){
        $user= $_SESSION["loggedUser"];
        $reservationListToFiltrate = $this->ReservationDAO->getAllReservationsById($user->getId());
        $ReservationList=array();
        date_default_timezone_set("America/Buenos_aires");
        $today=date("Y-m-d",time());    

         
        foreach($reservationListToFiltrate as $row){

            if($row->getDateStart()<$today){
                
                array_push($ReservationList,$row);
            }
        }
       
    
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."reservation-historic.php"); 
   }

   public function showReservationToMake(){
    $user= $_SESSION["loggedUser"];
    $reservationListToFiltrate = $this->ReservationDAO->getAllReservationsById($user->getId());
    $ReservationList=array();
    date_default_timezone_set("America/Buenos_aires");
    $today=date("Y-m-d",time());    


    foreach($reservationListToFiltrate as $row){

        if($row->getDateStart()>=$today){ // && is not cancelled
            
            array_push($ReservationList,$row);
        }
    }
    

    require_once(VIEWS_PATH."validate-session.php");
    require_once(VIEWS_PATH."reservation-list.php"); 
}

public function getAllOwnerReservationsById(){
    $user= $_SESSION["loggedUser"];
    $reservationListToFiltrate = $this->ReservationDAO->getAllOwnerReservationsById($user->getId());
    $ReservationList=array();
    date_default_timezone_set("America/Buenos_aires");
    $today=date("Y-m-d",time());    


    foreach($reservationListToFiltrate as $row){

        if($row->getDateStart()>=$today){
            
            array_push($ReservationList,$row);
        }
    }
    

    require_once(VIEWS_PATH."validate-session.php");
    require_once(VIEWS_PATH."reservation-list-owner.php"); 
}




}



?>