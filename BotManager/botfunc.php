<?php 
function sendMessage($chatId, $message, $message_id){
    $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
    file_get_contents($url);      
    }
    function sendAll($chatId, $message){
        $url = $GLOBALS["website"]."/sendMessage?chat_id=".$chatId."&text=".$message."&parse_mode=HTML";
        file_get_contents($url);      
        }
    //for admin
    function sendAdmin($message){
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

    //copy message
    function deleteMessage($chatId,$message_id){
        $url = $GLOBALS["website"]."/deleteMessage?chat_id=".$chatId."&message_id=".$message_id."&parse_mode=HTML";
        file_get_contents($url);      
    }

     //edit message
     function editMessageText($chatId,$message_id,$message){
        $url = $GLOBALS["website"]."/editMessageText?chat_id=".$chatId."&message_id=".$message_id."&text=".$message."&parse_mode=HTML";
        file_get_contents($url);      
    }

     //send audio
     function sendAudio($chatId,$audio_id){
        $url = $GLOBALS["website"]."/sendAudio?chat_id=".$chatId."&audio=".$audio_id."&parse_mode=HTML";
        file_get_contents($url);      
    }

    


    /******************************************************** == Other Function == ********************************************************/
   #ban user function
    function ban($chatId,$message_id,$banid){

        #check if user is approved or not if yes then remove it

         #when the user is approved
        if(substr_count(file_get_contents("approved.txt"),$banid)>0){
          $getId=file_get_contents("approved.txt");
          $getId=str_replace($banid,'',$getId);
          file_put_contents("approved.txt",$getId);
        }

        #check if the user is already banned or not if yes then send a notice

        #when the user is not banned
        if(!substr_count(file_get_contents("banned.txt"),$banid)>0){

            #save the id to banned file
            $f=fopen("banned.txt",'a+');
            fwrite($f,$banid."\n");
            fclose($f);
            sendMessage($chatId,"<b>User [<code>$banid</code>] is now banned ✅</b>",$message_id);
        }
        #if he is banned already
        else{
            sendMessage($chatId,"<b>User [<code>$banid</code>] seems to be banned already ❗</b>",$message_id);
        }

    }
  #unban user function
    function unban($chatId,$message_id,$unbanid){
        
        if(substr_count(file_get_contents("banned.txt"),$unbanid)>0){
            $getId=file_get_contents("banned.txt");
            $getId=str_replace($unbanid,'',$getId);
            file_put_contents("banned.txt",$getId);
            sendMessage($chatId,"<b>User [<code>$unbanid</code>] is now unbanned ✅</b>",$message_id);        
        }
        else{
            sendMessage($chatId,"<b>The user you are referring dont seems to banned ❗</b>",$message_id);
        }
    }
    

    #save notes
    function saveNotes($chatId,$message_id,$notes,$userid){
        #if a file already exist
        if(file_get_contents($userid."_notes.txt")==true){

            $f=fopen($userid."_notes.txt",'a+');
            fwrite($f,urlencode($notes."|"));
            fclose($f);

         sendMessage($chatId,"<b>Your notes has been saved to get it</b> type /getnotes",$message_id);
        }
        else{
            $f=fopen($userid."_notes.txt",'a+');
            fwrite($f,urlencode($notes."|"));
            fclose($f);
            sendMessage($chatId,"<b>Your notes has been saved to get it</b> type /getnotes",$message_id);
        }
    }

    #get notes
    function getNotes($chatId,$message_id,$notes,$userid){

    if(file_get_contents($userid."_notes.txt")==true){
     $getNotesCount=explode("%7C",file_get_contents($userid."_notes.txt"));
     $notesCount=count($getNotesCount);
     $realcount=$notesCount-1;
     sendMessage($chatId,"<b>There are/is ".$realcount." note(s) saved</b>%0AWhich note do you want?%0APlease type /get <i>and note number <code>example: /get 1 or /get all</code></i>",$message_id);
    }
    else{
        sendMessage($chatId,"<b>You have no notes saved. To save notes type </b> /savenotes <i>and your notes</i>",$message_id);
    }
}
  

    ////////////////=============[⩈⨴BɐÅñ⨂ñýɱ⨂ŭş⨵⩈]===============////////////////

?>
