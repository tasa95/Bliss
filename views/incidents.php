<?php
include("../templates/header.tpl.php");
include("../templates/menu.tpl.php");
?>


<?php 
if(isset($_GET['valide'])) {
	$valide = $_GET['valide'];
}
if(isset($_GET['id_incident']))
	$id_incident = $_GET['id_incident'];

if(isset($_REQUEST['id_machine']) && $_REQUEST['id_machine'] != -1) {
	$id_machine = $_REQUEST['id_machine'];
	$tableIncident = DAOIncident::getInstance()->findAllByMachine($id_machine);
}else{
	$tableIncident = DAOIncident::getInstance()->findAll();
}
?>

<h1>Résolution d'incidents</h1>

<?php 

?>


<!-- Menu déroulant pour afficher les incidents pour une seule machine -->

<div class="row-fluid" style="text-align: center;">

	<?php $tableMachine = DAOMachine::getInstance()->findAll();?>

	<form method="post" action="incidents.php?menu=incidents">

		<label for="id_machine">Machine :</label> <select
			style="width: 205px; margin-bottom: 0px" id="id_machine"
			name="id_machine">

			<option value=-1>-- Sélectionner --</option>
			<?php foreach($tableMachine as $machine) {
					
				if($id_machine == $machine->getId_machine()) {
			?>
			<option selected value=<?php echo $machine->getId_machine()?>>
				<?php } else { ?>
			
			<option value=<?php echo $machine->getId_machine()?>>
				<?php }
				echo ($machine->getNom_machine())?>

			</option>
			<?php }?>
		</select>

		<button style="margin-left: 15px;" class="btn btn-primary"
			type="submit">Trier</button>

	</form>

</div>

<hr />

<?php 
if(isset($id_incident)) {
$incident = DAOIncident::getInstance()->find($id_incident);
?>

<div class="well">
	<legend style="text-align: center">
		Ticket
		<?php echo $incident->getId_incident()?>
	</legend>
	<div class="row-fluid">
		<div class="offset1 span5">

			<p>
				<b>Numéro du ticket :</b>
				<?php echo $incident->getId_incident()?>
			</p>

			<p>
				<b>Date de création du ticket :</b>
				<?php echo 'Le '.date('d/m/Y', $incident->getDate_ouverture()).' &agrave; '.date('H:i:s', $incident->getDate_ouverture());?>
			</p>

			<p>
				<b>Machine :</b>
				<?php echo (DAOMachine::getInstance()->find($incident->getId_machine())->getNom_machine())?>
			</p>

		</div>

		<div class="offset1 span5">

			<p>
				<b>Etat :</b>
				<?php echo (DAOEtat::getInstance()->find($incident->getId_etat())->getDescription())?>
			</p>

			<p>
				<b>Valeur :</b>
				<?php echo $incident->getValeur();?>
				% restants
			</p>

			<p>
				<b>Date de résolution :</b>
				<?php 
				if($incident->getDate_cloture() == null)
					echo "-- En cours de résolution --";
				else
					echo 'Le '.date('d/m/Y', $incident->getDate_cloture()).' &agrave; '.date('H:i:s', $incident->getDate_cloture());
				?>
			</p>

		</div>
	</div>
</div>
<hr />
<?php }?>

<table class="tablePerso display">
	<thead>
		<!-- En-tête du tableau -->
		<tr>
			<th width="33%">Création</th>
			<th>Machine</th>
			<th>Etat</th>
			<th class="adminAccess">Détails</th>
		</tr>
	</thead>
	<tbody>
		<!-- Corps du tableau -->
		<?php
		foreach ($tableIncident as $incident) {
		?>
		<tr>
			<td><?php echo 'Le '.date('d/m/Y', $incident->getDate_ouverture()).' &agrave; '.date('H:i:s', $incident->getDate_ouverture());?>
			</td>
			<td><?php echo DAOMachine::getInstance()->find($incident->getId_machine())->getNom_machine()?>
			</td>

			<td><?php
			if($incident->getDate_cloture() == null) {
				?><img src="../assets/img/error.png" /> <?php
			}else {
				?><img src="../assets/img/valide.png" /> <?php
			}
			?>
			</td>

			<td class="adminAccess"><a
				id="<?php echo $incident->getId_incident()?>" class="visuModal"
				title="Afficher le détail de l'incident"
				href="incidents.php?menu=incidents&id_incident=<?php echo $incident->getId_incident()?>">
					<button class="btn">
						<i class="icon-eye-open"></i>
					</button>

			</a> <!-- +++++++++++++++++++ Modal +++++++++++++++++++++ -->
				<div id="modal<?php echo $incident->getId_incident()?>"
					class="modal hide fade" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">×</button>
						<h3 id="myModalLabel">
							Ticket
							<?php echo $incident->getId_incident()?>
						</h3>
					</div>
					<div class="modal-body">
						<div class="row-fluid">
							<div class="offset1 span5">

								<p>
									<b>Numéro du ticket :</b>
									<?php echo $incident->getId_incident()?>
								</p>

								<p>
									<b>Date de création du ticket :</b>
									<?php echo 'Le '.date('d/m/Y', $incident->getDate_ouverture()).' &agrave; '.date('H:i:s', $incident->getDate_ouverture());?>
								</p>

								<p>
									<b>Machine :</b>
									<?php echo (DAOMachine::getInstance()->find($incident->getId_machine())->getNom_machine())?>
								</p>

							</div>

							<div class="offset1 span5">

								<p>
									<b>Etat :</b>
									<?php echo (DAOEtat::getInstance()->find($incident->getId_etat())->getDescription())?>
								</p>

								<p>
									<b>Valeur :</b>
									<?php echo $incident->getValeur();?>
									% restants
								</p>

								<p>
									<b>Date de résolution :</b>
									<?php 
									if($incident->getDate_cloture() == null)
										echo "-- En cours de résolution --";
									else
										echo 'Le '.date('d/m/Y', $incident->getDate_cloture()).' &agrave; '.date('H:i:s', $incident->getDate_cloture());
									?>
								</p>

							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
					</div>
				</div> <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->
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
	type="text/javascript" src="js/incidents.js"></script>
