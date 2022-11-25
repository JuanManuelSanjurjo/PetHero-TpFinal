<?php
namespace PHPMailer;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Models\Reservation as Reservation;
use DAO\Connection as Connection;

require "PHPMailer\src\PHPMailer.php";
require "PHPMailer\src\SMTP.php";
require "PHPMailer\src\Exception.php";

class MailService{

    public function sendCupon($reservation, $body){

        $mail = new PHPMailer(true);                                //true enables exceptions
        
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

            //Content
            $mail->isHTML(true);                                     //Set email format to HTML
            $mail->Subject = 'Here is your payment cupon';
            $mail->addEmbeddedImage(IMG_PATH."barcode_cupon.jpeg","barcode"); 
            $mail->addEmbeddedImage(IMG_PATH."qr_cupon.jpeg","qr"); 

            $mail->Body =  $body;
                          
            $mail->send();
            return true;

        } catch (Exception $e) {
            return false;

        }
    }

    public function sendNotice ($reservation, $body){
        $mail = new PHPMailer(true);                                //true enables exceptions
        
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

            //Content
            $mail->isHTML(true);                                     //Set email format to HTML
            $mail->Subject = 'Your reservation has been denied';
           
            $mail->Body =  $body;
                          
            $mail->send();
            return true;

        } catch (Exception $e) {
            return false;

        }
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