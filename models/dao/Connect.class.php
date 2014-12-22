<?php
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/conf/Conf_sql.php");
class Connect
{

	public function __construct()
	{
	}
	
	private function connection()
	{
		  
		try 
		{
			$dbh = new PDO(SERVER, USER, MDP);
			
		} 
		catch (PDOException $e) 
		{
		    echo 'Connection failed: ' . $e->getMessage();
		}
		if(!empty($dbh))
		{
			return $dbh ;
		}
		
		return "";
	}
	
	private function deconnection($dbh)
	{
		$dbh = null ;
	}
	
	public function requete($req)
	{
		//var_dump($req);
		$connect = $this->connection();

		if(!empty($connect))
		{
			//die(var_dump($req));
			$res = $connect->query($req);
			if(stristr($req, 'insert'))
			{
				$id = $connect->lastInsertId();
				$insert = true;
			}
			//die(var_dump($res));
			$this->deconnection($connect);
			if(!(isset($insert)) || !($insert))
			{
				
				return $res;
				
			}
			else
			{
				return $id;
			}
		}
	}	
	
	public function exec($sql) {
		$connect = $this->connection();
		$connect->beginTransaction();
		$connect->exec($sql);
		$connect->commit();
		$this->deconnection($connect);
	}
}

?>