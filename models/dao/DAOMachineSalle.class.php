<?php

class DAOMachineSalle extends DAO {

	private static $instance =  null;

	private function __construct() {
	}

	public static function getInstance() {

		if(is_null(self::$instance)) {
			self::$instance = new DAOMachineSalle();
		}

		return self::$instance;
	}

	public function create($MachineSalle) {
		$sql ="INSERT INTO machineSalle (id_machine, id_salle) VALUES ('".$MachineSalle->getId_machine()."', '".$MachineSalle->getId_salle ()."')";
		return self::getConnexion()->requete($sql);
	}

	public function delete($MachineSalle) {
		$sql ="Delete from machinesalle where id_machineSalle =".$MachineSalle->getId_machineSalle();
		self::getConnexion()->requete($sql);
	}

	public function update($MachineSalle) {
		$sql ="Update ...";
		self::getConnexion()->requete($sql);
	}

	public function find($id_machineSalle) {
		$sql ="Select * from machineSalle where id_machineSalle =".$id_machineSalle;
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}

	public function findAll() {
		$sql ="Select * from machineSalle order by nom_machine";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}

	public function SqlToObject($data) {

		$tableMachineSalle = array();

		while($row = $data->fetch()) {
			$MachineSalle = new MachineSalle();
			$MachineSalle->setId_machineSalle($row['id_machineSalle']);
			$MachineSalle->setId_salle($row['id_salle']);
			$MachineSalle->setId_machine($row['id_machine']);
			array_push($tableMachineSalle,$MachineSalle);
		}

		return $tableMachineSalle;
	}

	public function SqlToUniqueObject($data) {

		$MachineSalle = new MachineSalle();
		
		while($row = $data->fetch()) {
			$MachineSalle->setId_machineSalle($row['id_machineSalle']);
			$MachineSalle->setId_salle($row['id_salle']);
			$MachineSalle->setId_machine($row['id_machine']);
		}

		return $MachineSalle;
	}
	
	public function findBySalle($id_salle) {
		$sql ="Select * from machineSalle where id_salle =".$id_salle;
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}
	
	
	public function deleteByIdMachine($MachineSalle)
	{
			$sql = "DELETE FROM machineSalle WHERE id_machine='".$MachineSalle->getId_machine()."'";
			self::getConnexion()->requete($sql);
	}
	
	public function findByMachine($id_machine) {
		$sql ="Select * from machineSalle where id_machine =".$id_machine;
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}
	
	public function deleteByMachine($id_machine) {
		$sql ="Delete from machinesalle where id_machine=".$id_machine;
		self::getConnexion()->requete($sql);
	}
}