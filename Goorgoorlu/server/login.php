<?php
 /* *******
  **  
  *******/

 include 'Controler.php';
    
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


    
  function signup($username , $pword, $type, $prenom,$nom,$numTel, $localisation)
    {
      global $connexion;


         // $result = getAllUsers();
 
         // $exists = false;
         // $return = false;

         // while ($row = $result->fetch_assoc())
         //  {
         //      $uname = $row['username'];
         //      $pass = $row['password'];

         //      if ($uname == $username && $pass == $pword)
         //       {
         //             $exists =  true;  
         //             break; 
         //       }
        
         //  }

         // if (!$exists)
         //  {
            


             $q = "INSERT INTO goorgoorlukat(username,password,type,prenom,nom,numTel,localisation) 
                   values ('$username' , '$pword', $type ,'$prenom' ,'$nom',$numTel, '$localisation')";
   

 
          mysqli_query($connexion, $q);

          //      {
          //       $return = true;
          //      }

          // }

          // return $return;

    }




///////////////// MAIN  ////////////////////////////

   $action = $_POST['action'];

   $username = $_POST['username'];
   $pword = $_POST['pword'];
   $numTel = $_POST['num'];
   $prenom = $_POST['sname'];
   $nom = $_POST['name'];
   $type = $_POST['type'];
   $localisation = $_POST['addr'];





 
   if ($action == "signin")
    {
   
      $data = login($username,$pword);
       
       echo json_encode($data);




       
    }

   if ($action == "signup")
    {
   
        signup($username, $pword, $type,$prenom,$nom,$numTel,$localisation);
       
               // $q = "INSERT INTO job(libelle) values ('$username')";
              
               // $res = $connexion->query($q);
    }

////////////////////////////////////////////////////




?>