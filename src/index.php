<?php

$servername = 'localhost';
$username = 'root';
// $password = 'root';

//On essaye la connexion

try {
    $conn = new PDO("mysql:host=$servername;dbname=test_fab", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connnecté OK";

    $req = $conn->prepare("SELECT id_tache, date_tache, heure, statut, tache FROM taches ORDER BY 1,2,3 ");
    $req->execute();

    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    print_r($resultat);




}
/* prepa requete */


/* en cas d'erreur de connexion */catch (PDOException $e) {
    echo "Horreur : " . $e->getMessage();
}



// par la suite , pour fermer la connexion :
// $conn = null;


include __DIR__ . '/vues/home.php';