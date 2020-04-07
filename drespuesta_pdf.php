<?php
if(isset($_POST["resp_docu"])){
	$resp_docu = $_POST["resp_docu"];
}else{
	$resp_docu = "";
}

$dir = "C:/xampp/htdocs/prueba_performance/archivos/";

if(!unlink($dir.$resp_docu.".pdf")) {
	echo false;
}

?>
