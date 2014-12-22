<?php
session_start();

// ---------------------- import des controleurs ---------------------------
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/controllers/CtlAuthentification.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/controllers/CtlUsers.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/controllers/CtlSalles.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/controllers/CtlEtats.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/controllers/CtlMachines.class.php");
//--------------------------------------------------------------------------

$action = $_GET['action'];
$data = $_REQUEST;
//PARSE DE L'ACTION A EFFECTUER

$route = explode('/',$action);
$routefonction = explode('?', $route[1]);

$controlleur = $route[0]; //route[0] correspond au nom du controleur
$fonction = $routefonction[0]; //route[1] correspond au nom de la fonction à executer
 
if(isset($_SESSION['connexion']) || ($controlleur == "CtlAuthentification" && $fonction == "connexion")) {
	$controlleur::getInstance()->$fonction($data);
} else {
	header("location: ../utils/errorPage.html");
}
