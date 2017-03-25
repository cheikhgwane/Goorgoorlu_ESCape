<?php
 /* *******
  ** Usage of password_hash function for generating the password 
  **  using the BCRYPT hash constant https://fr.wikipedia.org/wiki/Bcrypt
  *******/
$connexion= mysqli_connect("localhost","root","","Goorgoorlu");
function searchPrest($item){
  
  global $connexion;
  $item = mysqli_real_escape_string($connexion,$item);
  $a = mysqli_query($connexion,"select username,password from prestataire where prestataire.username='$item'");
   
   if($a!=false){
     $a=mysqli_fetch_assoc($a);
     $pass = $a['password'];
     return  $pass;
   }else {
     return false;
   }
}


function getAllUsers(){
  
  global $connexion;
  
  $result = mysqli_query($connexion,"select * from Goorgoorlukat ");
   
  return $result;
}

function inJob(){
  
  global $connexion;
  
  $result = mysqli_query($connexion,"insert into job(libelle) ");
   
  return $result;
}


function searchUser($item){
  
  global $connexion;
  $item = mysqli_real_escape_string($connexion,$item);
  $a = mysqli_query($connexion,"select username,password from client where client.mail='$item'");
   
   if($a!=false){
     $a=mysqli_fetch_assoc($a);
     $pass = $a['password'];
     return  $pass;
   }else {
     return false;
   }
}
function authen($user,$pword){
    
    global $connexion ;
     
    $user = mysqli_real_escape_string($connexion,$user);
  
     if(searchUser($user)!=false){
        $pwd=searchUser($user);
      if(password_verify($pword,$pwd)){
        
          echo "Acces granted";
       }else{
          echo "Acces denied";
        }
     }elseif(searchPrest($user)!=false){
         $pwd=searchPrest($user);
         echo password_verify($pword,$pwd);
        if(password_verify($pword,$pwd)){
             echo "Acces granted";
       }else{
            echo "Acces denied";
        }
     }
   
    /* if(mysqli_query($connexion,"select username,password from client where Client.mail='$user'")){
       echo "Existed";
     }else {
       echo "Don't existed";
     }*/
}
function authenClient($user,$pword){ 
    global $connexion ;
    $user = mysqli_real_escape_string($connexion,$user);
    $type = mysqli_real_escape_string($connexion,$type);
   
    
     if(password_verify($pword,$result['password'])){
       echo "Acces granted";
     }else{
       echo "Acces denied";
     }
   
}
function authenAdmin($user,$pword){ 
    global $connexion ;
    $user = mysqli_real_escape_string($connexion,$user);
    $type = mysqli_real_escape_string($connexion,$type);
    
     if(password_verify($pword,$result['password'])){
       echo "Acces granted";
     }else{
       echo "Acces denied";
     }
   
}
function createAdmin($log,$mdp){
 global $connexion ;
 $log = mysqli_real_escape_string($connexion,$log);
 $mdp = password_hash($mdp,PASSWORD_BCRYPT);
 $mdp = mysqli_real_escape_string($connexion,$mdp);
 $type = mysqli_real_escape_string($connexion,$type);
   if(mysqli_query($connexion,"insert into Admin(username,password) values ('$log','$mdp')")){
     echo " Admin created";
   }else{
     echo "Error";
   }
  
}
function createUser($type,$mail,$name,$username,$password){
    global $connexion;
    $password = password_hash($password,PASSWORD_BCRYPT);
    $password = mysqli_real_escape_string($connexion,$password);
    $type = mysqli_real_escape_string($connexion,$type);
    $mail = mysqli_real_escape_string($connexion,$mail);
    $name = mysqli_real_escape_string($connexion,$name);
    $username = mysqli_real_escape_string($connexion,$username);
      if(strtolower($type)=='utilisateur'){
        if(mysqli_query($connexion,"insert into Client(nom,mail,password) values ('$name','$mail','$password')")){
                echo "$type created";
            }else{
                echo "Error";
            }
      }else{
          if(mysqli_query($connexion,"insert into Prestataire(nom,password,username) values ('$name','$password','$username')")){
                echo "$type created";
            }else{
                echo "ici";
                echo "Error";
            }
      }
}
 if(isset($_POST['login']) && isset($_POST['pwd'])){
   createAdmin($_POST['login'],$_POST['pwd']);
 }
 if(isset($_POST['username']) && isset($_POST['pword'])){
    authen($_POST['username'],$_POST['pword']);
 }
if(isset($_POST['profil']) && isset($_POST['mail']) && isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['pword'])){
  createUser($_POST['profil'],$_POST['mail'],$_POST['fullname'],$_POST['username'],$_POST['pword']); 
}
//ajouter a chacune des ces fonctions un header pour rediriger les utilisateurs
?>