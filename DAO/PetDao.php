<?php
namespace DAO;

use Controllers\HomeController;
use Exception;
use Models\Pet as Pet;
//use Models\Owner as Owner;
use DAO\OwnerDAO as OwnerDAO;
//use DAOJSON\KeeperDAO as KeeperDAO;

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

            $pet = $this->getById($id); // Guarda el objeto PET para poder borrar las imagenes/videos despues de la QUERY
            
            $this->connection = Connection::GetInstance();
            
            $this->connection->ExecuteNonQuery($query,$parameters);
            
            //// BORRA IMAGENES DEL DIRECTORIO
            if($pet->getPhoto()!=null){
            unlink(ROOT.VIEWS_PATH."user-images/" . $pet->getPhoto());
            }
            if($pet->getVaxPlanImg()!=null){
            unlink(ROOT.VIEWS_PATH."user-images/" . $pet->getVaxPlanImg());
            }
            if($pet->getVideo()!=null){
                unlink(ROOT.VIEWS_PATH."user-videos/" . $pet->getVideo());
            } 
            //// BORRA IMAGENES DEL DIRECTORIO
            return 1;
        }catch(Exception $ex){
            return 0;
            //throw $ex;
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
                $pet->setPetType($row["petType"]);

                array_push($petList,$pet);

            }
            return $petList;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }


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
                $pet->setPetType($row["petType"]);

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
                $pet->setPetType($row["petType"]);

            }

            return $pet;

        }
        catch(Exception $ex){
            throw $ex;
        }
    }  

    public function modifyPet(Pet $pet){

        try{  
            $id= $pet->getId();
            
            $query= "UPDATE ".$this->tableName." SET id = :id, idOwner = :idOwner , name = :name, photo = :photo, breed = :breed, size = :size, vaxPlanImg = :vaxPlanImg, video = :video, observations = :observations, petType = :petType WHERE (id = ". $id .")";

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
            
            $ownerDao = new OwnerDAO();
            $_SESSION["loggedUser"] = $ownerDao->getById($pet->getIdOwner());

        }
        catch(Exception $ex){
            throw $ex;
        }
          

    }




    




}







?>