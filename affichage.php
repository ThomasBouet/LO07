<html>
<?php
require_once 'include/bibliotheque.php';
require_once 'include/recup.php';
require_once 'include/database.php';
require_once 'include/rgmt_actuel.php';
require_once 'include/rgmt_futur.php';
require_once 'include/elmt_formation.php';
require_once 'layout/header.php';
session_start();
$id = selectdata("IdEtu", "Etudiant", $database);
$numparcours = array();
for ($i = 1; $i < 11; $i++) {
    $numparcours[] = $i;
}
?>
<head></head>
<body>
<form method="post" action="#">
    Etudiant<?php echo genereSelect($id, 'idetu', 'idetu'); ?></br>
    Parcours<?php echo genereSelect($numparcours, 'parcours', 'parcours'); ?></br>
    <input type="submit" value="ENVOYER">
</form>
<?php
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 15/06/2017
 * Time: 16:21
 */
if (!isset($_POST)) {
    $_SESSION["idetu"] = $_POST["idetu"];
    $_SESSION["parcours"] = $_POST["parcours"];
    $_SESSION['tab'] = recupParours($_POST["idetu"], $_POST["parcours"], $database);
    $_SESSION['CS'] = $_SESSION['EC'] = $_SESSION['HT'] = $_SESSION['ME'] = $_SESSION['NPML'] = $_SESSION['SE'] = $_SESSION['ST'] = $_SESSION['TM'] = array();
    foreach ($_SESSION['tab'] as $value) {
        switch ($value->getCategorie()) {
            case 'CS':
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
    if(isset($_SESSION['CS'])&&isset($_SESSION['EC'])&&isset($_SESSION['HT'])&&isset($_SESSION['ME'])&&isset($_SESSION['NPML'])&&isset($_SESSION['SE'])&&isset($_SESSION['ST'])&&isset($_SESSION['TM'])) {
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
<form method="post" action="#">
    <select name="choix">
        <option value="actuel">Réglement actuel</option>
        <option value="futur">Réglement futur</option>
        <input type="submit" value="ENVOYER">
    </select>
</form>
<?php
if (isset($_POST["choix"])) {
    switch ($_POST["choix"]) {
        case 'actuel' :
            actuel_rgmt($_SESSION['tab']);
            break;
        case 'futur' :
            futur_rgmt($_SESSION['tab']);
            break;
    }
}
echo "Voulez-vous supprimer ce parcours ?";
echo "<form methode='post' action='include/cursus_supr.php'> 
                <input type=\"hidden\" name=\"etu\" value=" . $_SESSION["idetu"] . ">
                <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . "> 
                <input type='submit' value='SUPPRIMER'>
                </form>";
echo "Voulez-vous modifier ce parcours ?";
echo "<form methode='post' action='include/cursus_modif.php'> 
                <input type=\"hidden\" name=\"etu\" value=" . $_SESSION["idetu"] . ">
                <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . "> 
                <input type='submit' value='MODIFIER'>
                </form>";
echo "Voulez-vous sauvegarder ce parcours ?";
echo "<form methode='post' action='include/csv_export.php'> 
                <input type=\"hidden\" name=\"etu\" value=" . $_SESSION["idetu"] . ">
                <input type=\"hidden\" name=\"cursus\" value=" . $_SESSION["parcours"] . "> 
                <input type='submit' value='SAUVEGARDER'>
                </form>";
?>
</body>
</html>