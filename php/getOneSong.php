<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');
include("functions.php");
if(isset($_GET['song_id'])){
    $song_id = intval($_GET['song_id']);

echo getOneSong($song_id);
}
?>