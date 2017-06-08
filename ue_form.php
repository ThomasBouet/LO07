<?php
session_start();
include_once('database.php');
include_once('bibliotheque.php');
include_once('elmt_formation.php');
$resultat = array('A','B','C','D','E','F','ADM','RES','ABS');
$num = array(1,2,3,4,5,6);
$r1 ='select IdCat from categorie_ue';
$result = mysqli_query($database, $r1);
echo $r1;

$cat = selectdata("IdCat","Categorie_UE",$database);
$affectation = array('TC','BR','TCBR','FCBR');
$yesno = array('Y','N');
?>
<script>
    var counter = 0;
    var limit = 30;
    var original = document.getElementById('dynamicInputHidden');
    function addInput(){
         if (counter == limit)  {
              alert("You have reached the limit of adding " + counter + " inputs");
         }else{
             var original = document.getElementById('dynamicInputHidden');
             var clone = original.cloneNode(true);
             counter ++;
             clone.id = 'dynamicInput'+ counter;
             var id = clone.id;
             clone.style = "display : initial;";
             clone.name = 'clone'+ counter;
             original.parentNode.appendChild(clone);
         }

    }
</script>
<form method="POST" action="#">
    <?php ?>
    <div id='container'>
     <div id="dynamicInputHidden" style="display : none;"> </br>
         <fieldset name="fieldset">
		Numéro du semestre <?php echo(genereSelect($num,'num[]','num'));?> </br>
		Label du semestre <input type="text" name="sem_label[]"> </br>
		Sigle <input type="text" name="sigle[]"> </br>
		Catégorie <?php echo(genereSelect($cat,'categorie[]','categorie'));?> </br>
		Affectation <?php echo(genereSelect($affectation,'affectation[]','affectation'));?> </br>
                UTT <?php echo(genereSelect($yesno,'UTT[]','utt'));?> </br>
                Profil <?php echo(genereSelect($yesno,'profil[]','profil'));?> </br>
		Crédits <?php echo(genereSelect($num, 'credits[]','credits'));?> </br>
                Resultat <?php echo(genereSelect($resultat,'resultat[]','resultat'));?> </br>	
         </fieldset>
     </div>
    </div>
     <div id="dynamicInput1"> </br>
         <fieldset>
		Numéro du semestre <?php echo(genereSelect($num,'num[]','num'));?> </br>
		Label du semestre <input type="text" name="sem_label[]"> </br>
		Sigle <input type="text" name="sigle[]"> </br>
		Catégorie <?php echo(genereSelect($cat,'categorie[]','categorie'));?> </br>
		Affectation <?php echo(genereSelect($affectation,'affectation[]','affectation'));?> </br>
                UTT <?php echo(genereSelect($yesno,'UTT[]','utt'));?> </br>
                Profil <?php echo(genereSelect($yesno,'profil[]','profil'));?> </br>
		Crédits <?php echo(genereSelect($num, 'credits[]','credits'));?> </br>
                Resultat <?php echo(genereSelect($resultat,'resultat[]','resultat'));?> </br>	
         </fieldset>
     </div>
     <input type="button" value="Add another text input" onClick="addInput('dynamicInput');"> </br>
	 <input type="submit" value="Envoyer">
</form>
<?php
$elmt = array();
if(isset($_POST)){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    for($i=1; $i<count($_POST["num"]); $i++){
        $ue = new Element($_POST["num"][$i], $_POST["sem_label"][$i].$_POST["num"][$i],
                $_POST["sigle"][$i], $_POST["categorie"][$i], $_POST["affectation"][$i],
                $_POST["UTT"][$i], $_POST["profil"][$i], $_POST["credits"][$i], $_POST["resultat"][$i]);
        $elmt[] = $ue;
    }
    echo '<pre>';
    print_r($elmt);
    echo '</pre>';
    foreach ($elmt as $value) {
        //faire l'insertion dans la bdd
    }
}
?>