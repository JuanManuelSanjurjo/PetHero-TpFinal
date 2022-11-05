<?php
namespace DAO;

use Exception;
use Models\Pet as Pet;
use Models\Owner as Owner;
use DAO\OwnerDAO as OwnerDAO;

class PetDao{

    private $connection;
    private $tableName= "pet";

    public function register(Pet $pet)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (id, idOwner, name, photo, breed, size, vaxPlanImg, video, observations, petType) VALUES (:id, :idOwner, :name, :photo, :breed, :size, :vaxPlanImg, :video, :observations, :petType)";

            $parameters["id"]           = $pet->getId();
            $parameters["idOwner"]      = $pet->getIdOwner();
            $parameters["name"]         = $pet->getName();
            $parameters["photo"]        = $pet->getPhoto();
            $parameters["breed"]        = $pet->getBreed();        
            $parameters["size"]         = $pet->getSize();        
            $parameters["vaxPlanImg"]   = $pet->getVaxPlanImg();        
            $parameters["video"]        = $pet->getVideo();
            $parameters["observations"]  = $pet->getObservations();        
            $parameters["petType"]      = $pet->getPetType();
            
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query,$parameters);
///// ES NUEVO; RENUEVA EL LOGGED USER
            $ownerDao = new OwnerDAO();
            $_SESSION["loggedUser"] = $ownerDao->getById($pet->getIdOwner());
///// ES NUEVO; RENUEVA EL LOGGED USER 

        }catch(Exception $ex){
            throw $ex;
        } 

    }

    public function getAll()
    {
        try{
            
            $petList = array();
            $query= "SELECT id, idOwner, name, photo, breed, size, vaxPlanImg, video, observation, petType FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            foreach($result as $row)
            {
                $pet = new Pet();
                $pet->setId($row["id"]);
                $pet->setIdOwner ($row["idOwner"]);
                $pet->setName ($row["name"]);
                $pet->setPhoto ($row["photo"]);
                $pet->setBreed ($row["breed"]);
                $pet->setSize ($row["size"]);
                $pet->setVaxPlanImg ($row["vaxPlanImg"]);
                $pet->setVideo ($row["video"]);
                $pet->setObservations ($row["observations"]);
                $pet->setPetType ($row["petType"]);

                array_push($keepersList,$pet);
            }

            return $petList;
        }catch(Exception $ex){
            throw $ex;
        }

    }


    public function cancelPetRegister($id)
    {
        try{
        $query= "DELETE FROM ".$this->tableName." WHERE (id = :id)";
 
        $parameters["id"] = $id;

        $this->connection = Connection::GetInstance();

        $this->connection->ExecuteNonQuery($query,$parameters);
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function getPetListByUserId ($idOwner){

        try{
            $petList = array();
            
            $query = "SELECT id, idOwner, name, photo, breed, size, vaxPlanImg, video, observations, petType FROM ".$this->tableName." WHERE (idOwner = :idOwner)";

            $parameters["idOwner"] = $idOwner;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                        
            foreach($results as $row){


                $pet = new Pet();
                $pet->setId($row["id"]);
                $pet->setIdOwner($row["idOwner"]);
                $pet->setName($row["name"]);
                $pet->setPhoto($row["photo"]);
                $pet->setBreed($row["breed"]);
                $pet->setSize($row["size"]);
                $pet->setVaxPlanImg($row["vaxPlanImg"]);
                $pet->setVideo($row["video"]);
                $pet->setObservations($row["observations"]);

                array_push($petList,$pet);

            }
            return $petList;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    /*
    public function getByOwnerId($idOwner)
    {
        try{
            $pet = null;
            
            $query = "SELECT id, idOwner, name, photo, breed, size, vaxPlanImg, video, observations, petType FROM ".$this->tableName." WHERE (idOwner = :idOwner)";

            $parameters["idOwner"] = $idOwner;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                        
            foreach($results as $row){


                $pet = new Pet();
                $pet->setId($row["id"]);
                $pet->setIdOwner($row["idOwner"]);
                $pet->setName($row["name"]);
                $pet->setPhoto($row["photo"]);
                $pet->setBreed($row["breed"]);
                $pet->setSize($row["size"]);
                $pet->setVaxPlanImg($row["vaxPlanImg"]);
                $pet->setVideo($row["video"]);
                $pet->setObservations($row["observations"]);

            }
            return $pet;

        }
        catch(Exception $ex){
            throw $ex;
        }
    } 

    */

    public function getPetListById($idOwner)
    {
        try{
            
            $petList = [];
            
            $query = "SELECT id, idOwner, name, photo, breed, size, vaxPlanImg, video, observations, petType FROM ".$this->tableName." WHERE (idOwner = :idOwner)";

            $parameters["idOwner"] = $idOwner;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                        
            foreach($results as $row){
                
                $pet = new Pet();
                $pet->setId($row["id"]);
                $pet->setIdOwner($row["idOwner"]);
                $pet->setName($row["name"]);
                $pet->setPhoto($row["photo"]);
                $pet->setBreed($row["breed"]);
                $pet->setSize($row["size"]);
                $pet->setVaxPlanImg($row["vaxPlanImg"]);
                $pet->setVideo($row["video"]);
                $pet->setObservations($row["observations"]);

                array_push($petList,$pet);
            }
            return $petList;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }  





    public function addFilesToPet(Pet $pet){
     
      try{  

        $id= $pet->getId();

        $query= "UPDATE ".$this->tableName." SET photo = :photo, vaxPlanImg = :vaxPlanImg, video = :video WHERE (id = ". $id .")";
              
        $parameters["photo"]        = $pet->getPhoto();
        $parameters["vaxPlanImg"]   = $pet->getVaxPlanImg();        
        $parameters["video"]        = $pet->getVideo();
            
        var_dump($query);
        var_dump($parameters);
        $this->connection = Connection::GetInstance();
        $this->connection->ExecuteNonQuery($query,$parameters);

        $ownerDao = new OwnerDAO();
        $_SESSION["loggedUser"] = $ownerDao->getById($pet->getIdOwner());
       
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function getById($id)
    {
        try{
            $pet = null;

            $query = "SELECT id, idOwner, name, photo, breed, size, vaxPlanImg, video, observations, petType FROM ".$this->tableName." WHERE (id = :id)";

            $parameters["id"] = $id;
            
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query,$parameters);
                        
            foreach($results as $row){


                $pet = new Pet();
                $pet->setId($row["id"]);
                $pet->setIdOwner($row["idOwner"]);
                $pet->setName($row["name"]);
                $pet->setPhoto($row["photo"]);
                $pet->setBreed($row["breed"]);
                $pet->setSize($row["size"]);
                $pet->setVaxPlanImg($row["vaxPlanImg"]);
                $pet->setVideo($row["video"]);
                $pet->setObservations($row["observations"]);

            }

            return $pet;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }  



    




}







?>