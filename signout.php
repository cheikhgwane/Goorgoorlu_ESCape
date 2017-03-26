
<?php
session_start();
	function signout(){ 
$_SESSION = array();
session_destroy();
header("Location: connexion.php");
?>
}