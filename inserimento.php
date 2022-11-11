<?php

$host =	"127.0.0.1";
$user = "root";
$pwd =	"root";
$db = "edusogno-task";

$connessione = new mysqli ($host,$user,$pwd,$db);

if($connessione === false){
    die("Errore durante la connessione: " . $connessione->connect_error);

}

?>