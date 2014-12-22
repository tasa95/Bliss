<?php

class Incident {
	
	private $id_incident;
	private $id_etat;
	private $id_machine;
	private $date_ouverture;
	private $date_cloture;
	private $valeur;
	
	function __construct() {
		
	}
	
	public function getId_incident() {
		return $this->id_incident;
	}
	
	public function getId_etat() {
		return $this->id_etat;
	}
	
	public function getId_machine() {
		return $this->id_machine;
	}
	
	public function getDate_ouverture() {
		return $this->date_ouverture;
	}
	
	public function getDate_cloture() {
		return $this->date_cloture;
	}
	
	public function getValeur() {
		return $this->valeur;
	}
	
	public function setId_incident($id_incident) {
		$this->id_incident = $id_incident;
	}
	
	public function setId_etat($id_etat) {
		$this->id_etat = $id_etat;
	}
	
	public function setId_machine($id_machine) {
		$this->id_machine = $id_machine;
	}
	
	public function setDate_ouverture($date_ouverture) {
		$this->date_ouverture = $date_ouverture;
	}
	
	public function setDate_cloture($date_cloture) {
		$this->date_cloture = $date_cloture;
	}
	
	public function setValeur($valeur) {
		$this->valeur = $valeur;
	}

}