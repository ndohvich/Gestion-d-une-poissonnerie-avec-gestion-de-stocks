<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=poissonnerie','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['con'])){

	if(!empty($_POST['nom']) AND !empty($_POST['mdp'])){

		$nom = htmlspecialchars($_POST['nom']);
		$mdp = $_POST['mdp'];

		$nom_long = strlen($nom);

		if($nom_long < 20){

			$requser = $bdd->prepare("SELECT * FROM personnel WHERE nom = ? AND mdp = ?");
			$requser->execute(array($nom,$mdp));
			$userexist = $requser->rowCount();

			if($userexist == 1){

				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['nom'] = $userinfo['nom'];
				$_SESSION['mdp'] = $userinfo['mdp'];
				if(($_SESSION['nom'] == "admin") && ($_SESSION['mdp'] == "admin")){

					header('Location: assets/page/Administration/index.php?id='.$_SESSION['id']);

				}
				else{

					header('Location: index.php');
				}
			}
			else{

				$requser1 = $bdd->prepare("SELECT * FROM employes WHERE nom_employe = ? AND mdp = ?");
				$requser1->execute(array($nom,$mdp));
				$userexist1 = $requser1->rowCount();

				if($userexist1 == 1){
					$userinfo = $requser1->fetch();
					$_SESSION['id'] = $userinfo['id'];
					$_SESSION['nom_employe'] = $userinfo['nom_employe'];
					$_SESSION['mdp'] = $userinfo['mdp'];
					header('Location: assets/page/clients/index.php?id='.$_SESSION['id']);
				}
			}

		}else{

			$erreur = "Votre Nom est trop long";

		}

	}else{

    if(isset($_POST['con']) AND (empty($_POST['nom']) AND  empty($_POST['mdp']))){

		$erreur = "Vous devez tout remplir";

    }
	if(isset($_POST['con']) AND (empty($_POST['mdp']))){

		$erreur = "Vous devez remplir votre mot de passe";

	}
	if(isset($_POST['con']) AND (empty($_POST['nom']))){

		$erreur = "Vous devez remplir votre nom";

	}
  }
}

?>

<!DOCTYPE html>
<html style="font-family:'sans-serif';">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La poissonnerie</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abhaya+Libre">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>

    <div class="reponse" style="width:25%;margin:0px auto;text-align:center">
	    <?php
		    if(isset($erreur)){
	    ?>
		    <div class="alert alert-danger alert-dismissable fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <?php echo $erreur; ?>
		    </div>
		    <?php
		        }
	    	?>
    </div>

    <form method="post" class="box">
        <h1>LOGIN</h1>
        <input class="form-control" type="text" id="nom" name="nom" for="nom" required="" placeholder="Votre Nom" autofocus="" autocomplete="on">
        <input class="form-control" type="password" id="mdp" name="mdp" for="mdp" required="" placeholder="Votre Mot de Passe" autocomplete="on">
        <button class="btn btn-primary active btn-sm" id="con" name="con" for="con" type="submit" data-bs-hover-animate="bounce">Connexion</button>
    </form>
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>