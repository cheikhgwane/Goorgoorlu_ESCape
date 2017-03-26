<?php
include 'controler.php' ;


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

		// echo "Array ::::".$row;
         
				echo json_encode($data);

	}

	Displayskills(1);


?>