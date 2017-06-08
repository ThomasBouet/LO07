<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('NAME', 'lo07_projet');
$database = mysqli_connect(HOST,USER,PASSWORD,NAME) or 
        die('Impossible de se connecter à MySQL' + mysqli_connect_error());
?>
