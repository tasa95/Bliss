<?php

include_once("DAO.class.php");

class DAOSalle extends DAO {

	public static $instance = null;

	private function __construct() {
	}

	public static function getInstance() {
		if(is_null(self::$instance)) {
			self::$instance = new DAOSalle();
		}

		return self::$instance;
	}

	public function create($Salle) {
		$sql ="INSERT INTO salles(nom_salle) VALUES ('".$Salle->getNom_salle()."')";
		self::getConnexion()->requete($sql);
	}

	public function delete($Salle) {
		$sql ="DELETE FROM salles WHERE id_salle = '".$Salle->getId_salle()."'";
		self::getConnexion()->requete($sql);
	}

	public function update($Salle) {
		$sql ="UPDATE salles SET nom_salle  =  '".$Salle->getNom_salle()."' WHERE id_salle = '".$Salle->getId_salle()."'";
		self::getConnexion()->requete($sql);
	}

	public function find($id_salle) {
		$sql ="Select * from salles where id_salle =".$id_salle;
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}

	public function findAll() {
		$sql ="Select * from salles order by nom_salle";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}

	public function SqlToObject($data) {

		$tableSalle = array();

		while($row = $data->fetch()) {
			$Salle = new Salle();
			$Salle->setId_salle($row['id_salle']);
			$Salle->setNom_salle($row['nom_salle']);
			array_push($tableSalle,$Salle);
		}

		return $tableSalle;
	}

	public function SqlToUniqueObject($data) {

		$Salle = new Salle();

		while($row = $data->fetch()) {
			$Salle->setId_salle($row['id_salle']);
			$Salle->setNom_salle($row['nom_salle']);
		}

		return $Salle;
	}
}