<?php
ob_start();
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/controllers/CtlAuthentification.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/User.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOUser.class.php");

$user = CtlAuthentification::getInstance()->getUser($_POST["login"],$_POST["mdp"]);

if(!empty($user))
{
	session_start();
	$_SESSION["nom"] = $user->getNom();
	$_SESSION["prenom"] = $user->getPrenom();
	$_SESSION["id"] = $user->getId_user();
	$_SESSION["connexion"] = true;
	header('Location: '.$_GET["url"],true);
}
else
{
	if(session_id() == "")
		session_start();
	$_SESSION["connexion"] = false ;
	header('Location: '.$_GET["url"],true);
}

?>