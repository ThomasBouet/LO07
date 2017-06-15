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
        <script>
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
        echo "<input type='hidden' value='".$file['name']."' id='hidden'>";
        /*$handle = fopen("file_csv/".$file['name'],'r');
			$data = fgetcsv($handle);
			var_dump($data);*/
        ?>
        </pre>
        <input type='button'  value='FERMER' onclick='deleteCSV(); document.location.href="truc.php"; '>
    </body>
</html>
