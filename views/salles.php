<?php
include("../templates/header.tpl.php");
include("../templates/menu.tpl.php");


if(isset($_GET['valide'])) {
	$valide = $_GET['valide'];
}
if(isset($_GET['id_salle']))
	$id_salle = $_GET['id_salle'];
?>
<h1>Supervision du parc informatique</h1>

<div class="row-fluid">
	<a href="salles.php?menu=salles&id_salle=-1" class="adminAccess"> <input
		style="margin-bottom: 30px" class="btn" type="button"
		value="Créer une salle" />
	</a>

</div>
<?php if(isset($id_salle)) {
	if($id_salle != -1)
		$currentSalle = DAOSalle::getInstance()->find($id_salle);
	?>
<form class="form-inline well offset3 span6"
	action="<?php echo $routes?>CtlSalles/createUpdateSalle" method="post">

	<legend style="text-align: center">
		<?php
		if($id_salle == -1)
			echo "Ajouter une salle";
		else
			echo "Modifier une salle - ".($currentSalle->getNom_salle());
		?>

		<?php 
		if(isset($valide) && $valide == "false") {?>
		<br /> <font color="#ff0000">Erreur de saisie !</font>
		<?php }?>
	</legend>

	<p>
		Requis<font color="#ff0000">*</font>
	</p>
	<input type="hidden" id="id" name="id"
		value="<?php if(isset($currentSalle)) echo $currentSalle->getId_salle(); else echo "-1";?>" />
	<div class="row-fluid">
		<div style="text-align: center">
			<div class="control-group" id="ControlNom">
				<label class="control-label for="nom">Nom : <font color="#ff0000">*</font>
				</label>
				<div class="controls">
					<input type="text" id="nom" name="nom"
						placeholder="Saisir le nom..."
						value="<?php if(isset($currentSalle)) echo ($currentSalle->getNom_salle());?>" />
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div style="text-align: center">
			<br /> <a href="salles.php?menu=salles">
				<button class="btn">Annuler</button>
			</a>
			<button style="margin-left: 20px;" class="btn btn-primary"
				type="submit">Valider</button>
		</div>
	</div>

</form>

<?php }?>


<?php $tableSalle = DAOSalle::getInstance()->findAll();?>
<table class="tablePerso display">
	<thead>
		<!-- En-tête du tableau -->
		<tr>
			<th>Nom</th>
			<th class="adminAccess">Action</th>
		</tr>
	</thead>
	<tbody>
		<!-- Corps du tableau -->
		<?php
		foreach ($tableSalle as $salle) {
		?>
		<tr>
			<td><?php echo ($salle->getNom_salle());?></td>
			<td class="adminAccess"><a
				title="Editer les machines pour cette salle"
				href="machines.php?menu=machines&id_salle=<?php echo $salle->getId_salle()?>">
					<button class="btn">
						<i class="icon-edit"></i>
					</button>
			</a> <a title="Modifier la salle"
				href="salles.php?menu=salles&id_salle=<?php echo $salle->getId_salle();?>">
					<button class="btn">
						<i class="icon-pencil"></i>
					</button>
			</a> <a title="Supprimer la salle"
				href="<?php echo $routes;?>CtlSalles/deleteSalle&id_salle=<?php echo $salle->getId_salle();?>">
					<button class="btn">
						<i class="icon-remove"></i>
					</button>
			</a>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>

<?php 

include("../templates/footer.tpl.php");
?>

<script
	type="text/javascript" src="js/salles.js"></script>
