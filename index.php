<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ob_start();
include("templates/header.tpl.php");
include("templates/menu.tpl.php");
?>

<h1>Page d'index</h1>
<?php
$Salle = DAOSalle::getInstance()->find(1);
?>

<?php 
include("templates/footer.tpl.php");
?>