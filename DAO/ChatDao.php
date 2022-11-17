<?php
namespace DAO;

use Controllers\HomeController;
use Exception;
use Models\Text as Text;
use DAO\TextDAO as TextDAO;
use Models\Owner as Owner;
use DAO\OwnerDao as OwnerDao;
use Models\Keeper as Keeper;
use DAO\KeeperDAO as KeeperDAO;
use Models\Chat;

class  ChatDao{

    private $connection;
    private $tableName= "chats";

   
    public function addChat(Text $text)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (id, owner, keeper) VALUES (:id, :owner, :keeper)";

            $parameters["id"]           =$text->getId();
            $parameters["owner"]       =$text->getIdChat();
            $parameters["keeper"]      =$text->getMessage();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);


        }catch(Exception $ex){
            throw $ex;
        } 
        
    }

    
    public function getAll()
    {
        try{
            
            $chatList = array();
            $query = "SELECT id, owner, keeper FROM ". $this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $chat = new Chat();

                $chat->setId($row["id"]);                

                $ownerDAO = new OwnerDAO();
                $owner=$ownerDAO->getById($row["owner"]);
                $chat->setOwner($owner);
                // set keeper id
                $keeperDAO= new KeeperDao();
                $keeper = $keeperDAO->getById($row["keeper"]); ///Hacerla en el keeper
                $chat->setKeeper($keeper);          
                
                
                array_push($chatList,$chat);
            }

                        
            foreach($chatList as $row){
             
                $textDAO = new TextDAO();
                $textList = $textDAO->getById($row->getId());
                $row->setTextList($textList);
            }
            
            return $chatList;

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
    
    public function getById($id)
    {
        try{
            
          
            $query = "SELECT id, owner, keeper FROM ". $this->tableName . " WHERE (id = :id)";
            
            $parameters["id"] = $id;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                       
                $chat = new Chat();

                $chat->setId($results["id"]);
                $ownerDAO = new OwnerDAO();
                $owner=$ownerDAO->getById($results["owner"]);
                $chat->setOwner($owner);
                // set keeper id
                $keeperDAO= new KeeperDao();
                $keeper = $keeperDAO->getById($results["keeper"]); ///Hacerla en el keeper
                $chat->setKeeper($keeper);


                if($chat){
                    $textDAO = new TextDAO();
                    $textList = $textDAO->getByIdChat($chat->getId());
                    $chat->setTextList($textList);
                }
    
            
            return $chat;
           
        }
        catch(Exception $ex){
            throw $ex;
        }
    }  

    public function getChatByIds($keeper,$owner){

        try{
            
          
            $query = "SELECT id, owner, keeper FROM ". $this->tableName . " WHERE (keeper = :keeper AND owner = :owner)";
            
            $parameters["keeper"] = $keeper;
            $parameters["owner"] = $owner;

            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
            
            $chat = new Chat();
            
            foreach($results as $row){
                $chat->setId($row["id"]);
    
                $ownerDAO = new OwnerDAO();
                $owner=$ownerDAO->getById($row["owner"]);
                $chat->setOwner($owner);
                // set keeper id
                $keeperDAO= new KeeperDao();
                $keeper = $keeperDAO->getById($row["keeper"]); ///Hacerla en el keeper
                $chat->setKeeper($keeper);
    
                if($chat){
                    $textDAO = new TextDAO();
                    $textList = $textDAO->getByIdChat($chat->getId());
                    $chat->setTextList($textList);
                }
            }

            return $chat;
        }
        catch(Exception $ex){
            throw $ex;
        }

    }

    public function getAllByUser($user){

        try{
            if($user instanceof Owner){
                $owner = $user->getId();
                $query = "SELECT id, owner, keeper FROM ". $this->tableName . " WHERE ( owner = :owner)";
                $parameters["owner"] = $owner;
            }else{
                $keeper = $user->getId();
                $query = "SELECT id, owner, keeper FROM ". $this->tableName . " WHERE ( keeper = :keeper)";
                $parameters["keeper"] = $keeper;
            }


            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
            
            
            $chatList = [];
            
            foreach($results as $row){
                $chat = new Chat();
                $chat->setId($row["id"]);
    
                $ownerDAO = new OwnerDAO();
                $owner=$ownerDAO->getById($row["owner"]);
                $chat->setOwner($owner);
                // set keeper id
                $keeperDAO= new KeeperDao();
                $keeper = $keeperDAO->getById($row["keeper"]); ///Hacerla en el keeper
                $chat->setKeeper($keeper);
    
                if($chat){
                    $textDAO = new TextDAO();
                    $textList = $textDAO->getByIdChat($chat->getId());
                    $chat->setTextList($textList);
                }

                array_push($chatList,$chat);
            }

            return $chatList;
        }
        catch(Exception $ex){
            throw $ex;
        }

    }



}







?>