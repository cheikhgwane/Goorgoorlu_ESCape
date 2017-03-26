<?php
include 'controler.php';


		function displaycontents($id){
		global $connexion;

		$content= array();
		$data= array();
		$q = 'select *  from  gcontent where id_Gg='.$id;
		$result= mysqli_query($connexion,$q);
	

		while ($row = $result->fetch_assoc()) {
			
			$content[]=$row['Content'];

			$idjob=$row['id_job'];
		
           $q2  = 'select libelle from job where id='.$idjob;
           $result2 = mysqli_query($connexion,$q2);
           $row2 = $result2->fetch_assoc();
           $content[]= $row2['libelle'];
           
           $data[]=$content;
		}

			echo json_encode($data);
		}

			displaycontents(1);

?>