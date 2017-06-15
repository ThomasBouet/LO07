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
echo("<h1>Supression d'UE dans le cursus numero $cursus</h1>");
echo("<form method=\"POST\" action=\"cursus_modif_supr.php\">");
echo(genereSelectMult($resultats,"ue","ue"));
echo("<input type=\"hidden\" name=\"etu\" value=\"$etu\">
<input type=\"hidden\" name=\"cursus\" value=" . $cursus . "> ");
echo("<input type=submit> ");
echo ("</form>");

//=============== AJOUT D'UNE UE  ===============================//

echo("<h1>Ajout d'une UE dans le cursus $cursus </h1>");
$resultat = array('A', 'B', 'C', 'D', 'E', 'F', 'ADM', 'RES', 'ABS');
$yesno = array('Y', 'N');
$num = array(1, 2, 3, 4, 5, 6,7,8,9,10,11,12);
$ues=selectdata('IdUe','Ue',$database);
$nom = selectdata("IdEtu","Etudiant",$database);

?>
<html>
<script>
    var counter = 0;
    var limit = 30;
    var original = document.getElementById('dynamicInputHidden');
    function addInput() {
        if (counter == limit) {
            alert("You have reached the limit of adding " + counter + " inputs");
        } else {
            var original = document.getElementById('dynamicInputHidden');
            var clone = original.cloneNode(true);
            counter++;
            clone.id = 'dynamicInput' + counter;
            var id = clone.id;
            clone.style = "display : initial;";
            clone.name = 'clone' + counter;
            original.parentNode.appendChild(clone);
        }

    }
</script>
<form method="POST" action="include/cursus_modif_action.php">

    <div id='container'>
        <div id="dynamicInputHidden" style="display : none;"> </br>


            <fieldset name="fieldset">
                Nom de l'UE <?php echo(genereSelect($ues,'ue[]','ue'));?></br>
                Numéro du semestre <?php echo(genereSelect($num, 'num[]', 'num')); ?> </br>
                Label du semestre <input type="text" name="sem_label[]"> </br>
                Profil <?php echo(genereSelect($yesno, 'profil[]', 'profil')); ?> </br>
                UTT <?php echo(genereSelect($yesno, 'UTT[]', 'utt')); ?> </br>
                Resultat <?php echo(genereSelect($resultat, 'resultat[]', 'resultat')); ?> </br>

            </fieldset>
        </div>
    </div>
    <div id="dynamicInput1"> </br>
        <fieldset>
            Nom de l'UE <?php echo(genereSelect($ues,'ue[]','ue'));?></br>
            Numéro du semestre <?php echo(genereSelect($num, 'num[]', 'num')); ?> </br>
            Label du semestre <input type="text" name="sem_label[]"> </br>
            Profil <?php echo(genereSelect($yesno, 'profil[]', 'profil')); ?> </br>
            UTT <?php echo(genereSelect($yesno, 'UTT[]', 'utt')); ?> </br>
            Resultat <?php echo(genereSelect($resultat, 'resultat[]', 'resultat')); ?> </br>
        </fieldset>
    </div>
    <input type="button" value="Add another text input" onClick="addInput('dynamicInput');"> </br>
    <input type="submit" value="Envoyer">
</form>

</html>
