<?php
	session_start();
	include_once('../elt_fournisseurs/connection.php');

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$sql = "INSERT INTO fournisseurs(nom_fournisseur, adress_fournisseur, tel) VALUES ('$firstname', '$lastname', '$address')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Fournisseur ajouté avec succès';
		}
		///////////////

		//use for MySQLi Procedural
		// if(mysqli_query($conn, $sql)){
		// 	$_SESSION['success'] = 'Member added successfully';
		// }
		//////////////
		
		else{
			$_SESSION['error'] = 'Erreur';
		}
	}
	else{
		$_SESSION['error'] = 'Erreur lors de la saisie';
	}

	header('location: ../Fournisseur.php?id='.$_SESSION['id']);
?>