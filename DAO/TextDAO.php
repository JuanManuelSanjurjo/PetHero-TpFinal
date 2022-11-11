<?php
namespace DAO;

use Exception;
use Models\Text as Text;

class TextDAO{

    private $connection;
    private $tableName="Texts";

    public function addText(Text $text)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (id, idChat, message, from, to, date) VALUES (:id, :idChat, :message, :from, :to, :date)";

            $parameters["id"]           =$text->getId();
            $parameters["idChat"]       =$text->getIdChat();
            $parameters["message"]      =$text->getMessage();
            $parameters["from"]         =$text->getFrom();
            $parameters["to"]           =$text->getTo();        
            $parameters["date"]         =$text->getDate();        
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);


        }catch(Exception $ex){
            throw $ex;
        } 
        
    }

    
    public function getAll()
    {
        try{
            
            $textList = array();
            $query = "SELECT id, idChat, message, from, to, date FROM ". $this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $text = new Text();

                $text->setId($row["id"]);
                $text->setIdChat ($row["idChat"]);
                $text->setMessage ($row["message"]);
                $text->setTo ($row["from"]);
                $text->setDate ($row["to"]);
                $text->setDate ($row["date"]);
                
                
                array_push($textList,$text);
            }

            return $textList;
        }catch(Exception $ex){
            throw $ex;
        }

    }

    public function Remove($id)
    {
        try{
        $query= "DELETE FROM ".$this->tableName." WHERE (id = " . $id .")";

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query);
        return true;
        }catch(Exception $ex){
            return false;
            throw $ex;
        }
    }

    public function getByIdChat($idChat)
    {
        try{
            
            $textList = array();

            $query = "SELECT id, idChat, message, from, to, date FROM ". $this->tableName . " WHERE (idChat = :idChat)";
            
            $parameters["idChat"] = $idChat;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
            
            foreach($results as $row){
            
                $text = new Text();

                $text->setId($row["id"]);
                $text->setIdChat ($row["idChat"]);
                $text->setMessage ($row["message"]);
                $text->setTo ($row["from"]);
                $text->setDate ($row["to"]);
                $text->setDate ($row["date"]);
                
                
                array_push($textList,$text);
            
            }
            return $textList;
           
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  

    
    public function getById($id)
    {
        try{
            
            $textList = array();

            $query = "SELECT id, idChat, message, from, to, date FROM ". $this->tableName . " WHERE (id = :id)";
            
            $parameters["id"] = $id;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
            
            foreach($results as $row){
            
                $text = new Text();

                $text->setId($row["id"]);
                $text->setIdChat ($row["idChat"]);
                $text->setMessage ($row["message"]);
                $text->setTo ($row["from"]);
                $text->setDate ($row["to"]);
                $text->setDate ($row["date"]);
                
                
                array_push($textList,$text);
            
            }
            return $textList;
           
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  

















}








?>