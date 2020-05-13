<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$sql = "UPDATE clients SET nom_clients = '$firstname', adress_clients = '$lastname', tel = '$address' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Client modifié avec succès';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member updated successfully';
		// }
		///////////////
		
		else{
			$_SESSION['error'] = 'Erreur lors de la mise à jour';
		}
	}
	else{
		$_SESSION['error'] = 'Selectionner le membre avant SVP';
	}

	header('location: ../clients.php?id='.$_SESSION['id']);

?>