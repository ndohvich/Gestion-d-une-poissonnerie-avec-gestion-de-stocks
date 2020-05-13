<?php
	session_start();
	include_once('../elt_employés/connection.php');

	if(isset($_POST['add'])){
		$avatar = $_POST['avatar'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$mdp = $_POST['mdp'];
		$sql = "INSERT INTO employes(nom_employe, adress_employe, tel, avatar, mdp) VALUES ('$firstname', '$lastname', '$address', '$avatar', '$mdp')";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employé ajouté avec succès';
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

	header('location: ../employes.php?id='.$_SESSION['id']);
?>