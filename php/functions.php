<?php
include("config.php");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
die();
}
function checkIfLoggedIn(){
global $conn;
if(isset($_SERVER['HTTP_TOKEN'])){
$token = $_SERVER['HTTP_TOKEN'];
$result = $conn->prepare("SELECT * FROM user WHERE token=?");
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
			$result2 = $conn->prepare("UPDATE user SET token=? WHERE user_username=?");
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
$result = $conn->prepare("SELECT * FROM user WHERE user_username=? AND user_password=?");
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
$stmt = $conn->prepare("INSERT INTO user (user_firstname, user_lastname, user_username, user_password) VALUES (?, ?, ?, ?)");
$pass =md5($password);
$stmt->bind_param("ssss", $firstname, $lastname, $username, $pass);
if($stmt->execute()){
$id = sha1(uniqid());
$result2 = $conn->prepare("UPDATE user SET token=? WHERE user_username=?");
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
$result = $conn->prepare("SELECT * FROM user WHERE user_username=?");
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







function addBand($band_name){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$stmt = $conn->prepare("INSERT INTO band (band_name) VALUES(?)");
		$stmt->bind_param("s",$band_name);
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

function getBand(){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
		
$result = $conn->query("SELECT * FROM band");
$num_rows = $result->num_rows;
$band = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT * FROM band");
while($row = $result2->fetch_assoc()) {
$one_band = array();
$one_band['band_id'] = $row['band_id'];
$one_band['band_name'] = $row['band_name'];
array_push($band,$one_band);
}
}
$rarray['band'] = $band;
return json_encode($rarray);


}else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
return json_encode($rarray);
}

}


function addGenere($genere_name){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$stmt = $conn->prepare("INSERT INTO genere (genere_name) VALUES(?)");
		$stmt->bind_param("s",$genere_name);
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
	
	
function getGenere(){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->query("SELECT * FROM genere");
$num_rows = $result->num_rows;
$genere = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT * FROM genere");
while($row = $result2->fetch_assoc()) {
$one_genere = array();
$one_genere['genere_id'] = $row['genere_id'];
$one_genere['genere_name'] = $row['genere_name'];
array_push($genere,$one_genere);
}
}
$rarray['genere'] = $genere;
return json_encode($rarray);

} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
return json_encode($rarray);
}
}


