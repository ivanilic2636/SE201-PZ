<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: X-XSRF-TOKEN");
include("config.php");
if(isset($_POST['ime']) && isset($_POST['prezime'])&& isset($_POST['bolid']))
{
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$bolid = $_POST['bolid'];

$stmt = $conn->prepare("INSERT INTO vozac (ime, prezime, bolid) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $ime, $prezime, $bolid);
$stmt->execute();
echo "ok";
}
?>