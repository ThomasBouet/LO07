<?php
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 15/06/2017
 * Time: 23:35
 */
require_once 'include/bibliotheque.php';
require_once 'include/recup.php';
require_once 'include/database.php';
$tab = recupParours($_POST["idetu"], $_POST["cursus"], $database);
saveCSV($tab,$_POST["idetu"]);
echo "<a href='file_csv/".$_POST["idetu"].".csv'><h1>Télécharger le parcours</h1></a>";
?>