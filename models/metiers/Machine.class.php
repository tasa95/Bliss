<?php 

class Machine {
	
	private $id_machine;
	private $ip_machine;
	private $nom_machine;
	
	function __construct() {
	
	}
	
	public function getId_machine() {
		return $this->id_machine;
	}
	
	public function getIp_machine() {
		return $this->ip_machine;
	}
	
	public function getNom_machine() {
		return $this->nom_machine;
	}
	
	public function setId_machine($id_machine) {
		$this->id_machine = $id_machine;
	}
	
	public function setIp_machine($ip_machine) {
		$this->ip_machine = $ip_machine;
	}

	public function setNom_machine($nom_machine) {
		$this->nom_machine = $nom_machine;
	}













}
