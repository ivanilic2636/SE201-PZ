<?php
include("config.php");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
die();
}
function checkIfLoggedIn(){
global $conn;
if(isset($_SERVER['HTTP_TOKEN'])){
$token = $_SERVER['HTTP_TOKEN'];
$result = $conn->prepare("SELECT * FROM users WHERE token=?");
$result->bind_param("s",$token);
$result->execute();
$result->store_result();
$num_rows = $result->num_rows;
if($num_rows > 0)
{
	return true;
}
	else{
	return false;
}
}
	else{
return false;
}
}









			
			function login($username, $password){
			global $conn;
			$rarray = array();
			if(checkLogin($username,$password)){
			$id = sha1(uniqid());
			$result2 = $conn->prepare("UPDATE users SET token=? WHERE username=?");
			$result2->bind_param("ss",$id,$username);
			$result2->execute();
			$rarray['token'] = $id;
			} else{
			header('HTTP/1.1 401 Unauthorized');
			$rarray['error'] = "Invalid username/password";
}
return json_encode($rarray);
}




function checkLogin($username, $password){
global $conn;
$password = md5($password);
$result = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$result->bind_param("ss",$username,$password);
$result->execute();
$result->store_result();
$num_rows = $result->num_rows;
if($num_rows > 0)
{
return true;
}
else{
return false;
}
}



		











		function register($username, $password, $firstname, $lastname){
global $conn;
$rarray = array();
$errors = "";
if(checkIfUserExists($username)){
$errors .= "Username already exists\r\n";
}
if(strlen($username) < 3){
$errors .= "Username must have at least 3 characters\r\n";
}
if(strlen($password) < 3){
$errors .= "Password must have at least 3 characters\r\n";
}
if(strlen($firstname) < 3){
$errors .= "First name must have at least 3 characters\r\n";
}
if(strlen($lastname) < 3){
$errors .= "Last name must have at least 3 characters\r\n";
}
if($errors == ""){
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password) VALUES (?, ?, ?, ?)");
$pass =md5($password);
$stmt->bind_param("ssss", $firstname, $lastname, $username, $pass);
if($stmt->execute()){
$id = sha1(uniqid());
$result2 = $conn->prepare("UPDATE users SET token=? WHERE username=?");
$result2->bind_param("ss",$id,$username);
$result2->execute();
$rarray['token'] = $id;
}else{
header('HTTP/1.1 400 Bad request');
$rarray['error'] = "Database connection error";
}
} else{
	header('HTTP/1.1 400 Bad request');
$rarray['error'] = json_encode($errors);
}
return json_encode($rarray);
}



function checkIfUserExists($username){
global $conn;
$result = $conn->prepare("SELECT * FROM users WHERE username=?");
$result->bind_param("s",$username);
$result->execute();
$result->store_result();
$num_rows = $result->num_rows;
if($num_rows > 0)
{
return true;
}
else{
return false;
}
}






function addVozac($ime, $prezime, $id_b){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$stmt = $conn->prepare("INSERT INTO vozac (ime, prezime, id_b) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $ime, $prezime, $id_b);
if($stmt->execute()){
$rarray['success'] = "ok";
}else{
$rarray['error'] = "Database connection error";
}
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
}
return json_encode($rarray);
}


function getVozaci(){
	global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->query("SELECT vozac.id, ime, prezime, (SELECT ime_bolida FROM bolid WHERE id_bolida = vozac.id_b) as bolid FROM vozac");

$num_rows = $result->num_rows;

$vozaci = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT vozac.id, ime, prezime, (SELECT ime_bolida FROM bolid WHERE id_bolida = vozac.id_b) as bolid FROM vozac");
while($row = $result2->fetch_assoc()) {
$jedan_vozac = array();
$jedan_vozac['id'] = $row['id'];
$jedan_vozac['ime'] = $row['ime'];
$jedan_vozac['prezime'] = $row['prezime'];
$jedan_vozac['bolid'] = $row['bolid'];
array_push($vozaci,$jedan_vozac);
}
}
$rarray['vozaci'] = $vozaci;
return json_encode($rarray);
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
return json_encode($rarray);
}
}





