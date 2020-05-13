<?php
	session_start();
	include_once('../elt_produits/connection.php');

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$sql = "INSERT INTO produits(nom_produits, categorie, prix) VALUES ('$firstname', '$lastname', '$address')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Produit ajouté avec succès';
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

	header('location: ../produits.php?id='.$_SESSION['id']);
?>