<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: X-XSRF-TOKEN");
include("config.php");
if(isset($_POST['ime_staze']) && isset($_POST['grad'])&& isset($_POST['drzava']))
{
$ime_staze = $_POST['ime_staze'];
$grad = $_POST['grad'];
$drzava = $_POST['drzava'];

$stmt = $conn->prepare("INSERT INTO staza (ime_staze, grad, drzava) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $ime_staze, $grad, $drzava);
$stmt->execute();
echo "ok";
}
?>