<html>
    <?php
    include 'include/bibliotheque.php';
    include 'include/recup.php';
    include 'include/database.php';
    $id = selectdata("IdEtu","Etudiant",$database);
    $numparcours = array();
    for($i=1; $i<11; $i++){
        $numparcours[]=$i;
    }
    ?>
    <head></head>
    <body>
    <form method="post" action="#">
        Etudiant<?php genereSelect($id,'idetu','idetu');?></br>
        Parcours<?php genereSelect($numparcours,'parcours','parcours');?></br>
    </form>
    <?php
    /**
    * Created by PhpStorm.
    * User: Christine
    * Date: 15/06/2017
    * Time: 16:21
    */
    $tab = recupParours($_POST["idetu"],$_POST["parcours"],$database);
    $CS = $EC = $HT = $ME = $NPML = $SE = $ST = $TM = array();
    foreach($tab as $value){
        switch ($value->getCategorie()){
            case 'CS': $CS[] = $value; break;
            case 'EC': $EC[] = $value; break;
            case 'HT': $HT[] = $value; break;
            case 'ME': $ME[] = $value; break;
            case 'NPML': $NPML[] = $value; break;
            case 'SE': $SE[] = $value; break;
            case 'ST': $ST[] = $value; break;
            case 'TM': $TM[] = $value; break;
        }
    }
    ?>
    
    </body>
</html>