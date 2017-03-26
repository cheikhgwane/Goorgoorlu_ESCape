<?php
include 'controler.php' ;


		function getnotif($id){
		 global $connexion;
		$data=array();

		$q  = 'select * from notif where id_sender='.$id;

		$result = mysqli_query($connexion,$q);


    while ($row = $result->fetch_assoc()) {
			$id = $row['id'];
			$id_sender=$row['id_sender'];
			$id_receiver=$row['id_receiver'];
			$type=$row['type'];
			$id_job=$row['id_job'];
			$date=$row['date'];
			$data[]=$row;
 	}

         
				echo json_encode($data);

	}



?>