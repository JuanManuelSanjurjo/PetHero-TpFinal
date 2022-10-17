<?php
namespace Models;


class Pet{
    private $id;
    private $idOwner;
    private $name;
    private $photo;
    private $breed;
    private $size;
    private $vaxPlanImg;
    private $video;
    private $observations;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
  
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getBreed()
    {
        return $this->breed;
    }

    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    public function getVaxPlanImg()
    {
        return $this->vaxPlanImg;
    }

    public function setVaxPlanImg($vaxPlanImg)
    {
        $this->vaxPlanImg = $vaxPlanImg;

        return $this;
    }

    public function getObservations()
    {
        return $this->observations;
    }

    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }
}






?>