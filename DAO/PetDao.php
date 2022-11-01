<?php
namespace DAO;

use Exception;
use Models\Pet as Pet;
use Models\Owner as Owner;

class PetDao{

    private $connection;
    private $tableName= "pets";

    public function register(Pet $pet)
    {
        try{
            $query = "INSERT INTO".$this->tableName."(id, idOwner, name, photo, breed, size, vaxPlanImg, video, observation, petType) VALUES (:id, :idOwner, :name, :photo, :breed, :size, :vaxPlanImg, :video, :observation, :petType)";

            $parameters["id"]           = $pet->getId();
            $parameters["idOwner"]      = $pet->getIdOwner();
            $parameters["name"]         = $pet->getName();
            $parameters["photo"]        = $pet->getPhoto();
            $parameters["breed"]        = $pet->getBreed();        
            $parameters["size"]         = $pet->getSize();        
            $parameters["vaxPlanImg"]   = $pet->getVaxPlanImg();        
            $parameters["video"]        = $pet->getVideo();
            $parameters["observation"]  = $pet->getObservations();        
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
                $pet->setObservations ($row["observation"]);
                $pet->setPetType ($row["petType"]);

                array_push($keepersList,$pet);
            }

            return $petList;
        }catch(Exception $ex){
            throw $ex;
        }

    }


    public function Remove($id)
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

    public function addFilesToPet(Pet $pet){
        /*
        $this->retrieveData();
        
        foreach($this->petList as $pets){
            if($pets->getId() == $pet->getId()){
                $pets->setPhoto($pet->getPhoto());
                $pets->setVaxPlanImg($pet->getVaxPlanImg());
                $pets->setVideo($pet->getVideo());
            }
        }
        $this->saveData();
        */
    }

    public function cancelPetRegister($id)
    {            
       /* $this->retrieveData();
            
        $this->petList = array_filter($this->petList, function($pet) use($id){                
            return $pet->getId() != $id;
        });
            
        $this->saveData();
        */

        //tiene que borrar el registro

    }

    




}







?>