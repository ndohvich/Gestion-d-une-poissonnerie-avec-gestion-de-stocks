<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$sql = "UPDATE fournisseurs SET nom_fournisseur = '$firstname', adress_fournisseur = '$lastname', tel = '$address' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Elèment modifié avec succès';
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

	header('location: ../Fournisseur.php?id='.$_SESSION['id']);

?>