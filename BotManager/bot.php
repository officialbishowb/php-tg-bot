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
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];
$reply_to_message_id=$update["message"]["reply_to_message"]["message_id"];
$reply_to_messageUSER_id=$update["message"]["reply_to_message"]["message_id"];
$fromChatId=$update["message"]["from"]["chat"]["id"];
$fromId=$userId["message"]["from"]["id"];
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

$approvedFile=file("approvedUser.txt");
$bannnedFile=file("bannedUser.txt");
$giveawayFile=file("nextgiveaway.txt");
$adminid="1137766669";
include 'botfunc.php';


/////////////////////////////////////////////////////=[APPROVED USER]=///////////////////////////////////////////////////////////////////////
if(file_get_contents("lockedUnlocked.txt")=="false" || $userId==$adminid){
 if(in_array($userId,$approvedFile) & !in_array($userId,$bannnedFile) || $userId==$adminid){//if the user is approved and not banned
    if(file_get_contents("giveawaymode.txt")=="off" || $userId==$adminid){ //giveaway mode
 
    ////////////////////////////////////=[START COMMAND]= ////////////////////////////////////
    if((strpos($message,"/start")===0)){
     sendMessage($chatId,"<b>Hello @$username</b>, %0AHow are you?%0A%0AType /cmds for more😃",$message_id);
    }
    ////////////////////////////////////=[CMDS COMMAND]= ////////////////////////////////////
    elseif((strpos($message,"/cmds")===0) || (strpos($message,"!cmds")===0)){
        sendMessage($chatId,"<b>All user commands</b>%0A/mystat <b>|</b> <code>Will give your info</code>%0A/nextgiveaway <b>|</b> <code>know when next giveaway is</code>%0A/mynotes <b>|</b> <code>Your notes</code>%0A%0A<b>/stop</b> <i>a special command to stop the bot without blocking</i>%0A%0A<b>For Admins</b>%0A/ban <i>id</i>%0A/unban <i>id</i>%0A/lock <i>'true' or 'false'</i>  <b>|</b> <code>lock the bot</code>%0A/code <i>code</i>  <b>|</b> <code>add code to detect valid giveaway code</code>%0A/giveawaymode <i>'on' or 'off'</i>  <b>|</b> <code>will turn bot into giveaway mode</code>",$message_id);
    }
    ////////////////////////////////////=[STAT COMMAND]= ////////////////////////////////////
    elseif((strpos($message,"/mystat")===0) ||  (strpos($message,"!mystat")===0)){
        sendMessage($chatId,"<b>Info:</b>%0A%0A<b>First name:</b> <code>$firstname</code>%0A<b>Username:</b> @$username%0A<b>User id:</b> <code>$userId</code>%0A<b>Profile link:</b> <a href='tg://user?id=$userId'>HERE</a>",$message_id);
    }
    ////////////////////////////////////=[GIVEAWAY COMMAND]= ////////////////////////////////////
    elseif((strpos($message,"/nextgiveaway")===0) || (strpos($message,"!nextgiveaway")===0)){
        $filegiveaway=fopen("nextgiveaway.txt",'r');
        $getContent=fread($filegiveaway,filesize("nextgiveaway.txt"));
        sendMessage($chatId,"Giveaway: <code> $getContent </code>",$message_id);
    }
    ////////////////////////////////////=[NOTES COMMAND]= ////////////////////////////////////
    elseif((strpos($message,"/mynotes")===0) || (strpos($message,"!mynotes")===0)){
    sendMessage($chatId,"<b>What do you want to do?</b>%0A%0A/savenotes <i>notes to save</i>%0A/deletenotes <b>|</b> <code>delete saved notes</code>%0A/getnotes <b>|</b> <code>get all saved note</code>",$message_id);
    }
    ////////////////////////////////////=[SAVE NOTES COMMAND]= ////////////////////////////////////
    elseif((strpos($message,"/savenotes")===0) || (strpos($message,"!savenotes")===0)){
         $getSaveNote=substr($message,11);

         if($getSaveNote==null){
             sendMessage($chatId,"<b>No notes to save!</b>%0APlease send /savenotes <i>and your note</i>",$message_id);
         }
         else{
            $noteSaving=urlencode($getSaveNote."\n");
           $fileSaving=$userId.".txt";

           $saveNotes=fopen("$userId.txt",'a+');
           fwrite($saveNotes,$noteSaving);
           fclose($saveNotes);
           sendMessage($chatId,"Your note has been saved 😀 to get the notes use the command /getnotes",$message_id);
         }
     } 
     ////////////////////////////////////=[DELETE NOTES COMMAND]= ////////////////////////////////////
    elseif((strpos($message,"/deletenotes")===0) ||(strpos($message,"!deletenotes")===0)){
        $fileSaving=$userId.".txt";
        if(unlink($fileSaving)==true){
            sendMessage($chatId,"Your saved notes has been <code>deleted</code>😀✅",$message_id);
        }
        else{
            sendMessage($chatId,"<b>Not notes to delete!</b>%0AProblem: <code>You dont have any notes saved</code>",$message_id);
        }
     } 
    ////////////////////////////////////=[GET NOTES COMMAND]= ////////////////////////////////////
    elseif((strpos($message,"/getnotes")===0) ||(strpos($message,"!getnotes")===0)){
    $fileSaving=$userId.".txt";
        
    if(file_get_contents($fileSaving)==true){ 
        $getContent=file_get_contents($fileSaving);
        sendMessage($chatId,"<b>Your saved notes</b>:%0A<code>$getContent</code>",$message_id);
    }
    else{
        sendMessage($chatId,"<b>No file found for your user id!</b>%0AProblem: <code>You dont have any notes saved</code>",$message_id);
    }
    }
    ////////////////////////////////////=[STOP BOT]= ////////////////////////////////////
    elseif((strpos($message,"/stop")===0) ||(strpos($message,"!stop")===0)){
        sendMessage($chatId,"<b>Your are going to stop the BOT</b>%0A%0AMeans you will recieve no notification or message until you type again in this BOT<b>%0A%0A<i>Please type /confirm to confirm it</i></b>",$message_id);
    } 
    elseif((strpos($message,"/confirm")===0) ||(strpos($message,"!confirm")===0)){

           if(substr_count(file_get_contents("approvedUser.txt"),$userId)>0){ 

              $stopId=file_get_contents("approvedUser.txt");
              $removeId=str_replace($userId,'',$stopId);
              file_put_contents("approvedUser.txt",$removeId);
              sendMessage($chatId,"Bot has been stopped..",$message_id);
           }
           else{
               sendMessage($chatId,"<b>It seems you are the admin</b>",$message_id);
           }
       }
     ////////////////////////////////////=[FORWARD MSG]= ////////////////////////////////////
    elseif($userId!=$adminid){
        forwardMessage($adminid,$chatId,$message_id);
    }
   }
   else{
       if($message==file_get_contents("giveawaycode.txt")){
        sendMessage($chatId,"Giveaway code detected ✅",$message_id);
        forwardMessage($adminid,$chatId,$message_id);
       }
       else{
        sendMessage($chatId,"<b>❗Alert </b>currently Giveaway mode is <code>on</code>%0A%0A<b>Which means message which are not detected as Giveawaycode wont be send</b>%0A<i>And if you are getting this message means your message is not Givewaycode</i>",$message_id);
       }
   }
}

/////////////////////////////////////////////////////=[BANNED USER]=///////////////////////////////////////////////////////////////////////

elseif(in_array($userId,$bannnedFile)){//if the user is banned
    if($message==$message){
        sendMessage($chatId,"<b>User</b> @".$username."[<code>".$userId."</code>] <b>seems to be banned here!</b>",$message_id);
}
}

//////////////////////////////////////////////////=[NEW USER]=///////////////////////////////////////////////////////////////////////

elseif(!in_array($userId,$approvedFile) & !in_array($userId,$bannnedFile)){//if the user is not approved and not banned
    if((strpos($message,"/start")===0) ||$message==$message){

         sendMessage($chatId,"<b></b>Please give me a second.</b><code>I am approving you..</code>",$message_id);
         //approve User
         $openApproved=fopen("approvedUser.txt",'a+');
         $userIdSave=$userId."\n";
         fwrite($openApproved,$userIdSave);
         fclose($openApproved);
         //end
         sendMessage($chatId,"You are now approved🎉. %0A<b>Please send your message again</b> or <b>type /cmds for more🙂</b>",$message_id);

        }
}
}
else{
    sendMessage($chatId,"<b>Currently this bot is locked by the owner!</b>%0ANo media and co will  be sent..",$message_id);
}
/////////////////////////////////////////////////////=[ADMIN USER]=///////////////////////////////////////////////////////////////////////

