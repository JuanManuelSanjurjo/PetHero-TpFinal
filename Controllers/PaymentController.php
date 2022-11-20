<?php
namespace Controllers;

use DAO\PaymentDAO as PaymentDAO;
use DAO\ReservationDAO as ReservationDAO;
use Models\Payment as Payment;

class PaymentController{
    private $PaymentDAO;

    function __construct(){
        $this->PaymentDAO = new PaymentDAO();
        $this->ReservationDAO = new ReservationDAO();        
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
        $qrCupon = FRONT_ROOT.IMG_PATH."qr_cupon.jpeg"; 
        $barcodeCupon = FRONT_ROOT.IMG_PATH."barcode_cupon.jpeg"; 
        
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
                    HomeController::showMessage("your file:  ". $file['name'] . ", was uploaded succesfully");
                } else{
                    HomeController::showMessage("The file is too big");
                }
            }else{
                HomeController::showMessage("There was an error uploading your file");
            }
        }else{
            HomeController::showMessage("There was an error uploading files, try again");
        }

        return $fileName;

    }

    public function uploadPayment($reservationId, $payment){
        require_once(VIEWS_PATH."validate-session.php");
        $user = $_SESSION["loggedUser"];

        if(isset($_POST)  )  {
            $photoName = $this->checkPaymentImg($payment, $reservationId);
            $payment = new Payment();
            $payment->setIdReservation($reservationId);
            $payment->setFileName($photoName);
        }

        $exist = $this->PaymentDAO->getByReservationId($reservationId);
        if($exist){
            $this->PaymentDAO->updatePayment($payment);
        }else{
            $this->PaymentDAO->add($payment);
        }

        require_once(VIEWS_PATH."home-owner.php");
    }

    public function showPawment($reservationId){
        $payment = $this->PaymentDAO->getByReservationId($reservationId);

        require_once(VIEWS_PATH."show-payment.php");
    }

    public function getPayment($reservationId){
        $payment = $this->PaymentDAO->getByReservationId($reservationId);

        if($payment){
            $fileName = $payment->getFileName();
            $fileExt = explode('.',$fileName);
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=" . $fileName);
            header("Content-Type: application/". $fileExt);
            header("Content-Transfer-Emcoding: binary");
 
            $filepath =  ROOT.VIEWS_PATH."payments/" . $payment->getFileName();
            flush();
            readfile($filepath);
            HomeController::showMessage("Download succesful");
        }else{
            HomeController::showMessage("No payment found");
        }

    }



}

?>