function editVozac($id,$ime,$prezime){
    global $conn;
    $rarray = array();
    if(checkIfLoggedIn()){
        $stmt = $conn->prepare("UPDATE vozac SET ime=?, prezime=? WHERE id=?");
        $stmt->bind_param("ssi", $ime, $prezime, $id);
        if($stmt->execute()){
            $rarray['success'] = "ok";
        }else{
            $rarray['error'] = "Database connection error";
        }
    } else{
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($rarray);
}









function getVozac($id){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->query("SELECT * FROM vozac WHERE id=".$id);
$num_rows = $result->num_rows;
$vozaci = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT * FROM vozac WHERE id=".$id);
while($row = $result2->fetch_assoc()) {
$jedan_vozac = array();
$jedan_vozac['id'] = $row['id'];
$jedan_vozac['ime'] = $row['ime'];
$jedan_vozac['prezime'] = $row['prezime'];

$vozaci = $jedan_vozac;
}
}
$rarray['data'] = $vozaci;
return json_encode($rarray);
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
return json_encode($rarray);
}
}



function deleteVozac($id){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->prepare("DELETE FROM vozac WHERE id=?");
$result->bind_param("i",$id);
$result->execute();
$rarray['success'] = "Deleted successfully";
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
}
return json_encode($rarray);
}


function addBolid($ime_bolida){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$stmt = $conn->prepare("INSERT INTO bolid (ime_bolida) VALUES(?)");
		$stmt->bind_param("s",$ime_bolida);
		if($stmt->execute()){
			$rarray['success'] = "ok";
			
		}else{
			$rarray['error'] = "Database connection error";
		}
	}else{
			$rarray['error'] = "Please log in";
			header('HTTP/1.1 401 Unauthorized');
		}
		return json_encode($rarray);
		
	}

function getBolid(){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->query("SELECT * FROM bolid");
$num_rows = $result->num_rows;
$bolid = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT * FROM bolid");
while($row = $result2->fetch_assoc()) {
$jedan_bolid = array();
$jedan_bolid['id_bolida'] = $row['id_bolida'];
$jedan_bolid['ime_bolida'] = $row['ime_bolida'];
array_push($bolid,$jedan_bolid);
}
}
$rarray['bolid'] = $bolid;
return json_encode($rarray);
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
return json_encode($rarray);
}
}





function deleteStaza($id){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->prepare("DELETE FROM staza WHERE id=?");
$result->bind_param("i",$id);
$result->execute();
$rarray['success'] = "Deleted successfully";
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
}
return json_encode($rarray);
}










function addStaza($ime_staze, $grad, $drzava){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$stmt = $conn->prepare("INSERT INTO staza (ime_staze, grad, drzava) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $ime_staze, $grad, $drzava);
if($stmt->execute()){
$rarray['success'] = "ok";
}else{
$rarray['error'] = "Database connection error";
}
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
}
return json_encode($rarray);
}






function getStaze(){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->query("SELECT * FROM staza");
$num_rows = $result->num_rows;
$staze = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT * FROM staza");
while($row = $result2->fetch_assoc()) {
$jedna_staza = array();
$jedna_staza['id'] = $row['id'];
$jedna_staza['ime_staze'] = $row['ime_staze'];
$jedna_staza['grad'] = $row['grad'];
$jedna_staza['drzava'] = $row['drzava'];
array_push($staze,$jedna_staza);
}
}
$rarray['staze'] = $staze;
return json_encode($rarray);
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
return json_encode($rarray);
}
}




function deleteBolid($id_bolida){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->prepare("DELETE FROM bolid WHERE id_bolida=?");
$result->bind_param("i",$id_bolida);
$result->execute();
$rarray['success'] = "Deleted successfully";
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
}
return json_encode($rarray);
}









