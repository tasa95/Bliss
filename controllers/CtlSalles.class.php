<?php

class CtlSalles extends Controller {

	private static $instance = null;

	private function __construct() {
	}

	public static function getInstance() {
		if(self::$instance == null)
			self::$instance = new CtlSalles();

		return self::$instance;
	}

	public function createUpdateSalle($data) {

		if(isset($data['id']))
			$id = intval($data['id']);
		else
			$id = -1;

		if($id == -1)
			$Salle = new Salle();
		else
			$Salle = DAOSalle::getInstance()->find($id);

		$regex = "#^[-_\s\wàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$#";

		if(preg_match($regex, $data['nom'])) {
			$Salle->setNom_salle($data['nom']);
				
			//var_dump( $id );
			if($id == -1)
				DAOSalle::getInstance()->create($Salle);
			else
				DAOSalle::getInstance()->update($Salle);

			self::redirect("../views/salles.php?menu=salles&valide=true");
		} else {
			self::redirect("../views/salles.php?menu=salles&valide=false&id_salle=".$id);
		}
	}

	public function deleteSalle($data) {
		DAOSalle::getInstance()->delete(DAOSalle::getInstance()->find($data['id_salle']));
		header('Location: ../views/salles.php?menu=salles');
	}
}