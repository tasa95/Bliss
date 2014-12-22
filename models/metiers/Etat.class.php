<?php

class Etat {
	
	private $id_etat;
	private $description;
	
	function __construct() {
		
	}
	
	public function getId_etat() {
		return $this->id_etat;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	
	public function setId_etat($id_etat) {
		$this->id_etat = $id_etat;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	
}