if($userId==$adminid){

//////////////////////////=[BAN USER]=//////////////////////////
if((strpos($message,"/ban")===0) || (strpos($message,"!ban")===0)){
    $getBanId=substr($message,5);
    if($getBanId==null){
        sendMessage($chatId,"<b>Can you teach me to ban user without</b> ID?",$message_id);
    }
    else{
    //ban user
   if(!substr_count(file_get_contents("bannedUser.txt"),$getBanId)>0){
       // Ban user
       $banUser=fopen("bannedUser.txt",'a+');
       $banUserId=$getBanId."\n";
       fwrite($banUser,$banUserId);
       fclose($banUser);
       //end
       sendMessage($chatId,"User [<code>$getBanId</code>] is now banned ✅",$message_id);
       sendAll($getBanId,"You are banned");
    
        if(substr_count(file_get_contents("approvedUser.txt"),$getBanId)>0){
            //remove user from approved
          $asArray=explode("\n","approvedUser.txt");
          array_diff($asArray,$userId);
          sendMessage($chatId,"User [<code>$getBanId</code>] is now banned ✅",$message_id);
        }
       else{
           sendMessage($chatId,"User was actually not approved😆",$message_id);
       }
    }
      else{
        if(substr_count(file_get_contents("approvedUser.txt"),$getBanId)>0){
            $getApprovedContent=file_get_contents("approvedUser.txt");
            $removeApprovedContent=str_replace($getBanId,'',$getApprovedContent);
            file_put_contents("approvedUser.txt",$removeApprovedContent);
            sendMessage($chatId,"User [<code>$getBanId</code>] is now banned ✅",$message_id);
        }
        else{
            sendMessage($chatId,"User seems to be banned already",$message_id);
        }
      }
    }
}
//////////////////////////=[UNBAN USER]=//////////////////////////
   elseif((strpos($message,"/unban")===0) || (strpos($message,"!unban")===0)){
       $getUnbanId=substr($message,7);
       if($getUnbanId==null){
        sendMessage($chatId,"<b>Can you teach me to unban user without</b> ID?",$message_id);
    }
    else{
        if(substr_count(file_get_contents("bannedUser.txt"),$getUnbanId)>0){
            $getUnBanContent=file_get_contents("bannedUser.txt");
            $removeBanContent=str_replace($getUnbanId,'',$getUnBanContent);
            file_put_contents("bannedUser.txt",$removeBanContent);
            sendMessage($chatId,"User [<code>$getUnbanId</code>] is now unbanned ✅",$message_id);
            sendAll($getUnbanId,"You are unbanned");
         }
         else{
             sendMessage($chatId,"User is not banned",$message_id);
         }
        }
    }
/*
//didnt work as expected in php
//////////////////////////=[NOTIFY USER]=//////////////////////////
    elseif((strpos($message,"/notify")===0) ||(strpos($message,"!notify")===0)){
       $getsendMessage=substr($message,8);
       if($getsendMessage==null){
           sendMessage($chatId,"Message has been sent <code>unsuccessfully😄</code>",$message_id);
       }
       else{
           if(file_get_contents("approvedUser.txt")==null){
               sendMessage($chatId,"<b>No user found...</b>%0AEmtpy file",$message_id);
           }
           else{
            for($i=0;$i<count($approvedFile);$i++){
                sendAll($approvedFile[$i],$getsendMessage);
            }
            sendMessage($chatId,"Message has been sent <code>successfully😄</code>",$message_id);
           }
    }
    }
*/
//////////////////////////=[ADD GIVEAWAY TIME]=//////////////////////////
    elseif((strpos($message,"/giveawaytime")===0) || (strpos($message,"!giveawaytime")===0)){
        $getNextMsg=substr($message,14);
         if($getNextMsg==null){
             sendMessage($chatId,"No giveaway time found !",$message_id);
         }
         else{
            $giveawayTime=fopen("nextgiveaway.txt",'w');
            fwrite($giveawayTime,$getNextMsg);
            fclose($giveawayTime);
            sendMessage($chatId,"Giveaway time added",$message_id);
         }
    }
    //////////////////////////=[LOCK/UNLOCK BOT]=//////////////////////////
    elseif((strpos($message,"/lock")===0)|| (strpos($message,"!lock")===0)){
        $getStringBoolean=substr($message,6);
        if($getStringBoolean==null){
            sendMessage($chatId,"How to lock without any argument?",$message_id);
        }
        elseif($getStringBoolean=="true"){
            file_put_contents("lockedUnlocked.txt","true");
            sendMessage($chatId,"Locked🔒",$message_id);

            for($i=0;$i<count($approvedFile);$i++){
                sendAll($approvedFile[$i],"<b>This bot is currently <code>locked</code></b>");
            }
        }
        else{
            file_put_contents("lockedUnlocked.txt","false");
            sendMessage($chatId,"Unlocked🔓",$message_id);
            
            for($i=0;$i<count($approvedFile);$i++){
              sendAll($approvedFile[$i],"<b>This bot is now <code>unlocked</code></b>");
            }
        }
    }

    //////////////////////////=[GIVEAWAY CODES BOT]=//////////////////////////
    elseif((strpos($message,"/code")===0) ||(strpos($message,"!code")===0)){
        $getCode=substr($message,6);

        $openFile=fopen("giveawaycode.txt",'w');
        fwrite($openFile,$getCode);
        fclose($openFile);

        sendMessage($chatId,"Code has been saved  ✔",$message_id);
    }
    elseif((strpos($message,"/giveawaymode")===0) ||(strpos($message,"!giveawaymode")===0)){
        $getModeType=substr($message,14);
        if($getModeType==null){
            sendMessage($chatId,"Cant save a null value",$message_id);
        }
        else{
           file_put_contents("giveawaymode.txt",$getModeType);
           $getMode=file_get_contents("giveawaymode.txt");
           sendMessage($chatId,"You mode has been saved%0AGiveaway mode is <code>$getMode</code>",$message_id);
        }
    }
   else{
       
    //make a command to reply to sender msg
   }
        
}
?>
