<?php
session_start();
include_once('database.php');
include_once('bibliotheque.php');
include_once('elmt_formation.php');
$num = array(1, 2, 3, 4, 5, 6);

$cat = selectdata("IdCat", "Categorie_UE", $database);
$affectation = array('TC', 'BR', 'TCBR', 'FCBR');
$yesno = array('Y', 'N');
?>
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
<?php
    $uvs = selectdata("IdUe","Ue",$database);
    echo("<h1>Listes des UEs entrees :</h1>");
    echo("<ul>");
    foreach ($uvs as $u){
        echo("<li>$u</li>");
    }
    echo("</ul>");

        ?>
    <form method="POST" action="ue_action.php">
        <h1> Ajout de nouvelles UEs</h1>
        <div id='container'>
            <div id="dynamicInputHidden" style="display : none;"> </br>
                <fieldset name="fieldset">
                    Sigle <input type="text" name="sigle[]"> </br>
                    Catégorie <?php echo(genereSelect($cat, 'categorie[]', 'categorie')); ?> </br>
                    Affectation <?php echo(genereSelect($affectation, 'affectation[]', 'affectation')); ?> </br>
                    Crédits <?php echo(genereSelect($num, 'credits[]', 'credits')); ?> </br>
                    Description <input type="text" name="desc[]"> </br>
                </fieldset>
            </div>
        </div>
        <div id="dynamicInput1"> </br>
            <fieldset>
                Sigle <input type="text" name="sigle[]"> </br>
                Catégorie <?php echo(genereSelect($cat, 'categorie[]', 'categorie')); ?> </br>
                Affectation <?php echo(genereSelect($affectation, 'affectation[]', 'affectation')); ?> </br>
                Crédits <?php echo(genereSelect($num, 'credits[]', 'credits')); ?> </br>
                Description <input type="text" name="desc[]"> </br>

            </fieldset>
        </div>
        <input type="button" value="Add another text input" onClick="addInput('dynamicInput');"> </br>
        <input type="submit" value="Envoyer">
    </form>



