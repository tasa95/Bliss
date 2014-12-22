<?php

class CtlEtats extends Controller {
	
	private static $instance = null;
	
	private function __construct() {}
	
	public static function getInstance() {
		if(self::$instance == null)
			self::$instance = new CtlEtats();
		
		return self::$instance;
	}
	
	public function createUpdateEtat($data) {
		
		if(isset($data['id']))
			$id = intval($data['id']);
		else
			$id = -1;
		
		if($id == -1)
			$Etat = new Etat();
		else
			$Etat = DAOEtat::getInstance()->find($id);
		
		$regex = "#^[\w\s_-]+$#";
		
		if(preg_match($regex, $data['description'])) {
			$Etat->setDescription($data['description']);
			
		
			if($id == -1)
				DAOEtat::getInstance()->create($Etat);
			else
				DAOEtat::getInstance()->update($Etat);
		
			self::redirect("../views/etats.php?menu=etats&valide=true");
		} else {
			self::redirect("../views/etats.php?menu=etats&valide=false&id_etat=".$id);
		}
	}
	
	public function deleteEtat($data) {
		DAOEtat::getInstance()->delete(DAOEtat::getInstance()->find($data['id_etat']));
		header('Location: ../views/etats.php?menu=etats');
	}
}