<?php
namespace Controllers;

use Controllers\KeeperController as KeeperController;

use Models\User as User;
use Models\Keeper as Keeper;
use Models\Owner as Owner;
use Models\Pet as Pet;
use DAO\KeeperDAO as KeeperDao;
use DAO\ReservationDAO as ReservationDAO;
use DateTimeZone;
use Models\Reservation;
use PHPMailer\MailService as MailService;

class ReservationController{

    private $KeeperDao;
    private $ReservationDAO;

    function __construct(){
        $this->KeeperDao = new KeeperDao();
        $this->ReservationDAO = new ReservationDAO();
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
            if($this->sendCupon($reservationId)){
                HomeController::showMessage("The owner has been notified via email.");
            }else{
                HomeController::showMessage("There was an error. You need to contact the owner to arrange payment.");
            }
        }else{
            $this->ReservationDAO->setConfirmation($reservationId, false);
        }
        HomeController::showMessage("Status updated.");
        $this->showAllReservations();
    }

    public function sendCupon($reservationId){
        $reservation = $this->ReservationDAO->getReservationById($reservationId);

        $mailer = new MailService();
        $body = $this->generateCuponForMail($reservationId);
        $mail = $mailer->sendCupon($reservation, $body);
        return $mail;
    }


    public function showKeeperList(){
        $keeperList=$this->KeeperDao->getAll();
        $user = $_SESSION["loggedUser"];
        $petList = $user->getPetList();
        
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."filter-Keepers.php");
        require_once(VIEWS_PATH."keeper-list.php");
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



public function generateCupon($reservationId){
    $reservation = $this->ReservationDAO->getReservationById($reservationId);

    $reservationNumber = $reservation->getReservationNumber();
    $name = $reservation->getOwner()->getName();
    $surname = $reservation->getOwner()->getSurname();
    $pet = $reservation->getPet()->getName();
    $total = $reservation->getCompensation();
    $dateStart = $reservation->getDateStart(); 
    $dateEnd = $reservation->getDateEnd(); 
    $keeper = $reservation->getKeeper()->getUserName(); 
    $qrCupon = FRONT_ROOT.IMG_PATH."qr_cupon.jpeg"; 
    $barcodeCupon = FRONT_ROOT.IMG_PATH."barcode_cupon.jpeg"; 

    require_once(VIEWS_PATH."paymentCupon.php"); 
}

public function generateCuponForMail($reservationId){
    $reservation = $this->ReservationDAO->getReservationById($reservationId);

     ob_start();   // Out Buffer.
            
    $reservationNumber = $reservation->getReservationNumber();
    $name = $reservation->getOwner()->getName();
    $surname = $reservation->getOwner()->getSurname();
    $pet = $reservation->getPet()->getName();
    $total = $reservation->getCompensation();
    $dateStart = $reservation->getDateStart(); 
    $dateEnd = $reservation->getDateEnd(); 
    $keeper = $reservation->getKeeper()->getUserName(); 
    $qrCupon = "cid:qr"; 
    $barcodeCupon = "cid:barcode";        
    require_once(VIEWS_PATH."paymentCupon.php"); 
    $body   = ob_get_contents();       
    ob_get_clean();
    
    return $body;
}

private function checkPaymentImg($file, $reservationId){
    $user = $_SESSION["loggedUser"];
    $fileExtExplode = explode('.',$file['name']);
    $fileExt = strtolower(end( $fileExtExplode));

    $fileName = $user->getId() . '_' . $reservationId .'_payment.' . $fileExt;
    
    $fileDestination = ROOT.VIEWS_PATH."payments/" . $fileName ;

    $allowed = array('jpeg','jpg','pdf','png');
    $size = 50000000;
    
    if(in_array($fileExt,$allowed)){
        if($file['error'] == 0){
            if($file['size'] < $size ){   //20mb
                move_uploaded_file($file['tmp_name'],$fileDestination);
                HomeController::showMessage("your file:  ". $file['name'] . ", was uploaded succesfully.");
            } else{
                HomeController::showMessage("The file is too big.");
            }
        }else{
            HomeController::showMessage("There was an error uploading your file.");
        }
    }else{
        HomeController::showMessage("There was an error uploading files, try again.");
    }

    return $fileName;

}

public function uploadPayment($reservationId, $payment){
    require_once(VIEWS_PATH."validate-session.php");
    $user = $_SESSION["loggedUser"];

    if(isset($_POST)  )  {
        $photoName = $this->checkPaymentImg($payment, $reservationId);       
    }        

    $this->ReservationDAO->updatePayment($photoName,$reservationId);
    
    $ReservationList=$this->ReservationDAO->getAllOwnerReservationsById($user->getId());

    require_once(VIEWS_PATH."reservation-list-owner.php");
}

public function showPayment($reservationId){
    $reservation = $this->ReservationDAO->getReservationById($reservationId);

    require_once(VIEWS_PATH."show-payment.php");
}

public function getPayment($reservationId){
    $reservation = $this->ReservationDAO->getReservationById($reservationId);

    if($reservation){
        $fileName = $reservation->getPayment();
        $fileExt = explode('.',$fileName);
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . $fileName);
        header("Content-Type: application/". $fileExt);
        header("Content-Transfer-Emcoding: binary");

        $filepath =  ROOT.VIEWS_PATH."payments/" . $reservation->getPayment();
        flush();
        readfile($filepath);
        HomeController::showMessage("Download succesful.");
    }else{
        HomeController::showMessage("No payment found.");
    }

}



}



?>