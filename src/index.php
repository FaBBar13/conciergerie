<?php


$title = 'mon titre de malade';

// $data = file_get_contents(__DIR__ . '/../data/info.txt');

// file_put_contents(__DIR__ . '/../data/info.txt', 'fdlfkldfk');

// var_dump($data);

// definition des colonnes du fichier
$liste = [];


$taille_1 = 8;
$taille_2 = 5;
$taille_3 = 30;
$taille_4 = 1;

$tab_date = [];
$tab_heure = [];
$tab_tache = [];
$tab_statut = [];

$source = fopen('../data/info.txt', 'a+');
while (!feof($source)) {
    //echo var_dump($source);
    $date = fread($source, $taille_1);
    $heure = fread($source, $taille_2);
    $tache = fread($source, $taille_3);
    $statut = fread($source, $taille_4);
    $retour_chariot = fread($source, 1); //La fin d'une ligne est marquée par 1 octet de retour chariot

    $tab_date[] = $date;
    $tab_heure[] = $heure;
    $tab_tache[] = $tache;
    $tab_statut[] = $statut;


    //$liste[] = ['Date' => $date, 'heure' => $heure, 'tache' => $tache, 'statut' => $statut];
    //echo "<tr><td>$date</td><td>$heure</td><td>$tache</td><td>$statut</td></tr>";
}
;
fclose($source);
print_r($tab_date[0]);
print_r("<br>");


// infos saisies pour nvelle tache
$date_sai = "";
$heure_sai = "";
$action_sai = "";

// 
function ajoutTache($param1, $param2, $param3)
{
    echo ("ajoutTache" . $param1 . " " . $param2 . " " . $param3);
}
;


include __DIR__ . '/vues/home.php';