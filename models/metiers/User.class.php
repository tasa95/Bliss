<?php

class User {
	
	private $id_user;
	private $nom;
	private $prenom;
	private $login;
	private $password;
	
	function __construct() {	
	}
	
	public function getId_user() {
		return $this->id_user;
	}
	
	public function getNom() {
		return $this->nom;
	}
	
	public function getPrenom() {
		return $this->prenom;
	}
	
	public function getLogin() {
		return $this->login;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setId_user($id_user) {
		$this->id_user = $id_user;
	}
	
	public function setNom($nom) {
		$this->nom = $nom;
	}
	
	public function setPrenom($prenom) {
		$this->prenom = $prenom;
	}
	
	public function setLogin($login) {
		$this->login = $login;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}

}