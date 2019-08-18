
<?php
session_start();
$host = 'ensembldb.ensembl.org';
$user = 'anonymous';
$pass = '';
$dbName = '';
$port = '5306';
// Opens a connection to a MySQL server.
$connection=mysqli_connect ($host, $user, $pass, $dbName);
if (!$connection) {
    die('Not connected : ' . mysqli_connect_error());
}
?>