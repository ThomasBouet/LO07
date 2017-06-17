<!DOCTYPE html>
<?php 
    require_once 'bibliotheque.php';
    require_once 'etudiant.php';
    require_once 'elmt_formation.php';
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
        function deleteCSV(){
            var fname = document.getElementById('hidden').value;
            var http = new XMLHttpRequest();
            var url = "delete_file.php";
            var params = "filename="+fname;
            http.open("POST", url, true);

            //Send the proper header information along with the request
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    console.log(http.responseText);
                }
            }
            http.send(params);
        }
        
        
        
        </script>
    </head>
    <body>
        <pre>
        <?php
        // put your code here
        if(!is_dir("file_csv/")) mkdir("./file_csv/");
        //var_dump($_FILES);
        $file = $_FILES['csv'];
        print_r($file);
        //echo $file['name'];
        $t = explode('.', $file['name']);
        //var_dump($t);
        if($t[1]=='csv'){
                $tab_ue = array();
                echo " Ceci est un fichier .csv ! Hourra !";
                $fichier = basename($file['name']);
                if(move_uploaded_file($file['tmp_name'], "file_csv/".$fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    echo '<br/>Upload effectuée avec succès !<br/>';
                    $etu = new Etudiant("","","","","");
                    foreach(readCSV($file['name']) as $ligne){
                        switch($ligne[0]){
                            case 'ID' : 
                                $etu->setNumero($ligne[1]);
                                break;
                            case 'NO' :
                                $etu->setNom($ligne[1]);
                                break; 
                            case 'PR' :
                                $etu->setPrenom($ligne[1]);
                                break;
                            case 'AD' :
                                $etu->setAdmission($ligne[1]);
                                break;
                            case 'FI' :
                                $etu->setFiliere($ligne[1]);
                                break;
                            case 'EL' :
                                $ue = new Element("","","","","","","","","");
                                $ue->setSem_seq($ligne[1]);
                                $ue->setSem_label($ligne[2]);
                                $ue->setSigle($ligne[3]);
                                $ue->setCategorie($ligne[4]);
                                $ue->setAffectation($ligne[5]);
                                $ue->setUtt($ligne[6]);
                                $ue->setProfil($ligne[7]);
                                $ue->setCredit($ligne[8]);
                                $ue->setResultat($ligne[9]);
                                $tab_ue[] = $ue;
                                break;
                        }
                    }
                }else{
                    echo '<br/>Uploade non effectuée !<br/>';
                }
        }else{
            echo "Ceci n'est pas un fichier .csv ! C'est un fichier .$t[1] ";
        }
        var_dump($etu);
        var_dump($tab_ue);
        echo "<input type='hidden' value='".$file['name'].".csv' id='hidden'>";

        var_dump("$etu->numero");

        // ===========================ENTRER TOUT ÇA DANS LA BDD !!!======================//

        //==== ETU======//
        $IdEtu=$etu->numero;
        $nom=$etu->nom;
        $prenom=$etu->prenom;
        $admission=$etu->admission;
        $filiere=$etu->filiere;
        $requete="INSERT INTO `Etudiant` VALUES ('$IdEtu','$nom','$prenom','$admission','$filiere')";
        $resultat=mysqli_query($database,$requete);
        if ($resultat){
            echo("oui");
        }
        else {
            echo ("non");
            mysqli_error($database);
        }

        //=================UE==============//
        for ($i = 0; $i < count($tab_ue); $i++) {
            $sigle = $tab_ue[$i]->sigle;
            $categorie = $tab_ue[$i]->categorie;
            $affectation = $tab_ue[$i]->affectation;
            $credits = $tab_ue[$i]->credit;
            $desc='';
            $requete = "INSERT INTO `Ue` VALUES ('$sigle','$desc','$credits','$affectation','$categorie')";
            $resultat = mysqli_query($database, $requete);
            if ($resultat) {
                echo("oui");
            } else {
                echo("erreur");
                mysqli_error($database);
            }
        }


        //===== PARCOURS=====//


        $sql="SELECT MAX(IdParcours) FROM ElemForm";
        $resu = mysqli_query($database, $sql);
        $parcourstab = mysqli_fetch_array($resu);
        $parcours= $parcourstab[0]+1;

        var_dump(count($tab_ue));

       for ($i = 0; $i < count($tab_ue); $i++) {
            $ue = $tab_ue["$i"]->sigle;
            $num = $tab_ue[$i]->sem_seq;
            $sem = $tab_ue[$i]->sem_label;
            $profil = $tab_ue[$i]->profil;
            $utt = $tab_ue[$i]->utt;
            $res = $tab_ue[$i]->resultat;
            if ($res=='F' or $res=="ABS"){
                $credits=0;
            }
            else {
                $sql="SELECT credit FROM Ue Where IdUe='$ue'";
                $resu = mysqli_query($database, $sql);
                $credits = mysqli_fetch_array($resu);

            }


            $requete = "INSERT INTO `ElemForm` VALUES ('$IdEtu','$num','$sem','$ue','$utt','$profil','$credits[0]','$res','$parcours')";
            var_dump($credits);
echo("</br>");
var_dump($requete);
echo("</br>");
            $resultat = mysqli_query($database, $requete);
            if ($resultat) {
                echo("parcours enregistre sur $parcours");
            } else {
                echo("erreur");
                mysqli_error($database);
            }
        }





        //============================VOILA=================================================//
        ?>
        </pre>
        <input type='button'  value='FERMER' onclick='deleteCSV(); document.location.href="../index.php"; '>
    </body>
</html>
