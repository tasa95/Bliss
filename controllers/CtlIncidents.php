<?php

class CtlIncidents extends Controller {

	private static $instance = null;

	private function __construct() {
	}

	public static function getInstance() {

		if(self::$instance == null)
			self::$instance = new CtlIncidents();

		return self::$instance;
	}

	public function createIncident($data) {

		
		$Etat = new Etat();
		$Etat->setId_etat($data['id_etat']);
		$Etat->setId_machine($data['id_machine']);
		$Etat->setDate_ouverture($data['date_ouverture']);
		$Etat->setValeur($data['valeur']);

		DAOIncident::getInstance()->create($Etat);
	}
}