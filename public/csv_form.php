<!DOCTYPE html>
<?php require_once 'include/bibliotheque.php'; ?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="../include/csv_action.php" enctype="multipart/form-data">
            
            Fichier : <input type='file' id='csv' name='csv' accept=".csv"> <br/>
            <input type="submit" value="Envoyer">
        </form>
    </body>
</html>
