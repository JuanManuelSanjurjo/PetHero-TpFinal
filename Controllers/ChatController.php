<?php

namespace Controllers;

use DAO\ChatDao as ChatDao;
use DAO\TextDAO as TextDAO;
use Models\Text;

class ChatController{
    private $ChatDao;
    private $TextDAO;

    function __construct(){
        $this->ChatDao = new ChatDao();
            
    }

    public function showChat($keeperId, $ownerId){
        $chat = $this->ChatDao->getChatByIds($keeperId,$ownerId);
        $textList = $chat->getTextList();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."chat.php");

    }

    public function sendMessage($message, $to, $idChat){
        $user=$_SESSION["loggedUser"];
        date_default_timezone_set("America/Buenos_aires");
        $today=date("Y-m-d H:i:s",time()); 
        $text=new Text();
        $text->setDate($today);
        $text->setTo($to);
        $text->setIdChat($idChat);
        $text->setMessage($message);
        $text->setFrom($user->getId());
        $this->TextDAO->addText($text);

        
    }






}

?>