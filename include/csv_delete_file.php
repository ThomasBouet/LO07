<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$fname = $_POST['filename'];
echo $fname;
unlink("file_csv/".$fname);
?>