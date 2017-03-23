<?php

$connexion= mysqli_connect("localhost","root","","Goorgoorlu");

function authen($user,$pword){
    global $connexion ;

    $user = mysqli_real_escape_string($connexion,$user);
  
    $result = mysqli_fetch_assoc(mysqli_query($connexion,"select username,password from Admin where admin.username='$user'"));

     if (password_verify($pword,$result['password'])){
       echo "Acces granted";

     }else{
       echo "Acces denied";
     }
   
}

/*
  *******
  ** Usage of password_hash function for generating the password 
  **  using the BCRYPT hash constant https://fr.wikipedia.org/wiki/Bcrypt
  *******
*/

function createAdmin($log,$mdp){

global $connexion ;

$log = mysqli_real_escape_string($connexion,$log);

$mdp = password_hash($mdp,PASSWORD_BCRYPT);

$mdp = mysqli_real_escape_string($connexion,$mdp);
   
$result = mysqli_fetch_assoc(mysqli_query($connexion,"select *from admin where username='$log'"));
var_dump($result['username']);

 if(mysqli_query($connexion,"select *from admin where username='$log'")){
    echo "username already exit";
 }
 else {
   if(mysqli_query($connexion,"insert into Admin(username,password) values ('$log','$mdp')")){
     echo " Admin created";
   }else{
     echo "Error";
   }
 }

  
}

 if(isset($_POST['login']) && isset($_POST['pwd'])){
   createAdmin($_POST['login'],$_POST['pwd']);
 }

 if(isset($_POST['log']) && isset($_POST['pword'])){
  authen($_POST['log'],$_POST['pword']);
 }


 
?>
