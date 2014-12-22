<?php

class CtlAuthentification
{
	private static $instance = null;


	private function __Construct()
	{
			
	}

	public static function getInstance() {
		if(self::$instance == null)
			self::$instance = new CtlAuthentification();
		
		return self::$instance;
	}
	
	public function connexion($data)
	{
		$user = new User();
		$user->setLogin($data["login"]);
		$user->setPassword(md5($data["mdp"]));
		$user = DAOUser::getInstance()->findByMdpAndLogin($user);
		$id = $user->getId_user();
		if(!empty($user) && isset($id))
		{
			$_SESSION["nom"] = $user->getNom();
			$_SESSION["prenom"] = $user->getPrenom();
			$_SESSION["id"] = $user->getId_user();
			$_SESSION["connexion"] = true;
			header('Location:'.$_GET['url'],true);
		}
		else
		{
			if(session_id() == "")
				session_start();
			
			header('Location:'.$_GET['url'].'?errorConnect=1',true);
		}

	}
}


















?>