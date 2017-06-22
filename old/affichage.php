<html>
<?php
session_start();
require_once 'include/bibliotheque.php';
require_once 'include/recup.php';
require_once 'include/database.php';
require_once 'include/rgmt_actuel.php';
require_once 'include/rgmt_futur.php';
require_once 'include/elmt_formation.php';
//require_once 'layout/header.php';

$id = selectdata("IdEtu", "Etudiant", $database);
echo("<form method='post' action='affichage.php'>");
echo genereSelect($id, 'idetu', 'idetu');
echo("<input type=\"submit\" value=\"ENVOYER\">");
echo("</br>");

if (isset($_POST['idetu'])) {
    $etu = $_POST['idetu'];
    $sql = "SELECT DISTINCT `IdParcours` FROM `ElemForm` WHERE IdEleve = '$etu'";
    $res = mysqli_query($database, $sql);
    $resultats = array();
    while ($row = mysqli_fetch_array($res)) {
        $resultats[] = $row[0];
    }
    echo("<form method='post' action='affichage.php'>");
    $line = "<select class='form-control' name='parcours' id='parcours'>";
    $line .= genereOption($resultats);
    $line .= '</select>';
    echo $line;
    echo("<input type=\"submit\" value=\"ENVOYER\">");

}


//?>
<!--<body>-->
<!--<form method="post" action="#">-->
<!--    Etudiant--><?php //echo genereSelect($id, 'idetu', 'idetu'); ?><!--</br>-->
<!--    Parcours--><?php //echo genereSelect($numparcours, 'parcours', 'parcours'); ?><!--</br>-->
<!--    <input type="submit" value="ENVOYER">-->
<!--</form>-->
<?php

if (isset($_POST['parcours'])) {
    $_SESSION["idetu"] = $_POST["idetu"];
    $_SESSION["parcours"] = $_POST["parcours"];
    $_SESSION['tab'] = recupParours($_POST["idetu"], $_POST["parcours"], $database);
    $_SESSION['CS'] = $_SESSION['EC'] = $_SESSION['HT'] = $_SESSION['ME'] = $_SESSION['NPML'] = $_SESSION['SE'] = $_SESSION['ST'] = $_SESSION['TM'] = array();
    foreach ($_SESSION['tab'] as $value) {
        switch ($value->getCategorie()) {
            case "CS":
                $_SESSION['CS'][] = $value;
                break;
            case 'EC':
                $_SESSION['EC'][] = $value;
                break;
            case 'HT':
                $_SESSION['HT'][] = $value;
                break;
            case 'ME':
                $_SESSION['ME'][] = $value;
                break;
            case 'NPML':
                $_SESSION['NPML'][] = $value;
                break;
            case 'SE':
                $_SESSION['SE'][] = $value;
                break;
            case 'ST':
                $_SESSION['ST'][] = $value;
                break;
            case 'TM':
                $_SESSION['TM'][] = $value;
                break;
        }
    }
}
?>
<table>
    <?php
    if (!empty($_POST)) {
        ligneTab('CS', $_SESSION['CS']);
        ligneTab('EC', $_SESSION['EC']);
        ligneTab('HT', $_SESSION['HT']);
        ligneTab('ME', $_SESSION['ME']);
        ligneTab('NPML', $_SESSION['NPML']);
        ligneTab('SE', $_SESSION['SE']);
        ligneTab('ST', $_SESSION['ST']);
        ligneTab('TM', $_SESSION['TM']);
    }
    ?>
</table>
<form method="post" action="../include/rgmt_action.php">
    <select name="choix">
        <option value="actuel">Réglement actuel</option>
        <option value="futur">Réglement futur</option>
        <?php
        echo "<input type=\"hidden\" name=\"etu\" value=" . $_SESSION["idetu"] . ">
        <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . ">";
        ?>
        <input type="submit" value="ENVOYER">
    </select>
</form>
<?php
if (!empty($_SESSION)) {
    echo "Voulez-vous supprimer ce parcours ?";
    echo " value=\"" . $_SESSION["idetu"] . ">
                <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . "> 
                <input type='submit' value='SUPPRIMER'>
                </form>";
    echo "Voulez-vous modifier ce parcours ?";
    echo " value=\"" . $_SESSION["idetu"] . ">
                <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . "> 
                <input type='submit' value='MODIFIER'>
                </form>";
    echo "Voulez-vous sauvegarder ce parcours ?";
    echo " value=\"" . $_SESSION["idetu"] . ">
                <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . "> 
                <input type='submit' value='SAUVEGARDER'>
                </form>";

    echo "Voulez-vous dupliquer ce parcours ?";
    echo " value=\"" . $_SESSION["idetu"] . ">
                <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . "> 
                <input type='submit' value='DUPLIQUER'>
                </form>";
}

?>
</body>
</html>