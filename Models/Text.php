<?php
namespace Models;

class Text{
    private $id;
    private $idChat;
    private $message;
    private $sender;
    private $receiver;
    private $textDate;  // DATETIME

    /**
     * Get the value of textDate
     */ 
    public function getTextDate()
    {
        return $this->textDate;
    }

    /**
     * Set the value of textDate
     *
     * @return  self
     */ 
    public function setTextDate($textDate)
    {
        $this->textDate = $textDate;

        return $this;
    }

    /**
     * Get the value of receiver
     */ 
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of receiver
     *
     * @return  self
     */ 
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of sender
     */ 
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of sender
     *
     * @return  self
     */ 
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of idChat
     */ 
    public function getIdChat()
    {
        return $this->idChat;
    }

    /**
     * Set the value of idChat
     *
     * @return  self
     */ 
    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

?>