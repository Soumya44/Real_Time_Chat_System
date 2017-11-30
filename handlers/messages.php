<?php 

include('../config.php');

switch( $_REQUEST['action'] )
{
        case "sendMessage":
        
            session_start();
            $query = $db->prepare("INSERT INTO messages SET user=?, message=?");
            $run = $query->execute([$_SESSION['username'], $_REQUEST['message']]);
            if( $run ) {
                echo true;
                exit;
            }
        break;        
    case "getMessage" :
            $query = $db->prepare("SELECT * FROM messages");
            $run = $query->execute();
            $rs = $query->fetchAll(PDO::FETCH_OBJ);
            $chat = '';
            foreach( $rs as $msg )
            {
//                $chat .= $msg->message.'<br>';
                $chat .= '<div class="box single-msg">
                    <strong>'.$msg->user.'</strong><br>'.$msg->message.'<br><span>'.date('d-m-Y h:i a', strtotime($msg->date)).'</span>
                </div>';
                echo $chat;
            }
        
        break;      
    
}
?>
