<?php
require_once 'database.php';
include 'elmt_formation.php';
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 15/06/2017
 * Time: 14:58
 */
function recupParours($idEtu, $idParcours, $database){
    $r = "SELECT `sem_seq,sem_label,sigle,utt,profil,creditobt,resultat` FROM `elemform` WHERE IdEleve = $idEtu and IdParcours = $idParcours";
    $result = mysqli_query($database, $r);
    var_dump($result);
    $resultats=array();
    while ($row = mysqli_fetch_array($result))
    {
        $ue = new Element();
        $ue->setSem_seq($row[0]);
        $ue->setSem_label($row[1].$row[0]);
        $ue->setSigle($row[2]);
        $ue->setUtt($row[3]);
        $ue->setProfil($row[4]);
        $ue->setCredit($row[5]);
        $ue->setResultat($row[6]);
        $resultats[] = $ue;
    }
     foreach($resultats as $value){
         $r = "SELECT affectation FROM ue WHERE IdUe = ".$value->getLabel();
         $result = mysqli_query($database, $r);
         while ($row = mysqli_fetch_array($result))
         {
             $value->setAffectation($row[0]);
         }
     }
     return $resultats;
}