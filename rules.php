<?php
//ici je considère que je récupère la liste des ue genre comme avec le action_csv
include 'bibliotheque.php';
include 'elmt_formation.php';
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 11/06/2017
 * Time: 12:13
 */
$SE = $NPML = FALSE;
$CSbr = $TMbr = $ECbr = $MEbr = $CTbr = $STtcbr = $STfcbr = $CSTMtcbr = $CSTMfcbr = $UTTCSTM  = 0;
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
        if ($value->getCategorie() == 'ST' && $value->getAffectation() == 'FCBR') {
            $STfcbr ++;
        }
        if ($value->getCategorie() == 'ST' && $value->getAffectation() == 'TCBR') {
            $STtcbr ++;
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
        if($value->getLabel() == 'SE'){
            $SE = TRUE;
        }
        if($value->getLabel() == 'NPML'){
            $NPML = TRUE;
        }
    }
}
?>
</body>

