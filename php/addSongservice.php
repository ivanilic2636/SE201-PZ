<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token ,Authorization, Token, token, TOKEN');
include("functions.php");

if(isset($_POST['song_name']) && isset($_POST['song_runtime']) && isset($_POST['song_link'])){
$song_name = $_POST['song_name'];
$song_runtime = $_POST['song_runtime'];
$song_link = $_POST['song_link'];

if(isset($_POST['band_id']) && isset($_POST['genere_id']) && !empty($_POST['band_id'] && !empty($_POST['genere_id']))){
	
	$band_id = intval($_POST['band_id']);
	$genere_id = intval($_POST['genere_id']);
}else{
	$band_id = null;
	$genere_id = null;
}

echo addSong($song_name,$song_runtime,$song_link,$band_id,$genere_id);
}
?>