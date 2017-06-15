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
    $tab = recupParours($_POST["idetu"], $_POST["parcours"], $database);
    $CS = $EC = $HT = $ME = $NPML = $SE = $ST = $TM = array();
    foreach ($tab as $value) {
        switch ($value->getCategorie()) {
            case 'CS':
                $CS[] = $value;
                break;
            case 'EC':
                $EC[] = $value;
                break;
            case 'HT':
                $HT[] = $value;
                break;
            case 'ME':
                $ME[] = $value;
                break;
            case 'NPML':
                $NPML[] = $value;
                break;
            case 'SE':
                $SE[] = $value;
                break;
            case 'ST':
                $ST[] = $value;
                break;
            case 'TM':
                $TM[] = $value;
                break;
        }
    }
}
?>
<table>
    <?php ligneTab('CS', $CS); ?>
    <?php ligneTab('EC', $EC); ?>
    <?php ligneTab('HT', $HT); ?>
    <?php ligneTab('ME', $ME); ?>
    <?php ligneTab('NPML', $NPML); ?>
    <?php ligneTab('SE', $SE); ?>
    <?php ligneTab('ST', $ST); ?>
    <?php ligneTab('TM', $TM); ?>
</table>
<form method="post" action="#">
    <select name="choix">
        <option value="actuel">Réglement actuel</option>
        <option value="futur">Réglement futur</option>
    </select>
</form>
<?php
if (!isset($_POST["choix"])) {
    switch ($_POST["choix"]) {
        case 'actuel' :
            actuel_rgmt($tab);
            break;
        case 'futur' :
            futur_rgmt($tab);
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