<?php
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 15/06/2017
 * Time: 23:35
 */
require_once 'bibliotheque.php';
require_once 'recup.php';
require_once 'database.php';
var_dump($_POST);
$tab = recupParours($_POST["etu"], $_POST["cursus"], $database);
$r= "SELECT nom,prenom,admission,filiere FROM Etudiant WHERE  IdEtu = ".$_POST["etu"];
$result = mysqli_query($database, $r);
$etu = array();
while ($row = mysqli_fetch_array($result)){
    for($i = 0; $i<(count($row))/2; $i++){
        $etu[] = $row[$i];
    }
}
var_dump($etu);
$etudiant = new Etudiant($_POST["etu"],$etu[0],$etu[1],$etu[2],$etu[3]);
saveCSV($tab,$etudiant,$_POST["etu"]);
echo "<a href='file_csv/".$_POST["etu"].".csv'><h1>Télécharger le parcours</h1></a>";
?>