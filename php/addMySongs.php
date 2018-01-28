<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');
include("functions.php");
if(isset($_POST['user_id']) && isset($_POST['song_id'])){
    
    $user_id = intval($_POST['user_id']);
    $song_id = intval($_POST['song_id']);

    echo addMySongs($user_id, $song_id);
}

?>