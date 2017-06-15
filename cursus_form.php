<?php
include_once('database.php');
include_once('bibliotheque.php');
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
<form method="POST" action="cursus_action.php">
    Numero etudiant : <?php echo(genereSelect($nom,"etu","etu"));?>

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