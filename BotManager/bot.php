<?php

////////////////=============[⩈⨴BɐÅñ⨂ñýɱ⨂ŭş⨵⩈ | Bishow Bhattarai]===============////////////////

// https://api.telegram.org/bot<token>/setwebhook?url=url redirecting to the php file
$botToken = "bot token"; // Enter ur bot token
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
//main
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$lastname = $update["message"]["from"]["last_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];
$reply_to_message_id=$update["message"]["reply_to_message"]["message_id"];
$reply_to_message_user_id=$update["message"]["reply_to_message"]["from"]["id"];
$reply_to_message_first_name=$update["message"]["reply_to_message"]["from"]["first_name"];
$reply_to_message_last_name=$update["message"]["reply_to_message"]["from"]["last_name"];
$reply_to_message_username=$update["message"]["reply_to_message"]["from"]["username"];
$fromChatId=$update["message"]["reply_to_message"]["from"]["chat"]["id"];
$reply_to_message=$update["message"]["reply_to_message"];
//files
$documentName=$updates["message"]["document"]["file_name"];
$documentId=$updates["message"]["document"]["file_id"];
$documentUniqueId=$updates["message"]["document"]["file_unique_id"];
$documentCaption=$updates["message"]["document"]["caption"];
//photo
$photoName=$updates["message"]["photo"]["file_name"];
$photoId=$updates["message"]["photo"]["file_id"];
$photoUniqueId=$updates["message"]["photo"]["file_unique_id"];
$photoCaption=$updates["message"]["photo"]["caption"];
//sticker
$stickerName=$updates["message"]["sticker"]["file_name"];
$stickerId=$updates["message"]["sticker"]["file_id"];
$stickerUniqueId=$updates["message"]["sticker"]["file_unique_id"];
//animation
$animationName=$updates["message"]["animation"]["file_name"];
$animationId=$updates["message"]["animation"]["file_id"];
$animationUniqueId=$updates["message"]["animation"]["file_unique_id"];
/////////////////////////////////////////////////////////////////////////=[ALL MAIN COMMANDS]=/////////////////////////////////////////////////////////////////////////

include "botfunc.php";
$ownerId="1137766669";

$maintainceAsArr=explode("-",file_get_contents("maintaince.txt"));
if($maintainceAsArr[0]=="false" || $userId==$ownerId){ 
    #for approved normal user
    if(!substr_count(file_get_contents("banned.txt"),$userId)>0 && substr_count(file_get_contents("approved.txt"),$userId)>0 || $userId==$ownerId){
       if(file_get_contents("giveaway.txt")=="false" ||$userId==$ownerId){
        
        #general start
        if((strpos($message,"/start")===0)){
            sendMessage($chatId,"<b>Hello @$username</b>,%0AHow are you? hopefully fine%0A%0AWant to know what you can do here? Type /cmds",$message_id);
        }
        
        #general cmds 
        elseif((strpos($message,"/cmds")===0)){

            if($userId==$ownerId){
                sendMessage($chatId,"<b>Avaibale commands for you owner%0A/ban <i>id</i>%0A/unban <i>id</i>%0A/lock <i>reason</i>%0A/unlock%0A/code <i>giveaway code</i>%0A/giveaway <i>true/false</i>%0A/broadcast <i>msg</i> ! THIS DONT WORK !</b>%0A%0A<b>Here are the commands for normal user%0A/info <code>your info</code>%0A/mynotes <code> your notes</code></b>%0A%0A/stop <i>stop the bot</i>",$message_id);
            }
            else{
                sendMessage($chatId,"<b>Here are the commands avaiable for you%0A/info <code>your info</code>%0A/mynotes <code>your notes</code>%0A%0A/stop <i>stop the bot</i></b>",$message_id);
            }
        }

        #myinfo command
        elseif((strpos($message,"/info")===0)){
            sendMessage($chatId,"Getting your info...",$message_id);
            sleep(1.4);
            if($reply_to_message==true){

                editMessageText($chatId,$message_id+1,"<b>Info:</b>%0A<b>Username: @$reply_to_message_username</b>%0A<b>First name: <code>".$reply_to_message_first_name."</code></b>%0A<b>Last name: <code>$reply_to_message_last_name</code></b>%0A<b>User Id: <code>$reply_to_message_user_id</code></b>%0A<b>Profile link: <a href='tg://user?id=$reply_to_message_user_id'>Profile</a></b>",$message_id);
            }
            else{
                editMessageText($chatId,$message_id+1,"<b>Info:</b>%0A<b>Username: @$username</b>%0A<b>First name: <code>$firstname</code></b>%0A<b>Last name: <code>$lastname</code></b>%0A<b>User Id: <code>$userId</code></b>%0A<b>Profile link: <a href='tg://user?id=$userId'>Profile</a></b>",$message_id);
            }
        }

        #notes stuff
        elseif((strpos($message,"/mynotes")===0)){
          sendMessage($chatId,"What do you want to do?%0A<b>/savenotes <i>your notes to save</i>%0A/getnotes%0A/deletenotes</b>",$message_id);
        }
        #if msg is /savenotes
        elseif((strpos($message,"/savenotes")===0)){
         $getNotes=substr($message,11);
         if($getNotes==null){
             sendMessage($chatId,"No notes to save!",$message_id);
         }
         else{
            saveNotes($chatId,$message_id,$getNotes,$userId);
        }
        }
        #if msg is /getnotes
        elseif((strpos($message,"/getnotes")===0)){
            getNotes($chatId,$message_id,$getNotes,$userId);
        }
        #/get
        elseif((strpos($message,"/get")===0)){
            $noteNum=substr($message,5);
            $asArr=explode("%7C",file_get_contents($userId."_notes.txt"));

            if($noteNum=="all"){
             $f=file_get_contents($userId."_notes.txt");
             $f=str_replace("%7C","%0A%0A",$f);
             sendMessage($chatId,"<b>Here is all saved notes:%0A<code>$f</code> </b>",$message_id);
            }
            elseif($noteNum>count($asArr)){
                sendMessage($chatId,"<b>This note dont exist</b>",$message_id);
            }
            else{
                sendMessage($chatId,"<b>Here is your saved note:</b>%0A<code>".($asArr[$noteNum-1])."</code>",$message_id);
             }
        }

        #deletenotes
        elseif((strpos($message,"/deletenotes")===0)){
            unlink($userId."_notes.txt");
            sendMessage($chatId,"Your notes has been deleted",$message_id);
        }

        #stop the bot
        elseif((strpos($message,"/stop")===0)){

            if($userId!=$ownerId){
            sendMessage($chatId,"Stopping the bot...",$message_id);
             #remove from broadcast
            $file=file_get_contents("broadcast.txt");
            $file=str_replace($userId,'',$file);
            file_put_contents("broadcast.txt",$file);
            #remove from approved
            $file=file_get_contents("approved.txt");
            $file=str_replace($userId,'',$file);
            file_put_contents("approved.txt",$file);
            sleep(1.3);
            editMessageText($chatId,$message_id+1,"Bot has been stopped!");
        }
        else{
            sendMessage($chatId,"Owner really?",$message_id);
        }
    }

        #forward other msg
        else{
            if($userId!=$ownerId){
                forwardMessage($ownerId,$chatId,$message_id); 
            }
        }

       }
       else{
           if($message==file_get_contents("code.txt")){
               sendMessage($chatId,"Giveaway code detected ✔. Message has been sent",$message_id);
               forwardMessage($ownerId,$chatId,$message_id);
           }
           else{
               sendMessage($chatId,"<b>Giveaway mode is <code>true</code>.%0AThat means only giveway code will be send to the owner.%0A%0A<code>You are getting this message as your message is not a giveaway code</code></b>",$message_id);
           }
       }
    }
    #if the user is banned
    elseif(substr_count(file_get_contents("banned.txt"),$userId)>0){
        if($message==$message){
            sendMessage($chatId,"<b>You are banned for using this Bot</b>%0AWas it a mistake? <code>Contact the owner-</code>@beanonymousofficial",$message_id);
        }
    }
    
    #if the user is new to the bot
    elseif(!substr_count(file_get_contents("approved.txt"),$userId)>0){
        sendMessage($chatId,"<b>Seems like you are not approved..</b>",$message_id);
        sleep(0.9);
        editMessageText($chatId,$message_id+1,"Let me fix it 😉",$message_id);
        sleep(0.9);
        editMessageText($chatId,$message_id+1,"<b>I am approving you.</b> Please have some Patient",$message_id);

        #approve the user
        $f=fopen("approved.txt",'a+');
        fwrite($f,$userId."\n");
        fclose($f);
        #add the user chatid(is actually the user id) in broadcast file
        $f1=fopen("broadcast.txt",'a+');
        fwrite($f1,$chatId."\n");
        fclose($f1);
        
        sleep(1);
        editMessageText($chatId,$message_id+1,"<b>Congratulation</b> 😀🎉. You are now free to use this Bot",$message_id);
        sleep(0.8);
        editMessageText($chatId,$message_id+1,"<b>Type /cmds to know what you can do here..</b>",$message_id);
    }
}
else{
    $f=file_get_contents("maintaince.txt");
    $getInput=explode("-",$f);
    sendMessage($chatId,"<b>Bot is currently under maintaince%0AReason: <code>".$getInput[1]."</code></b>",$message_id);
}


/********************=Only for OWNER=********************/
if($userId=$ownerId){

 #ban user
 if((strpos($message,"/ban")===0)){
    $getBanId=substr($message,5);

     if($getBanId==null){
         sendMessage($chatId,"<b>No user was banned. Please provide a ID</b>",$message_id);
     }

     else{
         ban($chatId,$message_id,$getBanId);
     }
}

#unban user
elseif((strpos($message,"/unban")===0)){
    $getUnbanId=substr($message,7);
     if($getUnbanId==null){
         sendMessage($chatId,"<b>No user was unbanned. Please provide a ID</b>",$message_id);
     }

     else{
         unban($chatId,$message_id,$getUnbanId);
     }
}

#lock the bot
elseif((strpos($message,"/lock")===0)){
    $getReason=substr($message,6);

    if($getReason==null){
        sendMessage($chatId,"<b>Please send a reason..</b>",$message_id);
    }
    else{
        file_put_contents("maintaince.txt","true-".$getReason);
        $lockasArr=explode("-",file_get_contents("maintaince.txt"));
        sendMessage($chatId,"<b>Bot is locked: </b><code>".$lockasArr[0]."</code>",$message_id);
    }
}

#unlock the bot
elseif((strpos($message,"/unlock")===0)){

    file_put_contents("maintaince.txt","false");
    sendMessage($chatId,"<b>Bot is locked: </b><code>".file_get_contents("maintaince.txt")."</code>",$message_id);

}

#add giveaway code
elseif((strpos($message,"/code")===0)){
    $getCode=substr($message,6);
    if($getCode==null){
        sendMessage($chatId,"What to save?",$message_id);
    }
 else{
    file_put_contents("code.txt",$getCode);
    sendMessage($chatId,"<b>Giveaway code </b><code>".file_get_contents("code.txt")."</code> <b>has been saved</b>",$message_id);
 }

}

#is currently give or not
elseif((strpos($message,"/giveaway")===0)){
    $getBoolean=substr($message,10);
    if($getBoolean==null){
        sendMessage($chatId,"What to save?",$message_id);
    }
 else{
    file_put_contents("giveaway.txt",$getBoolean);
    sendMessage($chatId,"<b>Giveaway mode: </b><code>".file_get_contents("giveaway.txt")."</code>",$message_id);
 }

}

#broadcast a message
/******Note: This command is not working properly if any solution found please contact us ******/
elseif((strpos($message,"/broadcast")===0)){
    sendMessage($chatId,"This command is not working.. If you have any solution contact the owner",$message_id);
    /*
    $getMsg=substr($message,11);
    if($getMsg==null){
        sendMessage($chatId,"Nothing to send..",$message_id);
    }
    else{
    sendMessage($chatId,"<b>Message to send: <code>$getMsg</code>",$message_id);


#send the message
    sleep(0.6);
    sendMessage($chatId,"Sending...",$message_id);
    $allUser=file_get_contents("broadcast.txt");
    $allUser=explode("\n",$allUser);
    $i=0;
    $sleepTime=85;
    foreach($allUser as $sendUser){
        if(empty($sendUser)) continue;
        
        $sendData=[
            "chat_id"=> $sendUser,
            "text"=> $getMsg,
            "parse_mode"=> "HTML"
        ];
          sleep(1);
            $send=file_get_contents("https://api.telegram.org/bot".$botToken."/sendMessage?".http_build_query($sendData)); 
            $i++;
            editMessageText($chatId,$message_id+1,"Send status: $i/".count($allUser));
        
    }
    editMessageText($chatId,$message_id+1,"<b>Broadcast finished</b>%0A<code>$i/".count($allUser)."</code> people recieved the message");
    }
    */
}

/**Not working command if any solution contact the owner */
else{
    if($reply_to_message==true){
        sendMessage($reply_to_message_user_id,$reply_to_message,$reply_to_message_id);
    }
}
}
?>