function addSong($song_name,$song_runtime,$song_link,$band_id,$genere_id){
global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$stmt = $conn->prepare("INSERT INTO song (song_name, song_runtime, song_link,id_b,id_g) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $song_name,$song_runtime,$song_link,$band_id,$genere_id);
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



function getSongs(){
	global $conn;
$rarray = array();
if(checkIfLoggedIn()){
$result = $conn->query("SELECT song_id,song_name, song_runtime,song_link, (SELECT band_name FROM band WHERE band_id = song.id_b) as band , (SELECT genere_name FROM genere WHERE genere_id = song.id_g) AS genere FROM song");

$num_rows = $result->num_rows;

$songs = array();
if($num_rows > 0)
{
$result2 = $conn->query("SELECT song_id,song_name, song_runtime,song_link, (SELECT band_name FROM band WHERE band_id = song.id_b) as band , (SELECT genere_name FROM genere WHERE genere_id = song.id_g) AS genere FROM song");
while($row = $result2->fetch_assoc()) {
$one_song = array();
$one_song['song_id'] = $row['song_id'];
$one_song['song_name'] = $row['song_name'];
$one_song['song_runtime'] = $row['song_runtime'];
$one_song['song_link'] = "https://www.youtube.com/embed/".substr($row['song_link'], strpos($row['song_link'], "=")+1);
$one_song['band'] = $row['band'];
$one_song['genere'] = $row['genere'];
array_push($songs,$one_song);
}
}
$rarray['songs'] = $songs;
return json_encode($rarray);
} else{
$rarray['error'] = "Please log in";
header('HTTP/1.1 401 Unauthorized');
return json_encode($rarray);
}
}


function addMySongs($user_id,$song_id){
	global $conn;
    $rarray = array();
    if(checkIfLoggedIn()){
		$result = $conn->prepare("SELECT user_id,song_id FROM my_music WHERE user_id=? AND song_id=? LIMIT 1");
			$result->bind_param("ii", $user_id, $song_id);
			$result->execute();
			$result->store_result();
			$num_rows = $result->num_rows;
			 while($num_rows > 0)
        {

            $rarray['error'] = "Already have that song";
        }
   
           
                $stmt = $conn->prepare("INSERT INTO my_music (user_id,song_id) VALUES (?,?)");
                $stmt->bind_param("ii", $user_id, $song_id);
			
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


function getUserID($user_username){
    global $conn;
    $rarray = array();
    if(checkIfLoggedIn()){
        $result = $conn->query("SELECT user_id FROM user WHERE user_username LIKE '".$user_username. "'");
        while($row = $result->fetch_assoc()) {

                $song = array();
                $song = $row['user_id'];
                $song = $song;

        }

        $rarray['data2'] = $song;
        return json_encode($rarray);
    } else{
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
        return json_encode($rarray);
    }
}


function getOneSong($song_id){
    global $conn;
    $rarray = array();
    if(checkIfLoggedIn()){
        $result = $conn->query("SELECT * FROM song WHERE song_id=".$song_id);
        $songs = array();


            while($row = $result->fetch_assoc()) {
                $songs = array();
                $one_song['song_id'] = $row['song_id'];
				$one_song['song_name'] = $row['song_name'];
				$one_song['song_runtime'] = $row['song_runtime'];
				$one_song['song_link'] = "https://www.youtube.com/embed/".substr($row['song_link'], strpos($row['song_link'], "=")+1);
				$one_song['id_b'] = $row['id_b'];
				$one_song['id_g'] = $row['id_g'];
                $songs = $one_song;
            }

        $rarray['data'] = $songs;
        return json_encode($rarray);
    } else{
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
        return json_encode($rarray);
    }
}


function getMySongs($user_id)
{
    global $conn;
    $rarray = array();
    $result = $conn->query("SELECT * FROM my_music");
    $num_rows = $result->num_rows;
    $songs = array();
    if($num_rows > 0)
    {
        $result2 = $conn->query("SELECT * FROM my_music");
        while($row = $result2->fetch_assoc()){
            $song = array();
        }
        $result3 = $conn->query("SELECT song.song_id,song.song_name,song.song_runtime,song.song_link,(SELECT band_name FROM band WHERE band_id = song.id_b) as band , (SELECT genere_name FROM genere WHERE genere_id = song.id_g) AS genere FROM song JOIN my_music ON my_music.song_id= song.song_id WHERE user_id=".$user_id) or
        die($conn->error);
                while($row = $result3->fetch_assoc()){
                    $one_song = array();
					$one_song['song_id'] = $row['song_id'];
					$one_song['song_name'] = $row['song_name'];
					$one_song['song_runtime'] = $row['song_runtime'];
					$one_song['song_link'] = "https://www.youtube.com/embed/".substr($row['song_link'], strpos($row['song_link'], "=")+1);
					$one_song['band'] = $row['band'];
					$one_song['genere'] = $row['genere'];
					array_push($songs,$one_song);
                    
                }
    }
    $rarray['data'] = $songs;
    return json_encode($rarray);
}


function deleteSong($song_id){
	global $conn;
	$rarray = array();
	if(checkIfLoggedIn()){
		$result = $conn->prepare("DELETE FROM my_music WHERE song_id=?");
		$result->bind_param("i",$song_id);
		$result->execute();
		$rarray['success'] = "Deleted successfully";
	} else{
		$rarray['error'] = "Please log in";
		header('HTTP/1.1 401 Unauthorized');
	}
return json_encode($rarray);
}











