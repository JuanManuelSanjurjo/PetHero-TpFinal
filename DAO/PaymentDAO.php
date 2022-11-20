<?php
namespace DAO;

use Exception;
use Models\Payment as Payment;

class PaymentDAO{

    private $connection;
    private $tableName= "payments";

    public function add(Payment $payment)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (id, idReservation , fileName) VALUES (:id, :idReservation , :fileName)";

            $parameters["id"]      = $payment->getId() ;
            $parameters["idReservation"]  = $payment->getIdReservation() ;
            $parameters["fileName"]  = $payment->getFileName() ;
           
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);

        }catch(Exception $ex){
            throw $ex;
        } 

    }

    public function getByReservationId($idReservation)
    {
        try{
            $payment = null;

            $query = "SELECT id, idReservation , fileName FROM ".$this->tableName." WHERE (idReservation = :idReservation)";

            $parameters["idReservation"] = $idReservation;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                        
            foreach($results as $row){
                $payment = new Payment;
                $payment->setId($row["id"]) ;
                $payment->setIdReservation($row["idReservation"]) ;
                $payment->setFileName($row["fileName"]) ;
               
            }

            return $payment;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  


    public function updatePayment(Payment $payment){

        try{  

            $idReservation= $payment->getIdReservation();
    
            $query= "UPDATE ".$this->tableName." SET  fileName = :fileName WHERE (idReservation = ". $idReservation .")";
                  
            $parameters["fileName"]        = $payment->getFileName();
                
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query,$parameters);
    
            }
        catch(Exception $ex){
            throw $ex;
        }


    }



}







?>