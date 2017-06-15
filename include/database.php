<?php
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 15/06/2017
 * Time: 21:45
 */
define('HOST', 'sql.gmartron.fr');
define('USER', 'wq8z6t_tevi');
define('PASSWORD', 'teviea');
define('NAME', 'wq8z6t_tevi');
$database = mysqli_connect(HOST,USER,PASSWORD,NAME) or
die('Impossible de se connecter à MySQL' + mysqli_connect_error());
?>