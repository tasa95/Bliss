<?php 

class MachineSalle {
	
	private $id_machineSalle;
	private $id_machine;
	private $id_salle;
	
	function __construct() {
	
	}
	
	public function getId_machineSalle() {
		return $this->id_machineSalle;
	}
	
	public function getId_machine () {
		return $this->id_machine;
	}
	
	public function getId_salle () {
		return $this->id_salle;
	}
	
	public function setId_machineSalle($id_machineSalle) {
		$this->id_machineSalle = $id_machineSalle;
	}
	
	public function setId_machine($id_machine) {
		$this->id_machine = $id_machine;
	}
	
	public function setId_salle($id_salle) {
		$this->id_salle = $id_salle;
	}
}