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

$etuid = $match['params']['id'];
$tab = recupParours($etuid, $match['params']['cursus'], $database);
$r = "SELECT nom,prenom,admission,filiere FROM Etudiant WHERE  IdEtu = " . $etuid;
$result = mysqli_query($database, $r);
$etu = array();
while ($row = mysqli_fetch_array($result)) {
    for ($i = 0; $i < (count($row)) / 2; $i++) {
        $etu[] = $row[$i];
    }
}
$etudiant = new Etudiant($etuid, $etu[0], $etu[1], $etu[2], $etu[3]);
saveCSV($tab, $etudiant, $etuid);
header('Location:' . '/include/file_csv/' . $etuid . '.csv');