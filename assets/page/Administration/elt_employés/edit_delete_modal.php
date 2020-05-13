<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edité un Employé</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="elt_employés/edit.php">
				<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Nom :</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="firstname" value="<?php echo $row['nom_employe']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Passe :</label>
					</div>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="mdp" value="<?php echo $row['mdp']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">adresse :</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="lastname" value="<?php echo $row['adress_employe']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Téléphone: </label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="address" value="<?php echo $row['tel']; ?>">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label modal-label">kg vendu:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="kilo_vendu" value="<?php echo $row['kilo_vendu']; ?>" disabled>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label modal-label">Total FCFA:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="argent" value="<?php echo $row['argent']; ?>" disabled>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label modal-label">Total Heure:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="heure_taff" value="<?php echo $row['heure_taff']; ?>" disabled>
					</div>
				</div>
            </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Revenir</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Mettre à jour</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Supprimer un Employé</h4></center>
            </div>
            <div class="modal-body">
            	<p class="text-center">Voulez-vous vraiment supprimer ???</p>
				<h2 class="text-center"><?php echo $row['nom_employe'].' + '.$row['adress_employe']; ?></h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Non</button>
                <a href="elt_employés/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Oui</a>
            </div>

        </div>
    </div>
</div>
