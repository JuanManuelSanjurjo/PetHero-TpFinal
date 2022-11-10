<?php

namespace Controllers;

use DAO\ChatDao as ChatDao;

class ChatController{
    private $ChatDao;


    function __construct(){
        $this->ChatDao = new ChatDao();
            
    }

    public function showChat($keeperId, $ownerId){
        $chat = $this->ChatDao->getChatByIds($keeperId,$ownerId);
        //$textList = $chat->getTextList();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."chat.php");

    }

    public function sendMessage($message){

    }



}

?>