<?php
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 16/06/2017
 * Time: 15:10
 */
require_once 'rgmt_actuel.php';
require_once 'rgmt_futur.php';
require_once 'recup.php';
$tab = recupParours($_POST["etu"], $_POST["cursus"], $database);
if (isset($_POST["choix"])) {
    switch ($_POST["choix"]) {
        case 'actuel' :
            actuel_rgmt($tab);
            break;
        case 'futur' :
            futur_rgmt($tab);
            break;
    }
}
?>