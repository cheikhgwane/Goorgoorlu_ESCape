<?php 
//mettre ici le code pour les sessions et cookies
//afin de reconnaitre luser
$connexion = mysqli_connect("localhost","root","","goorgoorlu");

  function getData($id){

      global $connexion;

      $id=mysqli_real_escape_string($connexion,$id);

      $result= mysqli_fetch_assoc(mysqli_query($connexion,"select localisation from goorgoorlukat where id='$id'"));   

      

      $localisation=mysqli_real_escape_string($connexion,$result['localisation']);

      $query = mysqli_fetch_assoc(mysqli_query($connexion,"select username,prenom,localisation,libelle from goorgoorlukat,job,Gjob where goorgoorlukat.id=Gjob.id_Gg and Gjob.id_job=job.id and Goorgoorlukat.localisation='$localisation'"));

      return $query;
  }

  function resetPassword($newpword,$id){
      global $connexion;

       $newpword = password_hash($newpword,PASSWORD_BCRYPT);

       $newpword = mysqli_real_escape_string($connexion,$newpword);

       $result=mysqli_query($connexion,"update goorgoorlukat set password='$newpword' where goorgoorlukat.id='$id'");     
       header("location:../View/main_view.html");
  }


  function addContent($id){
       global $connexion;

       $filename=$_FILES['file']['name'];

       if(copy($_FILES['file']['tmp_name'],"../Uploaded_Files/".$filename)){
           header("location:../View/main_view.html");
       }
    
       $filename=mysqli_real_escape_string($connexion,$filename);

       mysqli_query($connexion,"insert into Gcontent(id_Gg,id_job,path)values('1','1','$filename')");
  }

  function renderMedia($id){

      global $connexion;

      $id =mysqli_real_escape_string($connexion,$id);

      $result=mysqli_fetch_assoc(mysqli_query($connexion,"select path from Gcontent where id_Gg='$id'"));

      $img = "../Uploaded_Files/".$result['path'];

      var_dump($img);

      return $img;

      
  }



  if(isset($_POST['data'])){
    $var = getData("1");
    echo json_encode($var);
    }
 
    if(isset($_POST['oldpword']) && isset($_POST['newpword']) && isset($_POST['newpwordtwo'])){
        resetPassword($_POST['newpword'],1);
    }

    if(isset($_FILES['file'])){
        addContent(0);
    }

    if(isset($_POST['contentReq'])){
        $x=renderMedia(1);
        echo json_encode(['reponse'=>"cheikh"]);
    }
   
   
    
  
?>