<?php

include_once("Controller.class.php");

class CtlUsers extends Controller {

	private static $instance = null;

	private function __construct() {
	}

	/**
	 * permet de récuperer l'instance unique du singleton
	 * @return CtlUsers
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			self::$instance = new CtlUsers();
		}

		return self::$instance;
	}

	/**
	 * permet de créer ou mettre à jour un utilisateur et renvoyer une erreur si la saisie est incorrecte
	 * @param int $id
	 * @param string $nom
	 * @param string $prenom
	 * @param string $login
	 * @param string $password
	 * @return boolean
	 */
	public function createUpdateUser($data) {
		
		if(isset($data['id']))
			$id = intval($data['id']);
		else
			$id = -1;

		if($id == -1)
			$User = new User();
		else
			$User = DAOUser::getInstance()->find($id);

		$regexNomPrenom = "#^[-_\s\wàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$#";
		$regexLogin = "#^[-_\w]+$#";

		if(
		preg_match($regexNomPrenom, $data['nom'])  &&
		preg_match($regexNomPrenom, $data['prenom'])  &&
		preg_match($regexLogin, $data['login']) &&
		strlen($data['password']) >= 6
		) {
			$User->setNom($data['nom']);
			$User->setPrenom($data['prenom']);
			$User->setLogin($data['login']);
			$User->setPassword(md5($data['password']));

			if($id == -1)
				DAOUser::getInstance()->create($User);
			else
				DAOUser::getInstance()->update($User);

			self::redirect("../views/users.php?menu=users&valide=true");
		} else {
			self::redirect("../views/users.php?menu=users&valide=false&id_user=".$id);
		}
	}

	/**
	 * permet de supprimer un utilisateur
	 * @param int $id
	 */
	public function deleteUser($data) {
		DAOUser::getInstance()->delete(DAOUser::getInstance()->find($data['id_user']));
		header('Location: ../views/users.php?menu=users');
	}
}