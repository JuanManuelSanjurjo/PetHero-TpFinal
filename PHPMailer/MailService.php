<?php
namespace PHPMailer;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Models\Reservation as Reservation;

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
            $mail->Password   = 'cfjtbgbdjggaxfqi';                  //SMTP password
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

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>