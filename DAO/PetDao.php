<?php
namespace DAO;

use Models\Pet as Pet;

class PetDao{
    private $petList = [];
    private $fileName = ROOT."Data/Pets.json";



    public function getById($id){
        $this->retrieveData();

        $pets = array_filter($this->petList, function($pet) use($id){
            return $pet->getId() == $id;
        });
        $pets = array_values($pets); //Reordering array indexes
        return (count($pets) > 0) ? $pets[0] : null;

    }


    public function register(Pet $pet){

        $this->retrieveData();
        
        $pet->setId($this->getNextId());  
        
        array_push($this->petList, $pet);

        $this->saveData();

    }

    public function getAll()
    {
        $this->retrieveData();

        return $this->petList;
    }
/*
    public function removePet($id)
        {            
            $this->retrieveData();
            
            $this->petList = array_filter($this->petList, function($pet) use($id){                
                return $pet->getId() != $id;
            });
            
            $this->saveData();
        }
*/
    
    public function retrieveData(){

        $this->petList = [];

             if(file_exists($this->fileName))
             {
                $jsonToDecode = file_get_contents($this->fileName);
                $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : [];
                
                foreach($contentArray as $content)
                {
                    $pet = new Pet();
                    $pet->setId($content["id"]);
                    $pet->setIdOwner($content["idOwner"]);
                    $pet->setName($content["name"]);
                    $pet->setPhoto($content["photo"]);
                    $pet->setBreed($content["breed"]);
                    $pet->setSize($content["size"]);
                    $pet->setVaxPlanImg($content["vaxPlanImg"]);
                    $pet->setObservations($content["observations"]);

                    array_push($this->petList, $pet);
                }
             }
    
    }


    public function saveData(){

        $arrayToEncode = [];

            foreach($this->petList as $pet)
            {
                $valuesArray = [];
                $valuesArray["id"] = $pet->getId();
                $valuesArray["idOwner"] = $pet->getIdOwner();
                $valuesArray["name"] = $pet->getName();
                $valuesArray["photo"] = $pet->getPhoto();
                $valuesArray["breed"] = $pet->getBreed();
                $valuesArray["size"] = $pet->getSize();
                $valuesArray["vaxPlanImg"] = $pet->getVaxPlanImg();
                $valuesArray["observations"] = $pet->getObservations();

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
    
    }


    private function getNextId()
    {
        $id = 0;
        foreach($this->petList as $pet)
        {
            $id = ($pet->getId() > $id) ? $pet->getId() : $id;
        }
        return $id+1;
    }






}







?>