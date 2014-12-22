<?php 

include_once 'Connect.class.php';

// ---------------------- import des classes metiers ---------------------------
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Salle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/User.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/MachineSalle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Machine.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Incident.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/metiers/Etat.class.php");


abstract class DAO {
	
	private static $connexion = null;

	/**
	 * permet de récuperer l'instance unique du singleton
	 * @return Connect
	 */
	public static function getConnexion() {
		if(is_null(self::$connexion))
			$connexion = new Connect();
		
		return $connexion;
	}
		
	/**
	 * permet de persister un objet en base de données
	 * @param generic $obj
	 */
	public abstract function create($obj);
	
	/**
	 * permet de supprimer un objet de la base de données
	 * @param generic $obj
	 */
	public abstract function delete($obj);
	
	/**
	 * permet la mise à jour d'un objet déjà persisté en base de données
	 * @param generic $obj
	 */
	public abstract function update($obj);
	
	/**
	 * permet de récuperer un objet à partir de son identifiant unique en base de données
	 * @param generic $id
	 * @return Object
	 */
	public abstract function find($id);
	
	/**
	 * permet de récuperer l'integralité des données d'une table
	 * @return array[Object]
	 */
	public abstract function findAll();
	
	/**
	 * permet de convertir le retour d'une requete sql en liste d'objets
	 * @param PdoSqlResponse $data
	 * @return @return array[Object]
	 */
	public abstract function SqlToObject($data);
	
	/**
	 * permet de convertir le retour d'une requete sql en un objet
	 * @param PdoSqlResponse $data
	 */
	public abstract function SqlToUniqueObject($data);
}