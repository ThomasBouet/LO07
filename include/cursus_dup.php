<?php
include "database.php";
$etu = $_POST["etu"];
$cursus = $_POST["cursus"];


$sql = "SELECT * FROM ElemForm WHERE IdEleve= '$etu' AND IdParcours='$cursus'";
$res = mysqli_query($database, $sql);
$resultats=array();
while ($row = mysqli_fetch_array($res))
{
    $resultats[] = $row[0];
}
var_dump($resultats);

