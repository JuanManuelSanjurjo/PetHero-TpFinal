<?php

namespace Controllers;

use DAO\ChatDao as ChatDao;
use DAO\TextDAO as TextDAO;
use Models\Owner;
use Models\Text as Text;

class ChatController{
    private $ChatDao;
    private $TextDAO;

    function __construct(){
        $this->ChatDao = new ChatDao();
        $this->TextDAO = new TextDAO();
            
    }

    public function showChat($keeper, $owner){
        $user = $_SESSION["loggedUser"];
        $chat = $this->ChatDao->getChatByIds($keeper,$owner);
        $textList = array_reverse($chat->getTextList());

        foreach($textList as $text){
            if($text->getSender() == $chat->getKeeper()->getId()){
                $text->setSender($chat->getKeeper()->getName());
            }else{
                $text->setSender($chat->getOwner()->getName());
            }
        }

        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."chat.php");
    }


    public function showChatList() {
        $user = $_SESSION["loggedUser"];
        $list = $this->ChatDao->getAllByUser($user);
        require_once(VIEWS_PATH."validate-session.php");

        if($user instanceof Owner){
            require_once(VIEWS_PATH."owner-chat-list.php");
        }else{
            require_once(VIEWS_PATH."keeper-chat-list.php");
        }
    }

    public function sendMessage($message, $idChat, $keeper, $owner){
        $user=$_SESSION["loggedUser"];
        if($user instanceof Owner){
            $receiver = $keeper;
            $sender = $owner;
        }else{
            $receiver = $owner;
            $sender = $keeper;
        }

        date_default_timezone_set("America/Buenos_aires");
        $today=date("Y-m-d H:i:s",time()); 
        $text=new Text();
        $text->setTextDate($today);
        $text->setReceiver($receiver);
        $text->setIdChat($idChat);
        $text->setMessage($message);
        $text->setSender($sender);
        $this->TextDAO->addText($text);

        HomeController::showMessage("Message send");
        $this->showChat($keeper,$owner);
    }






}

?>