<?php
include('config.php');
?>

<?php
//Si l'utilisateur est connecté, on le deconnecte en supprimant les session, sinon, on affiche un formulaire, si la combinaison est bonne, la session pseudo est créée et il sera connecté.
	function Connexion($id,$username,$password)
//Si lutilisateur est connecte, on le deconecte
if(isset($_SESSION['username']))
{
	//On le deconnecte en supprimant simplement les sessions username et id
	unset($_SESSION['username'], $_SESSION['id']);
?>
<div class="message">Vous avez bien été déconnecté .<br />
<?php
}
else
{
	$username = '';
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['username'], $_POST['password']))
	{
		//On echappe les variables pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			
			$username = mysql_real_escape_string(stripslashes($_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysql_real_escape_string($_POST['username']);
			$password = $_POST['password'];
		}
		//On recupere le mot de passe du prestataire
		$req = mysql_query('select password,id from prestataire where username="'.$username.'"');
		$res = mysql_fetch_assoc($req);
		//On le compare a celui quil a entre et on verifie si le membre existe
		if($res['password']==$password and mysql_num_rows($req)>0)
		{
			//Si le mot de passe est bon, on ne va pas afficher le formulaire
			$form = false;
			//On enregistre son pseudo dans la session username et son identifiant dans la session rid
			$_SESSION['username'] = $res['username'];
			$_SESSION['id'] = $res['id'];
?>

<?php
		}
		else
		{
			//Sinon, on indique que la combinaison nest pas bonne
			$form = true;
			$message = 'La combinaison que vous avez entré; n\'est pas bonne.';
		}
	}
	else
	{
		$form = true;
	}
	
	//On affiche le formulaire
?>