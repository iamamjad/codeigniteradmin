<?php 

//$conn = mysqli_connect("mysql", "root", ".root.", "docker_db");
//// Check connection
//if ($conn->connect_error) {
//	die("Connection failed: " . $conn->connect_error);
//}
//
//$sql = "SELECT * FROM appusers";
//
//$result = $conn->query($sql);
//
//
//if ($result->num_rows > 0) {
//	// output data of each row
//	while($row = $result->fetch_assoc()) {
//        echo $row['idAppUser'].'<br>';
//        echo $row['email'].'<br>';
//	}
//}
//else {
//	echo "0 results";
//}
//$conn->close();


require_once('voicerss_tts.php');

$tts = new VoiceRSS;
$voice = $tts->speech([
	'key' => '880a8b345b0f40639e65bb7fdf16d94e',
	'hl' => 'en-us',
	'src' => 'Hello, world!',
	'r' => '0',
	'c' => 'mp3',
	'f' => '44khz_16bit_stereo',
	'ssml' => 'false',
	'b64' => 'false'
]);

print_r($voice);

?>
