<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Ajouter un produit</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="elt_produits/add.php">
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label modal-label">Nom :</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="firstname" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label modal-label">Catégorie :</label>
					</div>
					<div class="col-sm-8">
						<select class="form-control" name="lastname" required>
							<option>Poissonnerie</option>
							<option>Crustacés</option>
							<option>Poulets</option>
							<option>Porcs</option>
							<option>Dindes</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label modal-label">Prix du Kg:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="address" required>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Revenir</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Enregistrer</a>
			</form>
            </div>

        </div>
    </div>
</div>