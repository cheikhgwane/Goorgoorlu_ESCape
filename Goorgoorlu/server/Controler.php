<?php
 /* *******
  ** Usage of password_hash function for generating the password 
  **  using the BCRYPT hash constant https://fr.wikipedia.org/wiki/Bcrypt
  *******/
$connexion= mysqli_connect("localhost","root","","Goorgoorlu");

 


function getAllUsers(){
  
  global $connexion;
  
  $result = mysqli_query($connexion,"select * from Goorgoorlukat ");
   
  return $result;
}



function addJob($libelle){
  
  global $connexion;
  
  $result = mysqli_query($connexion,"SELECT libelle FROM job");

  $inList = false;

   while ($row = $result->fetch_assoc())
    {
       if ($row['libelle'] === $libelle) 
       {
         $inList = true;
         break;
       }
    }
  
  if (!$inList)
   {
    
     $result2 = mysqli_query($connexion,"insert into job(libelle) values('$libelle') ");
     
     return $result2;

   
   }


}
 
 
///////////////////////////////////////////////////////////////

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
 

/////////////////////////////////////////////////////////////////////

 function login($username, $pword)
    {
      global $connexion;

         $result = getAllUsers();

         $connected = -1;

               $q = "INSERT INTO job(libelle) values ('Yeemiin')";
              
               $res = mysqli_query($connexion, $q);


         while ($row = $result->fetch_assoc())
          {
              $uname = $row['username'];
              $pass = $row['password'];

              if ($uname == $username && $pass == $pword)
               {

                      $connected = $row['id'];  
                     
                       break;
                       session_start();
                       $_SESSION['loggedId'] = $connected;
               }
        
          }

          return $connected;

    }

////////////////////////////////////////////////////////////////////////////////////
    
  function signup($username , $pword, $type, $prenom,$nom,$numTel, $localisation)
    {
      global $connexion;

        //Si le user n'exist pas deja 
         $result = getAllUsers();
 
         $exists = false;
         $return = false;

         while ($row = $result->fetch_assoc())
          {
              $uname = $row['username'];
              $pass = $row['password'];

              if ($uname == $username && $pass == $pword)
               {
                     $exists =  true;  
                     break; 
               }
        
          }

         if (!$exists)
          {
            


             $q = "INSERT INTO goorgoorlukat(username,password,type,prenom,nom,numTel,localisation) 
                   values ('$username' , '$pword', $type ,'$prenom' ,'$nom',$numTel, '$localisation')";
   

 
          mysqli_query($connexion, $q);

               {
                $return = true;
               }

          }

          return $return;

    }


/////////////////////////////////////////////////////////

function Displayskills($id){
    global $connexion;

    $data=array();
    $q  = 'select * from Gjob where id_Gg='.$id;
    $result = mysqli_query($connexion,$q);
    // $row = $result->fetch_assoc();
    while ($row = $result->fetch_assoc()) {
      $idjob=$row['id_job'];
 ;
    }
         
        echo json_encode($data);
  }

/////////////////////////////////////////////////////////////

function getGname($id) //Tested
{
     global $connexion;

     $q = "SELECT prenom, nom FROM goorgoorlukat WHERE id=".$id;
     $result = mysqli_query($connexion, $q);
     $row = $result->fetch_assoc();

     $fullName = $row['prenom']." ".$row['nom'];

     return $fullName;

}


function getGloc($id) //Tested
{
     global $connexion;

     $q = "SELECT localisation FROM goorgoorlukat WHERE id=".$id;
     $result = mysqli_query($connexion, $q);
     $row = $result->fetch_assoc();

     $loc = $row['localisation'];

     return $loc;

}

function getGnum($id) //Tested
{
     global $connexion;

     $q = "SELECT numTel FROM goorgoorlukat WHERE id=".$id;
     $result = mysqli_query($connexion, $q);
     $row = $result->fetch_assoc();

     $num = $row['numTel'];

     return $num;

}

function getJobname($id) //Tested
{
     global $connexion;

     $q = "SELECT libelle FROM job WHERE id=".$id;
     $result = mysqli_query($connexion, $q);
     $row = $result->fetch_assoc();

     $jobName = $row['libelle'];

     return $jobName;

}

////////////////////////////////////////////////////////////

 function DisplayNotifs($GetNotifArray)
  {
     global $connexion;
      
     $finalArray = array();

     foreach ($GetNotifArray as $key => $value)
      {
        
           $finalArray[] = $value;

           $idReceiver = $value['id_receiver'];
           $idSender = $value['id_sender'];
           $idJob = $value['job_id'];


           $nameReceiver = getGname($idReceiver);
           $nameSender = getGname($idSender);

           $nameJob = getJobname($idjob);

           $locReceiver = getGloc($idReceiver);
           $locSender = getGloc($idSender);

           $numReceiver = getGnum($idReceiver);
           $numSender = getGnum($idSender);


           $finalArray['nameReceiver'] = $nameReceiver;
           $finalArray['nameSender'] = $nameSender;
           $finalArray['nameJob'] = $nameJob;
           $finalArray['locReceiver'] = $locReceiver;
           $finalArray['locSender'] = $locSender;
           $finalArray['numReceiver'] = $numReceiver;
           $finalArray['numSender'] = $numSender;


           

                 

      }
     

     return $finalArray;
     echo $finalArray;

  }
 

 
 


?>