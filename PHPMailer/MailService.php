<?php
namespace PHPMailer;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use Controllers\HomeController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Models\Reservation as Reservation;
use DAO\Connection as Connection;

require "PHPMailer\src\PHPMailer.php";
require "PHPMailer\src\SMTP.php";
require "PHPMailer\src\Exception.php";

class MailService{

    public function sendCupon($reservation){

        //`true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                    // SMTP::DEBUG_SERVER;  //Enable verbose debug output
            $mail->isSMTP();                                         //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                //Enable SMTP authentication
            $mail->Username   = 'petheroapp.ar@gmail.com';           //SMTP username
            $mail->Password   =  $this->getCredentials();            //SMTP password
            $mail->SMTPSecure =  'ssl';                              //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                 // ssl implicit port 465, ssl explicit port 587 , default  25     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                                   
            
            //Recipients
            $mail->setFrom('petheroapp.ar@gmail.com', 'Pethero App');
            $mail->addAddress($reservation->getOwner()->getMail(), $reservation->getOwner()->getUserName());                   //Name is optional
            
            //$mail->addAddress('ellen@example.com');             
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            //Attachments
           // $mail->addAttachment('/var/tmp/file.tar.gz');          //Add attachments
           // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');     //Optional name
            
            //Content
            $mail->isHTML(true);                                     //Set email format to HTML
            $mail->Subject = 'Here is your payment cupon';
            $mail->addEmbeddedImage(IMG_PATH."barcode_cupon.jpeg","barcode"); 
            $mail->addEmbeddedImage(IMG_PATH."qr_cupon.jpeg","qr"); 

            $mail->Body    =  $this->generateCupon($reservation);
            /*
            ob_start();   // Out Buffer.
            
            $reservationNumber = $reservation->getReservationNumber();
            $name = $reservation->getOwner()->getName();
            $surname = $reservation->getOwner()->getSurname();
            $pet = $reservation->getPet()->getName();
            $total = $reservation->getCompensation();
            $dateStart = $reservation->getDateStart(); 
            $dateEnd = $reservation->getDateEnd(); 
            $keeper = $reservation->getKeeper()->getUserName(); 
            // si estuvieramos generando codigod e barra y qr lo generariamos antes de la vista
            
            require_once(VIEWS_PATH."paymentCupon.php"); 
            $mail->Body    = ob_get_contents();       
            // $mail->addEmbeddedImage(FRONT_ROOT.IMG_PATH."barcode_cupon.jpeg","one","barcode"); 

            // 'This is the HTML message body <b>in bold!</b>';
            
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            ob_get_clean();
            */
                     
            $mail->send();
            HomeController::showMessage("The owner has been notified via email.");
        } catch (Exception $e) {
            HomeController::showMessage("There was an error. You need to contact the owner to arrange payment.");
           /// $mail->ErrorInfo}";
        }
    }

    public function generateCupon($reservation){
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

    public function getCredentials(){
        
        try{
            
            $query= "SELECT * FROM `smpt_credentials` WHERE 1";
                       
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            
            foreach($result as $row)
            {
                $credential = $row["smpt_pass"];

            }
                        
            return $credential;
        }catch(Exception $ex){
            throw $ex;
        }
    }
}

?>