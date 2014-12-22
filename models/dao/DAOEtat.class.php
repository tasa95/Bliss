<?php

class DAOEtat extends DAO {

	private static $instance =  null;

	private function __construct() {
	}

	public static function getInstance() {

		if(is_null(self::$instance)) {
			self::$instance = new DAOEtat();
		}

		return self::$instance;
	}

	public function create($Etat) {
		$sql ="INSERT INTO `bliss`.`etats`
				(`description`)
				VALUES
				('".$Etat->getDescription()."');
						";
		self::getConnexion()->exec($sql);
	}

	public function delete($Etat) {
		$sql ="Delete from etats where id_etat=".$Etat->getId_etat();
		self::getConnexion()->exec($sql);
	}

	public function update($Etat) {
		$sql ="UPDATE `bliss`.`etats`
				SET
				`id_etat` = '".$Etat->getId_etat()."',
				`description` = '".$Etat->getDescription()."'
				WHERE `id_etat` = '".$Etat->getId_etat()."';";
		
		self::getConnexion()->exec($sql);
	}

	public function find($id_etat) {
		$sql ="Select * from etats where id_etat =".$id_etat;
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}

	public function findAll() {
		$sql ="Select * from etats order by description";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}

	public function SqlToObject($data) {

		$tableEtat = array();

		while($row = $data->fetch()) {
			$Etat = new Etat();
			$Etat->setId_etat($row['id_etat']);
			$Etat->setDescription($row['description']);
			array_push($tableEtat,$Etat);
		}

		return $tableEtat;
	}

	public function SqlToUniqueObject($data) {

		$Etat = new Etat();

		while($row = $data->fetch()) {
			$Etat->setId_etat($row['id_etat']);
			$Etat->setDescription($row['description']);
		}

		return $Etat;
	}
	
	public function findByAlias($alias) {
		$sql ="Select * from etats where alias ='".$alias."'";
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}
}