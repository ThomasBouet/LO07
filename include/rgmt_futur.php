<?php
require_once 'elmt_formation.php';
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 11/06/2017
 * Time: 12:13
 */
function futur_rgmt($tab)
{
    $SE = $NPML = FALSE;
    $CSbr = $TMbr = $ECbr = $MEbr = $CTbr = $STtcbr = $STfcbr = $CSTMtcbr = $CSTMfcbr = $UTTCSTM = $final = $somme = 0;
    foreach ($tab as $value) {
        if ($value === Element) {
            if ($value->getCategorie() == 'CS' && $value->getAffectation() == 'TCBR' || $value->getCategorie() == 'TM' && $value->getAffectation() == 'TCBR') {
                $CSTMtcbr++;
            }
            if ($value->getCategorie() == 'CS' && $value->getAffectation() == 'FCBR' || $value->getCategorie() == 'TM' && $value->getAffectation() == 'FCBR') {
                $CSTMfcbr++;
            }
            if ($value->getCategorie() == 'TM') {
                $TMbr++;
            }
            if ($value->getCategorie() == 'ST') {
                $STfcbr++;
            }
            if ($value->getCategorie() == 'ST') {
                $STtcbr++;
            }
            if ($value->getCategorie() == 'HT') {
                $CTbr++;
            }
            if ($value->getCategorie() == 'EC') {
                $ECbr++;
            }
            if ($value->getCategorie() == 'ME') {
                $MEbr++;
            }
            if ($value->getCategorie == 'CS' && $value->getUtt() || $value->getCategorie == 'TM' && $value->getUtt()) {
                $UTTCSTM++;
            }
            if ($value->getCategorie() == 'SE') {
                $SE = TRUE;
            }
            if ($value->getCategorie() == 'NPML') {
                $NPML = TRUE;
            }
            if ($value->getAffectation() == 'BR') {
                $somme = $somme + $value->getCredit();
            }
        }
    }
    if ($NPML) {
        echo "NPML validé </br>";
        $final++;
    } else {
        echo "NPML non validé </br>";
    }
    if ($SE) {
        echo "SE validé </br>";
        $final++;
    } else {
        echo "SE non validé </br>";
    }
    if ($CSTMtcbr >= 42) {
        echo "Vous avez validé assez de crédits de TM en TCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits de CS et/ou de TM en TCBR </br>
        Il vous manque " . (42 - $CSTMtcbr) . " crédits </br>";
    }
    if ($CSTMfcbr >= 18) {
        echo "Vous avez validé assez de crédits de TM en FCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits de CS et/ou de TM en FCBR </br>
        Il vous manque " . (18 - $CSTMfcbr) . " crédits </br>";
    }
    if ($CSbr >= 24) {
        echo "Vous avez validé assez de crédits de CS en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits CS en BR </br>
        Il vous en manque " . (24 - $CSbr) . "</br>";
    }
    if ($TMbr >= 24) {
        echo "Vous avez validé assez de crédits de TM en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits TM en BR </br>
        Il vous en manque " . (24 - $TMbr) . "</br>";
    }
    if ($STtcbr >= 30) {
        echo "Vous avez validé assez de crédits de ST en TCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ST en TCBR </br>
        Il vous en manque " . (30 - $STtcbr) . "</br>";
    }
    if ($STfcbr >= 30) {
        echo "Vous avez validé assez de crédits de ST en FCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ST en FCBR </br>
        Il vous en manque " . (30 - $STfcbr) . "</br>";
    }
    if ($ECbr >= 12) {
        echo "Vous avez validé assez de crédits de EC en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits EC en BR </br>
        Il vous en manque " . (12 - $ECbr) . "</br>";
    }
    if ($MEbr >= 4) {
        echo "Vous avez validé assez de crédits de ME en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ME en BR </br>
        Il vous en manque " . (4 - $MEbr) . "</br>";
    }
    if ($CTbr >= 4) {
        echo "Vous avez validé assez de crédits de CT en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ME en BR </br>
        Il vous en manque " . (4 - $CTbr) . "</br>";
    }
    if ($MEbr + $CTbr >= 16) {
        echo "Vous avez validé assez de crédits de CT et de ME en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ME et/ou de CT en BR </br>
        Il vous en manque " . (16 - $CTbr - $MEbr) . "</br>";
    }
    if ($UTTCSTM >= 60) {
        echo "Vous avez validé assez de crédits de CS et de TM à l'UTT en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits CS et/ou de TM à l'UTT en BR </br>
        Il vous en manque " . (60 - $UTTCSTM) . "</br>";
    }
    if ($somme >= 180) {
        echo "Vous avez validé assez de crédits </br>";
    } else {
        echo "Vous n'avez pas validé assez de crédits </br>
        Il vous en manque " . (180 - $somme) . "</br>";
    }
    if ($final == 15) {
        echo "<h1>PROFIL VALIDE</h1> </br>";
    } else {
        echo "<h1>PROFIL REJETE</h1> </br>";
    }
}
?>
</body>

