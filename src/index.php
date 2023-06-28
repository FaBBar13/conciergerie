<?php


$title = 'mon titre de malade';

// $data = file_get_contents(__DIR__ . '/../data/info.txt');

// file_put_contents(__DIR__ . '/../data/info.txt', 'fdlfkldfk');

// var_dump($data);

// definition des colonnes du fichier
$taille_1 = 8;
$taille_2 = 5;
$taille_3 = 30;
$taille_4 = 1;

$source = fopen('../data/info.txt', 'a+');

// infos saisies pour nvelle tache
$date_sai = "";
$heure_sai = "";
$action_sai = "";

// 
function ajoutTache()
{
    echo ("ajoutTache");
}
;


include __DIR__ . '/vues/home.php';