<?php
require_once 'elmt_formation.php';
require_once 'recup.php';
/*
 * Created by PhpStorm.
 * User: Christine
 * Date: 11/06/2017
 * Time: 12:13
*/
function actuel_rgmt($tab)
{
    $SE = $NPML = FALSE;
    $message='';
    $CSbr = $TMbr = $ECbr = $MEbr = $CTbr = $STtcbr = $STfcbr = $CSTMtcbr = $CSTMfcbr = $UTTCSTM = $final = 0;
    foreach ($tab as $value) {
        $cat = $value->getCategorie();
        $affectation = $value->getAffectation();
        $utt = $value->getUTT();
        $credit = $value->getCredit();
        if (($cat == 'CS' && $affectation == 'TCBR') || ($cat == 'TM' && $affectation == 'TCBR')) {
            $CSTMtcbr += $credit;
        }
        if (($cat == 'CS' && $affectation == 'FCBR') || ($cat == 'TM' && $affectation == 'FCBR')) {
            $CSTMfcbr += $credit;
        }
        if (($cat == 'CS' && $affectation == 'TCBR')||($cat == 'CS' && $affectation == 'FCBR')||($cat == 'CS' && $affectation == 'BR')){
            $CSbr += $credit;
        }
        if (($cat == 'TM' && $affectation == 'TCBR')||($cat == 'TM' && $affectation == 'FCBR')||($cat == 'TM' && $affectation == 'BR')){
            $TMbr += $credit;
        }
        if ($cat == 'ST' && $affectation == 'FCBR') {
            $STfcbr += $credit;
        }
        if ($cat == 'ST' && $affectation == 'TCBR') {
            $STtcbr += $credit;
        }
        if (($cat == 'CT' && $affectation == 'BR')||($cat == 'CT' && $affectation == 'FCBR')||($cat == 'CT' && $affectation == 'TCBR')) {
            $CTbr += $credit;
        }
        if (($cat == 'EC' && $affectation == 'BR')||($cat == 'EC' && $affectation == 'FCBR')||($cat == 'EC' && $affectation == 'TCBR')) {
            $ECbr += $credit;
        }
        if (($cat == 'ME' && $affectation == 'BR')||($cat == 'ME' && $affectation == 'FCBR')||($cat == 'TM' && $affectation == 'TCBR')) {
            $MEbr += $credit;
        }
        if (($cat == 'CS' && $utt =='Y') || ($cat == 'TM' && $utt == 'Y')) {
            $UTTCSTM += $credit;
        }
        if ($cat == 'SE') {
            $SE = TRUE;
        }
        if ($cat == 'NPML') {
            $NPML = TRUE;
        }


    }
    if ($NPML) {
//        echo "NPML validé </br></br>";
        $final++;
    } else {
        $message=$message."<li>NPML non validé</li>";
    }
    if ($SE) {
//        echo "SE validé </br></br>";
        $final++;
    } else {
        $message=$message."<li>SE non validé </li>";
    }
    if ($CSTMtcbr >= 54) {
//        echo "Vous avez validé assez de crédits de TM en TCBR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits de CS et/ou de TM en TCBR. <br/>
        Il vous manque " . (54 - $CSTMtcbr) . " <br/>
        Vous n'en avez que $CSTMtcbr /54 </li>";
    }
    if ($CSTMfcbr >= 30) {
//        echo "Vous avez validé assez de crédits de TM en FCBR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits de CS et/ou de TM en FCBR <br/>
        Il vous manque " . (30 - $CSTMfcbr) . " <br/>
        Vous n'en avez que $CSTMfcbr /30 </li>";
    }
    if ($CSbr >= 30) {
//        echo "Vous avez validé assez de crédits de CS en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits CS en BR <br/>
        Il vous en manque " . (30 - $CSbr) . " <br/>
        Vous n'en avez que $CSbr /30 </li>";
    }


    if ($TMbr >= 30) {
//        echo "Vous avez validé assez de crédits de TM en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits TM en BR </br>
        Il vous en manque " . (30 - $TMbr) . " </br>
        Vous n'en avez que $TMbr /30 </li>";
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
         Vous n'en avez que $CTbr /30 </li>";
    }
    if ($MEbr + $CTbr >= 16) {
//        echo "Vous avez validé assez de crédits de CT et de ME en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits ME et/ou de CT en BR </br>
        Il vous en manque " . (16 - $CTbr - $MEbr) . " </br>
         Vous n'en avez que $CTbr /16 </li>";
    }
    if ($UTTCSTM >= 60) {
//        echo "Vous avez validé assez de crédits de CS et de TM à l'UTT en BR </br>";
        $final++;
    } else {
        $message=$message."<li>Vous n'avez pas validé assez de crédits CS et/ou de TM à l'UTT en BR </br>
        Il vous en manque " . (60 - $UTTCSTM) . "</br>
         Vous n'en avez que $UTTCSTM /60 </li>";
    }
    if ($final == 13) {
        flash( 'status', '<strong>Profil validé</strong>! Tout va bien, ce parcours respecte les règles actuelles','alert alert-success');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        flash( 'status', '<strong>Profil rejeté!</strong><br/><ul>'.$message.'</ul>','alert alert-danger');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
$tab = recupParours($match['params']['id'], $match['params']['cursus'], $database);
actuel_rgmt($tab);