<?php


// ---------------------- import des classes metiers ---------------------------
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Salle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/User.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/MachineSalle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Machine.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Incident.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Etat.class.php");

// ---------------------- import des DA0 ---------------------------
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOSalle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOUser.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOMachineSalle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOMachine.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOIncident.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOEtat.class.php");


class Controller {
		
	public function redirect($url) {
		header('Location: '.$url);
	}
}