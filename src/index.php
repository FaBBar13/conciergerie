<?php

$servername = 'localhost';
$username = 'root';
// $password = 'root';

//On essaye la connexion

$id_tache = '';
$date_tache = '';
$heure_tache = '';
$statut = '';
$tache = '';

$req_new = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=test_fab", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "connnecté OK";

    $req = $conn->prepare("SELECT id_tache, DATE_FORMAT(date_tache,'%d/%m/%Y') date_tache, DATE_FORMAT(heure_tache,'%H:%i') heure_tache, statut, tache FROM taches ORDER BY id_tache ");
    $req->execute();

    $liste_taches = $req->fetchAll(PDO::FETCH_ASSOC);
    //print_r($liste_taches);

}

/* en cas d'erreur de connexion */catch (PDOException $e) {
    throw new ErrorException("Horreur : " . $e->getMessage());
}



function formatDateForm($date)
{
    return date_create_from_format('d/m/Y', $date)->format('Y-m-d');
}


// par la suite , pour fermer la connexion :
// $conn = null;


include __DIR__ . '/vues/home.php';