<?php 

class Salle {
	
	private $id_salle;
	private $nom_salle;
	
	function __construct() {
	
	}
	
	public function getId_salle() {
		return $this->id_salle;
	}
	
	public function getNom_salle() {
		return $this->nom_salle;
	}
	
	public function setId_salle($id_salle) {
		$this->id_salle = $id_salle;
	}
	
	public function setNom_salle($nom_salle) {
		$this->nom_salle = $nom_salle;
	}
}