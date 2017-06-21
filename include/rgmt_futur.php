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
        $cat = $value->getCategorie();
        $affectation = $value->getAffectation();
        $utt = $value->getUTT();
        $cred = $value->getCredit();
            if (($cat == 'CS' && $affectation == 'TCBR') || ($cat == 'TM' && $affectation == 'TCBR')) {
                $CSTMtcbr += $cred;
            }
            if (($cat == 'CS' && $affectation == 'FCBR') || ($cat == 'TM' && $affectation == 'FCBR')) {
                $CSTMfcbr += $cred;
            }
            if ($cat == 'TM'  && $affectation == 'BR') {
                $TMbr+= $cred;
            }
            if ($cat == 'ST'  && $affectation == 'BR') {
                $STfcbr+= $cred;
            }
            if ($cat == 'ST'  && $affectation == 'BR') {
                $STtcbr+= $cred;
            }
            if ($cat == 'HT'  && $affectation == 'BR') {
                $CTbr+= $cred;
            }
            if ($cat == 'EC' && $affectation == 'BR') {
                $ECbr+= $cred;
            }
            if ($cat == 'ME' && $affectation == 'BR') {
                $MEbr+= $cred;
            }
            if (($value->getCategorie == 'CS' && $utt) || ($value->getCategorie == 'TM' && $utt)) {
                $UTTCSTM+= $cred;
            }
            if ($cat == 'SE') {
                $SE = TRUE;
            }
            if ($cat == 'NPML') {
                $NPML = TRUE;
            }
            if ($affectation == 'BR') {
                $somme = $somme + $cred;
            }
    }
    if ($NPML) {
        echo "NPML validé </br></br>";
        $final++;
    } else {
        echo "NPML non validé </br></br>";
    }
    if ($SE) {
        echo "SE validé </br></br>";
        $final++;
    } else {
        echo "SE non validé </br></br>";
    }
    if ($CSTMtcbr >= 42) {
        echo "Vous avez validé assez de crédits de TM en TCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits de CS et/ou de TM en TCBR </br>
        Il vous manque " . (42 - $CSTMtcbr) . " </br>
        Vous n'en avez que $CSTMtcbr /42 </br></br>";
    }
    if ($CSTMfcbr >= 18) {
        echo "Vous avez validé assez de crédits de TM en FCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits de CS et/ou de TM en FCBR </br>
        Il vous manque " . (18 - $CSTMfcbr) . " </br>
        Vous n'en avez que $CSTMfcbr /18 </br></br>";
    }
    if ($CSbr >= 24) {
        echo "Vous avez validé assez de crédits de CS en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits CS en BR </br>
        Il vous en manque " . (24 - $CSbr) . " </br>
        Vous n'en avez que $CSbr /24 </br></br>";
    }
    if ($TMbr >= 24) {
        echo "Vous avez validé assez de crédits de TM en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits TM en BR </br>
        Il vous en manque " . (24 - $TMbr) . " </br>
        Vous n'en avez que $TMbr /24 </br></br>";
    }
    if ($STtcbr >= 30) {
        echo "Vous avez validé assez de crédits de ST en TCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ST en TCBR </br>
        Il vous en manque " . (30 - $STtcbr) . " </br>
        Vous n'en avez que $STtcbr /30 </br></br>";
    }
    if ($STfcbr >= 30) {
        echo "Vous avez validé assez de crédits de ST en FCBR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ST en FCBR </br>
        Il vous en manque " . (30 - $STfcbr) . " </br>
        Vous n'en avez que $STfcbr /30 </br></br>";
    }
    if ($ECbr >= 12) {
        echo "Vous avez validé assez de crédits de EC en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits EC en BR </br>
        Il vous en manque " . (12 - $ECbr) . " </br>
        Vous n'en avez que $ECbr /12 </br></br>";
    }
    if ($MEbr >= 4) {
        echo "Vous avez validé assez de crédits de ME en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ME en BR </br>
        Il vous en manque " . (4 - $MEbr) . " </br>
        Vous n'en avez que $MEbr /4 </br></br>";
    }
    if ($CTbr >= 4) {
        echo "Vous avez validé assez de crédits de CT en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ME en BR </br>
        Il vous en manque " . (4 - $CTbr) . " </br>
        Vous n'en avez que $CTbr /4 </br></br>";
    }
    if ($MEbr + $CTbr >= 16) {
        echo "Vous avez validé assez de crédits de CT et de ME en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits ME et/ou de CT en BR </br>
        Il vous en manque " . (16 - $CTbr - $MEbr) . " </br>
        Vous n'en avez que ".$CTbr + $MEbr." /54 </br></br>";
    }
    if ($UTTCSTM >= 60) {
        echo "Vous avez validé assez de crédits de CS et de TM à l'UTT en BR </br>";
        $final++;
    } else {
        echo "Vous n'avez pas validé assez de crédits CS et/ou de TM à l'UTT en BR </br>
        Il vous en manque " . (60 - $UTTCSTM) . " </br>
        Vous n'en avez que $UTTCSTM /4 </br></br>";
    }
    if ($somme >= 180) {
        echo "Vous avez validé assez de crédits </br>";
    } else {
        echo "Vous n'avez pas validé assez de crédits </br>
        Il vous en manque " . (180 - $somme) . " </br>
        Vous n'en avez que $somme /180 </br></br>";
    }
    if ($final == 15) {
        echo "<h1>PROFIL VALIDE</h1> </br>";
    } else {
        echo "<h1>PROFIL REJETE</h1> </br>";
    }
}
?>
</body>

