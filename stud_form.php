<html>
    <head>
        <script>
            function verification()
            {
                var num = document.getElementById('numero').value;
                var nom = document.getElementById('nom').value;
                var prenom = document.getElementById('prenom').value;
                //num = Integer.parseInt(num);
                if(!(/^\d+$/.test(num))){
                    alert('Veuillez entrer un numéro');
                }
                if(num.length != 5){
                    alert('Veuillez entrer un numéro ayant le bon format : 5 chiffres');
                }
                if(!nom.match(/^\w[^0-9]+$/)){
                    alert("Veuillez entrer un nom sans chiffres et sans carctère spéciaux");
                }
                if(!prenom.match(/^\w[^0-9]+$/));
                    alert("Veuillez entrer un prenom sans chiffres et sans carctère spéciaux");
            }
        </script>
    </head>
<?php
session_start();
include_once('database.php');
include_once('bibliotheque.php');
include_once ('etudiant.php');
$filiere = selectdata("Idfil","Filiere",$database);
$admission = array('TC','BR');
?>
<form method="POST" action="stud_action.php">
         <fieldset>
             Numéro étudiant <input type="text" name="IdEtu" id="numero"> </br>
             Nom <input type="text" name="nom" id="nom"> </br>
             Prenom <input type="text" name="prenom" id="prenom"> </br>
             Admission <?php echo(genereSelect($admission,'admission','adm'));?> </br>
             Filière <?php echo(genereSelect($filiere,'filiere','filiere'));?> </br>
         </fieldset>
     <input type="submit" value="Envoyer" onclick="verification();">
</form>
<?php
if(!isset($_POST)){
    var_dump($_POST);
    $etu = new Etudiant($_POST[0],$_POST[1],$_POST[2],$_POST[3],$_POST[4]);
    var_dump($etu);
    $_SESSION["etu"] = $etu;
    
}
?>
</html>