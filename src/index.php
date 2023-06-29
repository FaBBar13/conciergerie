<?php


$title = 'mon titre de malade';

// $data = file_get_contents(__DIR__ . '/../data/info.txt');

// file_put_contents(__DIR__ . '/../data/info.txt', 'fdlfkldfk');

// var_dump($data);

// definition des colonnes du fichier
$info = "vide";

$liste = [];

$taille_0 = 1;
$taille_1 = 10;
$taille_2 = 5;
$taille_3 = 1;
$taille_4 = 30;


$source = fopen('../data/info.txt', 'a+');


while (!feof($source)) {
    //echo var_dump($source);
    $check = fread($source, $taille_0);
    $date = fread($source, $taille_1);
    $heure = fread($source, $taille_2);
    $statut = fread($source, $taille_3);
    $tache = fread($source, $taille_4);

    $retour_chariot = fread($source, 1); //La fin d'une ligne est marquée par 1 octet de retour chariot



    // 

    $liste[] = ['check' => $check, 'date' => $date, 'heure' => $heure, 'statut' => $statut, 'tache' => $tache];
    //echo "<tr><td>$date</td><td>$heure</td><td>$tache</td><td>$statut</td></tr>";
}
;
fclose($source);





include __DIR__ . '/vues/home.php';