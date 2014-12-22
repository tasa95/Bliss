<?php

include_once("DAO.class.php");

class DAOUser extends DAO {

	private static $instance =  null;

	private function __construct() {
	}

	public static function getInstance() {

		if(is_null(self::$instance)) {
			self::$instance = new DAOUser();
		}

		return self::$instance;
	}

	public function create($User) {
		$sql ="INSERT INTO `bliss`.`users`
				(`nom`,
				`prenom`,
				`login`,
				`password`)
				VALUES
				('".$User->getNom()."',
						'".$User->getPrenom()."',
								'".$User->getLogin()."',
										'".$User->getPassword()."')";

		self::getConnexion()->exec($sql);
	}

	public function delete($User) {
		$sql ="Delete from users where id_user=".$User->getId_user();
		self::getConnexion()->exec($sql);
	}

	public function update($User) {
		$sql ="UPDATE `bliss`.`users`
				SET
				`id_user` = '".$User->getId_user()."',
				`nom` = '".$User->getNom()."',
				`prenom` = '".$User->getPrenom()."',
				`login` = '".$User->getLogin()."',
				`password` = '".$User->getPassword()."'
				WHERE `id_user` = '".$User->getId_user()."'";
		self::getConnexion()->exec($sql);
	}

	public function find($id_user) {
		$sql ="Select * from users where id_user =".$id_user;
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}

	public function findAll() {
		$sql ="Select * from users order by nom";
		return $this->SqlToObject(self::getConnexion()->requete($sql));
	}

	public function SqlToObject($data) {

		$tableUser = array();

		while($row = $data->fetch()) {
			$User = new User();
			$User->setId_user($row['id_user']);
			$User->setNom($row['nom']);
			$User->setPrenom($row['prenom']);
			$User->setLogin($row['login']);
			$User->setPassword($row['password']);
			array_push($tableUser,$User);
		}

		return $tableUser;
	}

	public function SqlToUniqueObject($data) {

		$User = new User();

		while($row = $data->fetch()) {
			$User->setId_user($row['id_user']);
			$User->setNom($row['nom']);
			$User->setPrenom($row['prenom']);
			$User->setLogin($row['login']);
			$User->setPassword($row['password']);
		}
		return $User;
	}

	public function findByMdpAndLogin($data)
	{
		$sql = " select * from users where login = '".$data->getLogin()."' and password = '".$data->getPassword()."' ";
		return $this->SqlToUniqueObject(self::getConnexion()->requete($sql));
	}
}