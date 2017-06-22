<?php
require_once 'elmt_formation.php';
require_once 'recup.php';
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 11/06/2017
 * Time: 12:13
 */
function futur_rgmt($tab)
{
    $SE = $NPML = FALSE;
    $message='';
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
            if (($cat == 'TM' && $affectation == 'BR')||($cat == 'TM' && $affectation == 'FCBR')||($cat == 'TM' && $affectation == 'TCBR')) {
                $TMbr+= $cred;
            }
            if (($cat == 'CS' && $affectation == 'BR')||($cat == 'CS' && $affectation == 'FCBR')||($cat == 'CS' && $affectation == 'TCBR')) {
                $CSbr+= $cred;
            }
            if ($cat == 'ST'  && $affectation == 'FCBR') {
                $STfcbr+= $cred;
            }
            if ($cat == 'ST'  && $affectation == 'TCBR') {
                $STtcbr+= $cred;
            }
            if (($cat == 'CT' && $affectation == 'BR')||($cat == 'CT' && $affectation == 'FCBR')||($cat == 'CT' && $affectation == 'TCBR')) {
                $CTbr+= $cred;
            }
            if (($cat == 'EC' && $affectation == 'BR')||($cat == 'EC' && $affectation == 'FCBR')||($cat == 'EC' && $affectation == 'TCBR')) {
                $ECbr+= $cred;
            }
            if (($cat == 'ME' && $affectation == 'BR')||($cat == 'ME' && $affectation == 'FCBR')||($cat == 'ME' && $affectation == 'TCBR')) {
                $MEbr+= $cred;
            }
            if (($cat == 'CS' && $utt =='Y') || ($cat == 'TM' && $utt == 'Y')) {
                $UTTCSTM+= $cred;
            }
            if ($cat == 'SE') {
                $SE = TRUE;
            }
            if ($cat == 'NPML') {
                $NPML = TRUE;
            }
            if (($affectation == 'BR')||($affectation='TCBR')||($affectation='FCBR')) {
                $somme = $somme + $cred;
            }
    }
    if ($NPML) {
//        echo "NPML validé </br></br>";
        $final++;
    } else {
        $message=$message."<li>NPML non validé </li>";
    }
    if ($SE) {
//        echo "SE validé </br></br>";
        $final++;
    } else {
        $message=$message."<li>SE non validé </li>";
    }
    if ($CSTMtcbr >= 42) {
//        echo "Vous avez validé assez de crédits de TM et de CS en TCBR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits de CS et/ou de TM en TCBR </br>
        Il vous manque " . (42 - $CSTMtcbr) . " </br>
        Vous n'en avez que $CSTMtcbr /42 </li>";
    }
    if ($CSTMfcbr >= 18) {
//        echo "Vous avez validé assez de crédits de TM et de CS en FCBR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits de CS et/ou de TM en FCBR </br>
        Il vous manque " . (18 - $CSTMfcbr) . " </br>
        Vous n'en avez que $CSTMfcbr /18 </li>";
    }
    if ($CSbr >= 24) {
//        echo "Vous avez validé assez de crédits de CS en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits CS en BR </br>
        Il vous en manque " . (24 - $CSbr) . " </br>
        Vous n'en avez que $CSbr /24 </li>";
    }
    if ($TMbr >= 24) {
//        echo "Vous avez validé assez de crédits de TM en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits TM en BR </br>
        Il vous en manque " . (24 - $TMbr) . " </br>
        Vous n'en avez que $TMbr /24 </li>";
    }
    if (($CSbr+$TMbr)>=84){
//        echo "Vous avez validé assez de crédits de TM et de CS en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits TM et de CS en BR </br>
        Il vous en manque " . (84 - $TMbr - $CSbr) . " </br>
        Vous n'en avez que $TMbr /24 </li>";
    }
    
    if ($STtcbr >= 30) {
//        echo "Vous avez validé assez de crédits de ST en TCBR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits ST en TCBR </br>
        Il vous en manque " . (30 - $STtcbr) . " </br>
        Vous n'en avez que $STtcbr /30 </li>";
    }
    if ($STfcbr >= 30) {
//        echo "Vous avez validé assez de crédits de ST en FCBR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits ST en FCBR </br>
        Il vous en manque " . (30 - $STfcbr) . " </br>
        Vous n'en avez que $STfcbr /30 </li>";
    }
    if ($ECbr >= 12) {
//        echo "Vous avez validé assez de crédits de EC en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits EC en BR </br>
        Il vous en manque " . (12 - $ECbr) . " </br>
        Vous n'en avez que $ECbr /12 </li>";
    }
    if ($MEbr >= 4) {
//        echo "Vous avez validé assez de crédits de ME en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits ME en BR </br>
        Il vous en manque " . (4 - $MEbr) . " </br>
        Vous n'en avez que $MEbr /4 </li>";
    }
    if ($CTbr >= 4) {
//        echo "Vous avez validé assez de crédits de CT en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits ME en BR </br>
        Il vous en manque " . (4 - $CTbr) . " </br>
        Vous n'en avez que $CTbr /4 </li>";
    }
    if ($MEbr + $CTbr >= 16) {
//        echo "Vous avez validé assez de crédits de CT et de ME en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits ME et/ou de CT en BR </br>
        Il vous en manque " . (16 - $CTbr - $MEbr) . " </br>
        Vous n'en avez que ".$CTbr . $MEbr." /54 </li>";
    }
    if ($UTTCSTM >= 60) {
//        echo "Vous avez validé assez de crédits de CS et de TM à l'UTT en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits CS et/ou de TM à l'UTT en BR </br>
        Il vous en manque " . (60 - $UTTCSTM) . " </br>
        Vous n'en avez que $UTTCSTM /4 </li>";
    }
    if ($somme >= 180) {
//        echo "Vous avez validé assez de crédits </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits </br>
        Il vous en manque " . (180 - $somme) . " </br>
        Vous n'en avez que $somme /180 </li>";
    }
    if ($final == 15) {
        flash( 'status', '<strong>Profil validé</strong>! Tout va bien, ce parcours respecte les règles futures','alert alert-success');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        flash( 'status', '<strong>Profil rejeté!</strong><br/><ul>'.$message.'</ul>','alert alert-danger');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
$tab = recupParours($match['params']['id'], $match['params']['cursus'], $database);
futur_rgmt($tab);