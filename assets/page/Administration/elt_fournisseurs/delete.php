<?php
	session_start();
	include_once('connection.php');

	if(isset($_GET['id'])){
		$sql = "DELETE FROM fournisseurs WHERE id = '".$_GET['id']."'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Fournisseur supprimer avec succès';
		}
		////////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member deleted successfully';
		// }
		/////////////////
		
		else{
			$_SESSION['error'] = 'Erreur lors de la suppression';
		}
	}
	else{
		$_SESSION['error'] = 'Erreur';
	}

	header('location: ../Fournisseur.php?id='.$_SESSION['id']);
?>