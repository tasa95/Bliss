<?php
include("../templates/header.tpl.php");
include("../templates/menu.tpl.php");
?>


<?php 
if(isset($_GET['valide'])) {
	$valide = $_GET['valide'];
}
if(isset($_GET['id_machine']))
	$id_machine = $_GET['id_machine'];

if(isset($_REQUEST['id_salle']))
	$id_salle = $_REQUEST['id_salle'];
?>

<h1>Gestion des machines</h1>

<!-- Menu déroulant pour afficher les machines pour une seule salle -->

<div class="row-fluid" style="text-align: center;">

	<?php $tableSalle = DAOSalle::getInstance()->findAll();?>

	<form method="post" action="machines.php?menu=salles">

		<label for="id_salle">Salle :</label> <select
			style="width: 205px; margin-bottom: 0px" id="id_salle"
			name="id_salle">

			<option value=-1>-- Sélectionner --</option>
			<?php foreach($tableSalle as $salle) {
					
				if($id_salle == $salle->getId_salle()) {
			?>
			<option selected value=<?php echo $salle->getId_salle()?>>
				<?php } else { ?>
			
			<option value=<?php echo $salle->getId_salle()?>>
				<?php }
				echo ($salle->getNom_salle())?>

			</option>
			<?php }?>
		</select>

		<button style="margin-left: 15px;" class="btn btn-primary"
			type="submit">Trier</button>

	</form>

</div>

<hr />


<div class="row-fluid">

	<a
		href="machines.php?menu=machines&id_machine=-1<?php if(isset($id_salle)) echo "&id_salle=".$id_salle?>"
		class="adminAccess"> <input style="margin-bottom: 30px" class="btn"
		type="button" value="Créer une Machine" />
	</a>
</div>

<?php if(isset($id_machine)) {
	if($id_machine != -1)
		$currentMachine = DAOMachine::getInstance()->find($id_machine);
	?>
<form class="form-inline well offset1 span10"
	action="<?php echo $routes?>CtlMachines/createUpdateMachine"
	method="post">

	<legend style="text-align: center">
		<?php
		if($id_machine == -1)
			echo "Ajouter une machine";
		else
			echo "Modifier une machine";
		?>

		<?php 
		if(isset($valide) && $valide == "false") {?>
		<br /> <font color="#ff0000">Erreur de saisie !</font>
		<?php }?>
	</legend>

	<p style="text-align: left">
		Requis<font color="#ff0000">*</font>
	</p>

	<input type="hidden" id="id" name="id"
		value="<?php if(isset($currentMachine)) echo $currentMachine->getId_machine(); else echo "-1";?>" />

	<?php if(isset($id_salle)) {?>
	<input type="hidden" id="currentSalle" name="currentSalle"
		value="<?php echo $id_salle?>" />
	<?php }?>
	<div class="row-fluid">

		<div class="offset1 span5">
			<div class="control-group" id="ControlNom">
				<label class="control-label for="nom">Nom machine : <font
					color="#ff0000">*</font>
				</label>
				<div class="controls">
					<input type="text" id="nom" name="nom"
						placeholder="Saisir le nom..."
						value="<?php if(isset($currentMachine)) echo ($currentMachine->getNom_machine())?>" />
				</div>

			</div>

			<?php $tableSalle = DAOSalle::getInstance()->findAll();?>
			<label for="salle">Salle d'affectation :</label> <select
				style="width: 205px" id="salle" name="salle">
				<option value=-1>-- Sélectionner la salle --</option>
				<option value=-1>Pas d'affectation</option>
				<?php foreach($tableSalle as $salle) {
					$machineSalle = DAOMachineSalle::getInstance()->findByMachine($id_machine);
					if($machineSalle->getId_salle() == $salle->getId_salle()) { ?>
				<option selected value=<?php echo $salle->getId_salle()?>>
					<?php echo $salle->getNom_salle()?>
				</option>
				<?php } else { ?>
				<option value=<?php echo $salle->getId_salle()?>>
					<?php echo $salle->getNom_salle()?>
				</option>
				<?php }?>
				<?php }?>
			</select>
		</div>

		<div class="offset1 span5">
			<div class="control-group" id="ControlIp">
				<label class="control-label" for="ip">IP machine : <font
					color="#ff0000">*</font>
				</label>
				<div class="controls">
					<input type="text" id="ip" name="ip" placeholder="Saisir l'ip..."
						value="<?php if(isset($currentMachine)) echo $currentMachine->getIp_machine()?>" />
				</div>

			</div>
		</div>

	</div>

	<div class="row-fluid">
		<div style="text-align: center">
			<br /> <a href="machines.php?menu=machines">
				<button class="btn">Annuler</button>
			</a>
			<button style="margin-left: 20px;" class="btn btn-primary"
				type="submit">Valider</button>
		</div>
	</div>

</form>

<?php }?>


<?php 
if(!isset($id_salle))
	$tableMachine = DAOMachine::getInstance()->findAll();
else
	$tableMachine = DAOMachine::getInstance()->findAllBySalle($id_salle);
?>
<table class="tablePerso display">
	<thead>
		<!-- En-tête du tableau -->
		<tr>
			<th>Nom Machine</th>
			<th>IP Machine</th>
			<?php if(!isset($id_salle)) {?>
			<th>Salle</th>
			<?php }?>
			<th>Etat</th>
			<th class="adminAccess">Actions</th>
		</tr>
	</thead>
	<tbody>
		<!-- Corps du tableau -->
		<?php
		foreach ($tableMachine as $machine) {
		?>
		<tr>
			<td><?php echo ($machine->getNom_machine())?></td>
			<td><?php echo ($machine->getIp_machine())?></td>
			<?php if(!isset($id_salle)) {?>
			<td><?php 
			try {
					$machineSalle = DAOMachineSalle::getInstance()->findByMachine($machine->getId_machine());
				}catch(Exception $e) {
					$machineSalle = null;
				}

				if($machineSalle->getId_machineSalle() != null) {
					$salle = DAOSalle::getInstance()->find($machineSalle->getId_salle());
					echo ($salle->getNom_salle());
				} else {
					echo "-- LIBRE --";
				}
				?>
			</td>
			<?php }?>

			<td><?php 
			try {
				$incident = DAOIncident::getInstance()->findCurrentByMachine($machine->getId_machine());
			} catch(Exception $e) {
				$incident = null;
			}

			if($incident->getId_incident() != null) {
				?><img src="../assets/img/error.png" /> <?php
			}else {
				?><img src="../assets/img/valide.png" /> <?php
			}

			?></td>

			<td class="adminAccess"><a
				title="Afficher la liste des incidents pour cette machine"
				href="incidents.php?menu=incidents&id_machine=<?php echo $machine->getId_machine();?>">
					<button class="btn">
						<i class="icon-th-list"></i>
					</button>
			</a> <a title="Modifier la machine"
				href="machines.php?menu=machines&id_machine=<?php echo $machine->getId_machine();?>">
					<button class="btn">
						<i class="icon-pencil"></i>
					</button>
			</a> <a title="supprimer la machine"
				href="<?php echo $routes?>CtlMachines/deleteMachine&id_machine=<?php echo $machine->getId_machine();?>">
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
	type="text/javascript" src="js/machines.js"></script>
