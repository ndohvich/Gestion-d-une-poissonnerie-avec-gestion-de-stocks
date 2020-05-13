<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$mdp = $_POST['mdp'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$sql = "UPDATE employes SET nom_employe = '$firstname', adress_employe = '$lastname', tel = '$address' , mdp = '$mdp' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employé modifié avec succès';
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

	header('location: ../employes.php?id='.$_SESSION['id']);

?>