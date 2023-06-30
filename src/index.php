<?php


$title = 'mon titre de malade';

$info = "vide";



$liste = [];

$source = file_get_contents('../data/info.txt');

// var_dump($source);
// echo ("<br>");
$lignes = explode("\n", $source);
// var_dump($ligne);
// echo ("<br>");

for ($z = 0; $z < count($lignes) - 1; $z++) {
    if (empty($lignes[$z])) {
        continue;
    }
    $detail = explode("%", $lignes[$z]);
    $liste[] = [
        'check' => $detail[0],
        'date' => $detail[1],
        'heure' => $detail[2],
        'statut' => $detail[3],
        'tache' => $detail[4]
    ];
}



include __DIR__ . '/vues/home.php';