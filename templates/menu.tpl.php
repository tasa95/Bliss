<?php
if(empty($_SESSION) || (session_id() == "")){
	$connexion = false;
}
else
{
	if($_SESSION["connexion"] == false)
	{
		$connexion = $_SESSION["connexion"];
		$error_login = true;
	}
	else
	{
		$connexion = true;
	}
}

$menu = "";
if(isset($_GET['menu']))
	$menu = $_GET['menu'];

?>
<div id="menu" class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">

			<!-- ------------ENTETE--------------- -->
			<a class="brand"
				href="<?php $_SERVER['DOCUMENT_ROOT']?>/Bliss/index.php"><font
				color="white"><b>BLISS</b> </font> </a>

			<!-- --------------BOUTONS DE NAVIGATION-------------- -->
			<div class="nav-collapse collapse navbar-inverse-collapse">
				<ul class="nav">

					<!-- USERS -->
					<?php if($menu == "users") {?>
					<li class="active"><?php } else {?>
					
					<li><?php }?><a
						href="<?php $_SERVER['DOCUMENT_ROOT']?>/Bliss/views/users.php?menu=users">Administrateurs</a>
					</li>

					<!-- GESTION DES SALLES -->
					<?php if($menu == "salles") {?>
					<li class="active"><?php } else {?>
					
					<li><?php }?> <a
						href="<?php $_SERVER['DOCUMENT_ROOT']?>/Bliss/views/salles.php?menu=salles">Supervision
							du Parc</a>
					</li>

					<!-- GESTION DES MACHINES -->
					<?php if($menu == "machines") {?>
					<li class="active"><?php } else {?>
					
					<li><?php }?><a
						href="<?php $_SERVER['DOCUMENT_ROOT']?>/Bliss/views/machines.php?menu=machines">Gestion
							des machines</a>
					</li>

					<!-- GESTION DES INCIDENTS -->
					<?php if($menu == "incidents") {?>
					<li class="active"><?php } else {?>
					
					<li><?php }?> <a
						href="<?php $_SERVER['DOCUMENT_ROOT']?>/Bliss/views/incidents.php?menu=incidents">Résolution
							d'incidents</a>
					</li>

					<!-- GESTION DES ETATS -->
					<?php if($menu == "etats") {?>
					<li class="active"><?php } else {?>
					
					<li><?php }?> <a
						href="<?php $_SERVER['DOCUMENT_ROOT']?>/Bliss/views/etats.php?menu=etats">Visualisation
							des états</a>
					</li>

				</ul>
			</div>

			<!-- --------------FIN BOUTONS DE NAVIGATION----------------- -->


			<?php if($connexion == false){ ?>

			<form style="margin-bottom: 0px !important"
				class="navbar-form pull-right" method="POST"
				action="<?php echo $routes;?>CtlAuthentification/connexion&url=<?php echo $_SERVER['SCRIPT_NAME'];?>">

				<input type="text" class="inputLogin" name="login"
					placeholder="identifiant" /> <input type="password"
					class="inputLogin" name="mdp" placeholder="Mot de passe" />

				<button type="submit" class="btn">
					<i class="icon-ok"></i>
				</button>
			</form>

			<?php if(isset($_GET['errorConnect']) && $_GET['errorConnect'] == 1) {?>
			<span style="margin-right: 10px; line-height: 40px"
				class="pull-right"><font color="red">ERREUR !</font> </span>
			<?php }?>
			
			<?php } else{ ?>

			<a
				href="<?php $_SERVER['DOCUMENT_ROOT']?>/Bliss/templates/deconnexion.php?url=<?php echo $_SERVER['SCRIPT_NAME'];?>">
				<button style="margin-top: 7px !important; padding-top:6px; margin-top:6px!important; padding-bottom:6px" type="button"
					class="btn btn-danger pull-right">
					<i class="icon-off icon-white"></i>
				</button>
			</a> <span style="height:20px" class="btn pull-right"><?php echo $_SESSION['prenom']." ".$_SESSION['nom'] ?>
			</span>
			<?php } ?>

		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div id="interface">

			<div id="datatable">
				<div id="datatableContainer">