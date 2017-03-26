<?php
include('config.php');
?>
	   
<?php
		function Signup ($username,$password,$passverif,$email)
//On verifie que le formulaire a ete envoye
if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $and $_POST['username']!='')
{
	//On enleve lechappement si get_magic_quotes_gpc est active
	if(get_magic_quotes_gpc())
	{
		$_POST['username'] = stripslashes($_POST['username']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['email'] = stripslashes($_POST['email']);

	}
	//On verifie si le mot de passe et celui de la verification sont identiques
	if($_POST['password']==$_POST['passverif'])
	{
		//On verifie si le mot de passe a 6 caracteres ou plus
		if(strlen($_POST['password'])>=6)
		{
			//On verifie si lemail est valide
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			{
				//On echape les variables pour pouvoir les mettre dans une requette SQL
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string($_POST['password']);
				$email = mysql_real_escape_string($_POST['email']);
				$avatar = mysql_real_escape_string($_POST['avatar']);
				//On verifie sil ny a pas deja un prestataire inscrit avec le pseudo choisis
				$res= mysql_num_rows(mysql_query('select id from prestataire where username="'.$username.'"'));
				if($res==0)
				{
					//On recupere le nombre de prestataires pour donner un identifiant a lutilisateur actuel
					$res2 = mysql_num_rows(mysql_query('select id from prestataire'));
					$id = $dres2+1;
					//On enregistre les informations dans la base de donnee
					if(mysql_query('insert into prestataire(id, username, password, email, signup_date) values ('.$id.', "'.$username.'", "'.$password.'", "'.$email.'","'.time().'")'))
					{
						//Si ca a fonctionne, on naffiche pas le formulaire
						$form = false;
?>
<a href="connexion.php">Se connecter</a></div>
<?php
					}
					else
					{
						//Sinon on dit quil y a eu une erreur
						$form = true;
						$message = 'Une erreur est survenue lors de l\'inscription.';
					}
				}
				else
				{
					//Sinon, on dit que le pseudo voulu est deja pris
					$form = true;
					$message = 'erreur';
				}
			}
			else
			{
				//Sinon, on dit que lemail nest pas valide
				$form = true;
				$message = 'L\'email que vous avez entré n\'est pas valide.';
			}
		}
		else
		{
			//Sinon, on dit que le mot de passe nest pas assez long
			$form = true;
			$message = 'Le mot de passe que vous avez entré contient moins de 6 caractère.';
		}
	}
	else
	{
		//Sinon, on dit que les mots de passes ne sont pas identiques
		$form = true;
		$message = 'Les mots de passe que vous avez entrés; ne sont pas identiques.';
	}
}
else
{
	$form = true;
}

	}
	//On affiche le formulaire
?>

		