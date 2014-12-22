<?php

class DAOIncident extends DAO {

	private static $instance =  null;

	private function __construct() {
	}

	public static function getInstance() {

		if(is_null(self::$instance)) {
			self::$instance = new DAOIncident();
		}

		return self::$instance;
	}

	public function create($Incident) {
		$sql ="INSERT INTO `bliss`.`incidents`
				(`id_etat`,
				`id_machine`,
				`date_ouverture`,
				`valeur`)
				VALUES
				('".$Incident->getId_etat()."',
								'".$Incident->getId_machine()."',
										'".$Incident->getDate_ouverture()."',
														'".$Incident->getValeur()."');";
		self::getConnexion()->requete($sql);
	}

	public function delete($Incident) {
		$sql ="Delete from incidents where id_incident =".$Incident->getId_incident();
		self::getConnexion()->requete($sql);
	}

	public function update($Incident) {
		$sql ="UPDATE `bliss`.`incidents`
				SET
				`id_incident` = '".$Incident->getId_incident()."',
						`id_etat` = '".$Incident->getId_etat()."',
								`id_machine` = '".$Incident->getId_machine()."',
										`date_ouverture` = '".$Incident->getDateOuverture()."',
												`date_cloture` = '".$Incident->getDate_cloture()."',
														`valeur` = '".$Incident->getValeur()."'
																WHERE `id_incident` = '".$Incident->getId_incident()."';";
		self::getConnexion()->requete($sql);
	}

	public function find($id_incident) {
		$sql ="Select * from incidents where id_incident =".$id_incident;
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}

	public function findAll() {
		$sql ="Select * from incidents order by date_ouverture DESC";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}

	public function SqlToObject($data) {

		$tableIncident = array();

		while($row = $data->fetch()) {
			$Incident = new Incident();
			$Incident->setId_incident($row['id_incident']);
			$Incident->setId_etat($row['id_etat']);
			$Incident->setId_machine($row['id_machine']);
			$Incident->setDate_cloture($row['date_cloture']);
			$Incident->setDate_ouverture($row['date_ouverture']);
			$Incident->setValeur($row['valeur']);
			array_push($tableIncident,$Incident);
		}

		return $tableIncident;
	}

	public function SqlToUniqueObject($data) {

		$Incident = new Incident();

		while($row = $data->fetch()) {
			$Incident->setId_incident($row['id_incident']);
			$Incident->setId_etat($row['id_etat']);
			$Incident->setId_machine($row['id_machine']);
			$Incident->setDate_cloture($row['date_cloture']);
			$Incident->setDate_ouverture($row['date_ouverture']);
			$Incident->setValeur($row['valeur']);
		}

		return $Incident;
	}

	public function findCurrentByMachine($id_machine) {
		$sql ="Select * from incidents where id_machine = ".$id_machine." AND isNull(date_cloture)";
// 		var_dump($sql); die();
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}
	
	public function findAllByMachine($id_machine) {
		$sql ="Select * from incidents where id_machine = ".$id_machine." order by date_ouverture DESC";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}
}
