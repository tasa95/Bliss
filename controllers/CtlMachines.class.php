<?php

class CtlMachines extends Controller {

	private static $instance = null;

	private function __construct() {
	}

	public static function getInstance() {
		if(self::$instance == null)
			self::$instance = new CtlMachines();

		return self::$instance;
	}

	public function createUpdateMachine($data) {
		if(isset($data['id']))
			$id = intval($data['id']);
		else
			$id = -1;

		if($id == -1)
			$Machine = new Machine();
		else
			$Machine = DAOMachine::getInstance()->find($id);

		$regexNom = "#^[-_\s\wàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$#";
		$regexIp = "#^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?).(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$#";

		if(
		preg_match($regexNom, $data['nom'])  &&
		preg_match($regexIp, $data['ip'])) {
			$Machine->setNom_machine($data['nom']);
			$Machine->setIp_machine($data['ip']);

			if($id == -1) {
				$id_machine = DAOMachine::getInstance()->create($Machine);
			} else {
				DAOMachine::getInstance()->update($Machine);
				$id_machine = $Machine->getId_machine();
			}
				
			DAOMachineSalle::getInstance()->deleteByMachine($id_machine);
			if($data['salle'] != -1) {
				$machineSalle = new MachineSalle();
				$machineSalle->setId_machine($id_machine);
				$machineSalle->setId_salle($data['salle']);
				DAOMachineSalle::getInstance()->create($machineSalle);
			}

			self::redirect("../views/machines.php?menu=machines&valide=true");
		} else {
			if(isset($data['currentSalle'])) {
				self::redirect("../views/machines.php?menu=machines&valide=false&id_salle=".$data['currentSalle']."&id_machine=".$id);
			}else
				self::redirect("../views/machines.php?menu=machines&valide=false&id_machine=".$id);
		}
	}

	public function deleteMachine($data) {
		
		DAOMachine::getInstance()->delete(DAOMachine::getInstance()->find($data['id_machine']));
		header('Location: ../views/machines.php?menu=machines');
	}
}