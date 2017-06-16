<?php
require_once 'etudiant.php';
require_once 'elmt_formation.php';
require_once 'database.php';

function saveCSV($tab,$nom){
    $filename = "file_csv/".$nom.".csv";
    if(!file_exists($filename)){
        touch ($filename);
        foreach($tab as $value){
            if($value=== Etudiant){
                $ligne = "ID;";
                $ligne .= $value->getNumero().";";
                file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
                $ligne =  "NO;";
                $ligne .= $value->getNom().";";
                file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
                $ligne = "PR;";
                $ligne .= $value->getPrenom().";";
                file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
                $ligne = "AD;";
                $ligne .= $value->getAdmission().";";
                file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
                $ligne = "FI;";
                $ligne .= $value->getFiliere().";";
                file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
            }if($value=== Element){
                $ligne = "EL;";
                $ligne .= $value->getSem_seq().";";
                $ligne .= $value->getSem_label().$value->getSem_seq().";";
                $ligne .= $value->getSigle().";";
                $ligne .= $value->getCategorie().";";
                $ligne .= $value->getAffecation().";";
                $ligne .= $value->getUtt().";";
                $ligne .= $value->getProfil().";";
                $ligne .= $value->getCredit().";";
                $ligne .= $value->getResultat().";";
                file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
            }
        }
    }/*else{
        $ligne = implode(";",$tab);
        file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
        }*/
}

function readCSV($nom){
        $tableau = array();
        $handle = file_get_contents("file_csv/".$nom);
        $handle = str_replace("\r\n","\n",$handle);
        $handle = str_replace("\r","\n",$handle);
        $handle = explode("\n",$handle);
        foreach ($handle as $line) {
            $line = str_replace("\r","",$line);
            $line = str_replace("\n","",$line);
            $line = explode(';',$line);
            array_push($tableau, $line);
        }
        return($tableau);
    }

function genereOption($tab){
    $line="";
    foreach ($tab as $key=>$value) {
        $line .= "<option value='$value'>$value</option>";
        }  
    return $line;
}

function genereSelect($tab,$name,$id){
    $line = "<select class='form-control' name='$name' id='$id' required>";
    $line .= genereOption($tab);
    $line .= '</select>';
    return $line;
}

function genereSelectMult($tab,$name,$id){
    $line = "<select multiple class='form-control'name='$name' id='$id' required>";
    $line .= genereOption($tab);
    $line .= '</select>';
    return $line;
}


function selectdata ($select,$table,$database){
    $sql = "SELECT `$select` FROM `$table`";
    $res = mysqli_query($database, $sql);
    $resultats=array();
    while ($row = mysqli_fetch_array($res))
    {
        $resultats[] = $row[0];
    }
    return $resultats;
}

function genereRadio($tab, $name){
        $line = "</br>";
        foreach($tab as $value){
                $line .= "$value<input type='radio' name='$name' value='$value'>";
            }
    return $line;
 }

function ligneTab($nom, $tab){
    echo"<tr>
            <td>
                <h1>$nom</h1>
            </td>";
    foreach($tab as $value){
        $semlab = $value->getSem_label();
        $lab = $value->getSigle();
        $r = $value->getResultat();
        $c = $value->getCredit();
        echo"<td>".$semlab."</br>".$lab."</br>".$r."</br>".$c."</td>";
    }
    echo"</tr>";
}