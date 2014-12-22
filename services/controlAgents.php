<?php
#dd_free
#ram_free
#ip
#time

if(isset($_REQUEST['ip']) && isset($_REQUEST['time']) && (isset($_REQUEST['dd_free']) || isset($_REQUEST['ram_free']))) {

	//récupération des informations de l'agent
	$ram_disk = "disk";
	
	$ip = $_REQUEST['ip'];
	$time = $_REQUEST['time'];
	
	if(isset($_REQUEST['dd_free'])) {
		$dd_free = $_REQUEST['dd_free'];
	}
	else if(isset($_REQUEST['ram_free'])) {
		$ram_free = $_REQUEST['ram_free'];
		$ram_disk = "ram";
	}
	
	$id_etat = DAOEtat::getInstance()->findByAlias($ram_disk)->getId_etat();
	$id_machine = DAOMachine::getInstance()->findByIp($ip)->getId_machine();
	
	$data = array();
	
	$data['id_etat'] = $id_etat;
	$data['id_machine'] = $id_machine;
	$data['date_ouverture'] = $time;
	$data['valeur'] = isset($dd_free) ? $dd_free : ram_free;
	
	CtlIncidents::getInstance()->createIncident($data);
	
	
}