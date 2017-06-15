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



$sql = "SELECT * FROM Ue";
$res = mysqli_query($database, $sql);
$resultats = array();
while ($row = mysqli_fetch_array($res)) {
    $resultats[] = $row;
}

echo("<h1>Listes des UEs entrees :</h1>");


echo("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"600\">
 <tr>
  <td>
   <table cellspacing=\"0\" cellpadding=\"1\" border=\"1\" width=\"680\" >
     <tr style=\"color:white;background-color:grey\">
        <th width='120'>Nom</th>
        <th width='160'>Categorie</th>
        <th width='160'>Affectation</th>
        <th width='260'>Description</th>
     </tr>
   </table>
  </td>
 </tr>
<tr>
<td>
   <div style=\"width:680px; height:180px; overflow:auto;\">
     <table cellspacing=\"0\" cellpadding=\"1\" border=\"1\" width=\"680\" >
       ");
foreach ($resultats as $table){
    $Id=$table["IdUe"];
    $desc=$table["desc"];
    $categorie=$table["cat"];
    $affect=$table["affectation"];
    echo("
       <tr >
           <td width='120'>  $Id </td>
           <td width='160'> $categorie </td>
           <td width='160'>$affect</td>
           <td width='260'> $desc</td>
       </tr>");
}
echo("</table>  
   </div>
  </td>
 </tr>
</table>");







echo("> </br>
                Catégorie\""); echo(genereSelect($cat, 'categorie[]', 'categorie')); echo("</br>
                Affectation"); echo(genereSelect($affectation, 'affectation[]', 'affectation')); echo(" </br>
                Crédits "); echo(genereSelect($num, 'credits[]', 'credits')); echo(" </br>
                Description <input type=\"text\" name=\"desc[]\"> </br>
            </fieldset>
        </div>
    </div>
    <div id=\"dynamicInput1\"> </br>
        <fieldset>
            Sigle <input type=\"text\" name=\"sigle[]\"> </br>
            Catégorie");echo(genereSelect($cat, 'categorie[]', 'categorie')); echo("</br>
            Affectation");echo(genereSelect($affectation, 'affectation[]', 'affectation')); echo(" </br>
            Crédits");echo(genereSelect($num, 'credits[]', 'credits')); echo(" </br>
            Description <input type=\"text\" name=\"desc[]\"> </br>

        </fieldset>
    </div>
    <input type=\"button\" value=\"Add another text input\" onClick=\"addInput('dynamicInput');\"> </br>
    <input type=\"submit\" value=\"Envoyer\">
</form>");


echo("<h1>Supprimer une UE entree</h1>");
$ue=[];

foreach ($resultats as $table){
    $ue[]=$table["IdUe"];
}
echo("<form method=\"POST\" action=\"ue_form.php\">");
    echo(genereSelect($ue,"ue","ue"));
    echo("<input type=submit>");
    echo("</form>");


if (isset($_POST)) {
    $post = $_POST["ue"];
    echo("$post");
    $requete = "DELETE FROM Ue WHERE IdUe = '$post'";
    $resultat = mysqli_query($database, $requete);
    echo("[$requete]");
    if ($resultat) {
        echo("oui");
    } else {
        echo("non");
        mysqli_error($database);
    }
}



?>