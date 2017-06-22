<!DOCTYPE html>
<head>
    <script type="text/javascript">
        function deleteCSV() {
            var fname = document.getElementById('hidden').value;
            var http = new XMLHttpRequest();
            var url = "delete_file.php";
            var params = "filename=" + fname;
            http.open("POST", url, true);

            //Send the proper header information along with the request
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function () {//Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    console.log(http.responseText);
                }
            }
            http.send(params);
        }


    </script>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Christine
 * Date: 15/06/2017
 * Time: 23:35
 */
require_once 'bibliotheque.php';
require_once 'recup.php';
require_once 'database.php';

$etuid = $match['params']['id'];
$tab = recupParours($etuid, $match['params']['cursus'], $database);
$r = "SELECT nom,prenom,admission,filiere FROM Etudiant WHERE  IdEtu = " . $etuid;
$result = mysqli_query($database, $r);
$etu = array();
while ($row = mysqli_fetch_array($result)) {
    for ($i = 0; $i < (count($row)) / 2; $i++) {
        $etu[] = $row[$i];
    }
}
$etudiant = new Etudiant($etuid, $etu[0], $etu[1], $etu[2], $etu[3]);
saveCSV($tab, $etudiant, $etuid);
echo "<a href='reglements/" . $etuid . ".csv'><h1>Télécharger le parcours</h1></a>";
echo "<input type='hidden' name='hidden' id='hidden' value='$etuid.csv'>";
?>
<input type='button'  value='RETOUR' onclick='deleteCSV(); document.location.href="../index.php"; '>
</body>
</html>
