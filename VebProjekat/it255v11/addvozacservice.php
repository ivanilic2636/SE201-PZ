<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token ,Authorization, Token, token, TOKEN');
include("functions.php");


if(isset($_POST['ime']) && isset($_POST['prezime'])){
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];

if(isset($_POST['id_bolida']) && !empty($_POST['id_bolida'])){
	
	$id_bolida = intval($_POST['id_bolida']);
}else{
	$id_bolida = null;
}
echo addVozac($ime,$prezime,$id_bolida);
}
?>