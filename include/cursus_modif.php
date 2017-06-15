<?php
include("database.php");
include ("bibliotheque.php");
   /* $etu=$_POST["etu"];
    $cursus=$_POST["cursus"];*/
   $etu=66666;
   $cursus=4;

$sql = "SELECT sigle FROM ElemForm WHERE IdEleve = $etu AND IdParcours = $cursus";
$res = mysqli_query($database, $sql);
$resultats=array();
while ($row = mysqli_fetch_array($res))
{
    $resultats[] = $row[0];
}

echo("<form method=\"POST\" action=\"include/cursus_modif.php\">");
echo(genereSelect($resultats,"ue","ue"));


echo("<input type=submit> ");
echo ("</form>");
