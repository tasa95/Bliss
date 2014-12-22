<?php
include("../templates/header.tpl.php");
include("../templates/menu.tpl.php");
?>


<?php 
if(isset($_GET['valide'])) {
	$valide = $_GET['valide'];
}
if(isset($_GET['id_etat']))
	$id_etat = $_GET['id_etat'];
?>
<h1>Visualisation des états</h1>

<?php 
$tableEtat = DAOEtat::getInstance()->findAll();
?>
<table class="tablePerso display">
	<thead>
		<!-- En-tête du tableau -->
		<tr>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<!-- Corps du tableau -->
		<?php
		foreach ($tableEtat as $etat) {
		?>
		<tr>
			<td><?php echo ($etat->getDescription())?></td>
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
	type="text/javascript" src="js/etats.js"></script>
