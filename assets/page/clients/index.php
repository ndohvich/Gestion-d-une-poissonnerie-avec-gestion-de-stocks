<?php

session_start();

$connect = mysqli_connect("localhost", "root", "", "poissonnerie");
$nom = $_SESSION['nom_employe'];
$nom1 = 'jules';

if(isset($_POST['cmd'])){

	if(!empty($_SESSION["shopping_cart"]))
	{
		$total = 0;
		$total_quantite = 0;
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			$total_quantite = $total_quantite + ($values['item_quantity'] + $values['item_quantity']);
			$total_quantite_bon = (($total_quantite)/2);
			$total = $total + ($values["item_quantity"] * $values["item_price"]);
			$_SESSION['success'] = "La Commande a bien été enregistré";
		}
		$query1 = "INSERT INTO `commandes`(`id`, `total_quantite`, `total_prix`, `nom`, `heure_date_commande`) VALUES (NULL, $total_quantite_bon, $total, '', NOW())";
		$result = mysqli_query($connect, $query1);
	}
}

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Ajouter le même produit ?")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Enlever cet article")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Vendeur <?php echo $_SESSION['nom_employe'] ?></title>
		<script src="jquery.js"></script>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script src="bootstrap.min.js"></script>
	</head>
	<body>

	<div id="body">

		<header style="position:relative;top:0px;height:40px;width:100%;background-color:black;">

			<ul style="float:right;display:inline-block;text-decoration:none;color:white;">
				<li style="float:left;display:inline-block;text-decoration:none;color:white;padding:10px 10px;font-weight:bold;">Salut <?php echo $_SESSION['nom_employe'] ?></li>
				<li style="float:left;display:inline-block;text-decoration:none;color:#0099FF;padding:10px 10px;font-weight:bold;"><a href="deconnexion.php" style="color:#0099FF;text-decoration:none;color:white;">Déconnexion</a></li>
			</ul>

		</header>

		<br />

		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="row">
				<?php
					if(isset($_SESSION['error'])){
						echo
						"
						<div class='alert alert-danger text-center'>
							<button class='close'>&times;</button>
							".$_SESSION['error']."
						</div>
						";
						unset($_SESSION['error']);
					}
					if(isset($_SESSION['success'])){
						echo
						"
						<div class='alert alert-success text-center'>
							<button class='close'>&times;</button>
							".$_SESSION['success']."
						</div>
						";
						unset($_SESSION['success']);
					}
				?>
				</div>
			</div>
		</div>

		<div class="container">
			<br /><br />
			<?php
				$query = "SELECT * FROM produits ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-3">
				<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="margin-bottom:20px;border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">

						<h4 class="text-info"><?php echo $row["nom_produits"]; ?></h4>

						<h4 class="text-danger"><?php echo $row["prix"]; ?> FCFA/Kg</h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["nom_produits"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["prix"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Ajouter" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<h3>Détails du panier</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr style="text-align:center;">
						<th width="40%" style="text-align:center;">Nom du produit</th>
						<th width="10%" style="text-align:center;">Quantité</th>
						<th width="20%" style="text-align:center;">Prix</th>
						<th width="15%" style="text-align:center;">Total</th>
						<th width="5%" style="text-align:center;">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr id="del" for="del" name="del">
						<td style="text-align:center;"><?php echo $values["item_name"]; ?></td>
						<td style="text-align:center;"><?php echo $values["item_quantity"]; ?></td>
						<td style="text-align:center;">FCFA <?php echo $values["item_price"]; ?></td>
						<td style="text-align:center;">FCFA <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td style="text-align:center;"><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Supprimer</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right" style="text-align:center;">Total</td>
						<td align="right" style="text-align:center;">FCFA <?php echo number_format($total, 2); ?></td>
						<td style="text-align:center;">
							<form method="post">
								<button type="submit" for="cmd" id="cmd" name="cmd" value="Enregistrer la commande" class="btn btn-danger active">Enregistrer la commande</button>
							</form>
						</td>
					</tr>
					<?php
					}
					?>

				</table>
			</div>
		</div>
	</div>
	<br />
</div>
	<script>
		setInterval('recharge()', 20000);
		function recharge(){
			$('#body').load('index.php');
		}
	</script>
	</body>
</html>

<?php

?>
