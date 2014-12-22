<?php
session_start();
ob_start();
if(session_id() == "")
{
	session_start();
}

$routes = "/Bliss/routes/routes.php?action=";
?>

<html lang="fr">
<head>
<meta charset="utf-8">

<title>Bliss</title>

<script type="text/javascript" src="/Bliss/assets/js/jquery.js"></script>
<script type="text/javascript" src="/Bliss/assets/js/bootstrap.min.js"></script>
<script type="text/javascript"
	src="/Bliss/assets/js/jquery.dataTables.js"></script>

<!-- Script pour les datatables -->
<script type="text/javascript"
	src="/Bliss/utils/js/datatable.js"></script>
<!-- ---- -->
	
<link rel="stylesheet" type="text/css"
	href="/Bliss/assets/css/style.css" />
<link rel="stylesheet" type="text/css"
	href="/Bliss/assets/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css"
	href="/Bliss/assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css"
	href="/Bliss/assets/css/datatable_table.css" />
<link rel="stylesheet" type="text/css"
	href="/Bliss/assets/css/datatable_page.css" />

<?php

// ---------------------- import des DA0 ---------------------------
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOSalle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOUser.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOMachineSalle.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOMachine.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOIncident.class.php");
include_once($_SERVER['DOCUMENT_ROOT']."/Bliss/models/dao/DAOEtat.class.php");

?>

<?php 
if(!isset($_SESSION['connexion'])) {
?>
<style>
.adminAccess {
	display:none;
}
</style>
<?php
}
?>

<noscript>
<style>
table tr:nth-child(odd):not([type="th"]){
  background-color:#ddddff;
}

th {
	background-color:white!important;
}
</style>
</noscript>
</head>
<body id="bliss">