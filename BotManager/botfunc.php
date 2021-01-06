<?php 
// https://api.telegram.org/bot1348440990:AAEoNpq9i-XbBISQWq5tVCiAKNGWENr9wws/setwebhook?url=https://b692170bb266.ngrok.io/bruhniggaornot.php
// https://api.telegram.org/bot1348440990:AAEoNpq9i-XbBISQWq5tVCiAKNGWENr9wws/getMe
function sendMessage($chatId, $message, $message_id){
    $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
    file_get_contents($url);      
    }
    function sendAll($chatId, $message){
        $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatId."&text=".$message."&parse_mode=HTML";
        file_get_contents($url);      
        }
    //for admin
    function sendMessageAdmin($message){
        $url = $GLOBALS["website"]."/sendMessage?chat_id=1137766669&text=".$message."&parse_mode=HTML";
        file_get_contents($url);      
    }
    
    //forward msg
    function forwardMessage($adminid,$chatId, $message_id){
        $url = $GLOBALS["website"]."/forwardMessage?chat_id=".$adminid."&from_chat_id=".$chatId."&message_id=".$message_id."&parse_mode=HTML";
        file_get_contents($url);      
    }

    //copy msg
    function copyMessage($chatId,$adminid, $message_id){
        $url = $GLOBALS["website"]."/copyMessage?chat_id=".$adminid."&from_chat_id=".$chatId."&message_id=".$message_id."&parse_mode=HTML";
        file_get_contents($url);      
    }
    

    ////////////////=============[⩈⨴BɐÅñ⨂ñýɱ⨂ŭş⨵⩈]===============////////////////

?>