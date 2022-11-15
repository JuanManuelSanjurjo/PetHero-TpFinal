<?php
namespace Models;


class Text{

    private $id;
    private $idChat;
    private $message;
    private $from;
    private $to;
    private $date;  // DATETIME

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)  // DATETIME
    {
        $this->date = $date;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
 
    public function getIdChat()
    {
        return $this->idChat;
    }

    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;

        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }
}

?>