<?php

class DAOMachine extends DAO {

	public static $instance = null;

	private function __construct() {
	}

	public static function getInstance() {
		if(is_null(self::$instance)) {
			self::$instance = new DAOMachine();
		}

		return self::$instance;
	}

	public function create($Machine) {
		$sql ="INSERT INTO machines (ip_machine, nom_machine) VALUES('".$Machine->getIp_machine()."', '".$Machine->getNom_machine()."')";
		return self::getConnexion()->requete($sql);
	}

	public function delete($Machine) {
		$sql ="DELETE FROM machines WHERE id_machine = '".$Machine->getId_machine()."'";
		self::getConnexion()->requete($sql);
		$sql ="DELETE FROM machinesalles WHERE id_machine = '".$Machine->getId_machine()."'";
		self::getConnexion()->requete($sql);
	}

	public function update($Machine) {
		$sql ="UPDATE machines SET ip_machine = '".$Machine->getIp_machine()."', nom_machine = '".$Machine->getNom_machine()."' WHERE id_machine = '".$Machine->getId_machine()."'";
		self::getConnexion()->requete($sql);
	}

	public function find($id_machine) {
		$sql ="Select * from machines where id_machine =".$id_machine;
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}
	
	public function findAll() {
		$sql ="Select * from machines order by nom_machine";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}
	
	public function SqlToObject($data) {
	
		$tableMachine = array();
	
		while($row = $data->fetch()) {
			$Machine = new Machine();
			$Machine->setId_machine($row['id_machine']);
			$Machine->setIp_machine($row['ip_machine']);
			$Machine->setNom_machine($row['nom_machine']);
			array_push($tableMachine,$Machine);
		}
	
		return $tableMachine;
	}
	
	public function SqlToUniqueObject($data) {
	
		$Machine = new Machine();
	
		while($row = $data->fetch()) {
			$Machine->setId_machine($row['id_machine']);
			$Machine->setIp_machine($row['ip_machine']);
			$Machine->setNom_machine($row['nom_machine']);
		}
	
		return $Machine;
	}
	
	public function findBySalle($id_salle) {
		$sql ="Select * from machines where id_machine =".$id_machine;
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}
	
	public function findAllBySalle($id_salle) {
		$sql ="SELECT machines.id_machine, machines.ip_machine, machines.nom_machine 
				FROM machines, machinesalle 
				WHERE machinesalle.id_salle ='".$id_salle."' 
				AND machinesalle.id_machine = machines.id_machine";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}


}