<?php
include("../templates/header.tpl.php");
include("../templates/menu.tpl.php");
?>


<?php 
if(isset($_GET['valide'])) {
	$valide = $_GET['valide'];
}
if(isset($_GET['id_user']))
	$id_user = $_GET['id_user'];
?>
<h1>Administrateurs</h1>

<div class="row-fluid">
	<a href="users.php?menu=users&id_user=-1" class="adminAccess"> <input
		style="margin-bottom: 30px" class="btn" type="button"
		value="Créer un Utilisateur" />
	</a>
</div>

<?php if(isset($id_user)) {
	if($id_user != -1)
		$currentUser = DAOUser::getInstance()->find($id_user);
	?>
<form class="form-inline well offset1 span10"
	action="<?php echo $routes?>CtlUsers/createUpdateUser" method="post">

	<legend style="text-align: center">
		<?php
		if($id_user == -1)
			echo "Ajouter un utilisateur";
		else
			echo "Modifier un utilisateur - ". ($currentUser->getPrenom()." ".$currentUser->getNom());
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
		value="<?php if(isset($currentUser)) echo $currentUser->getId_user(); else echo "-1";?>" />

	<div class="row-fluid">
		<div class="offset1 span5">

			<div class="control-group" id="ControlNom">
				<label class="control-label" for="nom">Nom : <font color="#ff0000">*</font>
				</label>
				<div class="controls">
					<input type="text" id="nom" name="nom"
						placeholder="Saisir le nom..."
						value="<?php if(isset($currentUser)) echo ($currentUser->getNom())?>" />
				</div>

			</div>

			<div class="control-group" id="ControlPrenom">
				<label class="control-label" for="prenom">Prénom : <font
					color="#ff0000">*</font>
				</label>
				<div class="controls">
					<input type="text" id="prenom" name="prenom"
						placeholder="Saisir le prénom..."
						value="<?php if(isset($currentUser)) echo ($currentUser->getPrenom())?>" />
				</div>
			</div>

		</div>

		<div class="offset1 span5">

			<div class="control-group" id="ControlLogin">
				<label class="control-label" for="login">Identifiant : <font
					color="#ff0000">*</font>
				</label>
				<div class="controls">
					<input type="text" id="login" name="login"
						placeholder="Saisir le login..."
						value="<?php if(isset($currentUser)) echo ($currentUser->getLogin())?>" />
				</div>
			</div>

			<div class="control-group" id="ControlPassword">
				<label class="control-label" for="password">Mot de passe : <font
					color="#ff0000">*</font> <span style="font-size: 10px">(6
						caractères min)</span>
				</label>
				<div class="controls">
					<input type="password" id="password" name="password"
						placeholder="Saisir le mot de passe..." />
				</div>
			</div>

		</div>
	</div>

	<div class="row-fluid">
		<div style="text-align: center">
			<br /> <a href="users.php?menu=users">
				<button class="btn">Annuler</button>
			</a>
			<button style="margin-left: 20px;" class="btn btn-primary"
				type="submit">Valider</button>
		</div>
	</div>

</form>

<?php }?>


<?php 
$tableUser = DAOUser::getInstance()->findAll();
?>
<table class="tablePerso display">
	<thead>
		<!-- En-tête du tableau -->
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Login</th>
			<th class="adminAccess">Actions</th>
		</tr>
	</thead>
	<tbody>
		<!-- Corps du tableau -->
		<?php
		foreach ($tableUser as $user) {
		?>
		<tr>
			<td><?php echo $user->getNom()?></td>
			<td><?php echo $user->getPrenom()?></td>
			<td><?php echo $user->getLogin()?></td>
			<td class="adminAccess"><a title="Modifier l'administrateur"
				href="users.php?menu=users&id_user=<?php echo $user->getId_user();?>">
					<button class="btn">
						<i class="icon-pencil"></i>
					</button>
			</a> <a title="Supprimer l'administrateur"
				href="<?php echo $routes?>CtlUsers/deleteUser&id_user=<?php echo $user->getId_user();?>">
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

<script type="text/javascript" src="js/users.js"></script>
