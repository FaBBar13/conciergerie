<?php include __DIR__ . '/header.php'; ?>
<div class="container">
    <h1>Tâches à Faire</h1>

    <table class="table table-dark bobor">


        <thead>
            <tr>
                <th> Sel. </th>
                <th> Date </th>
                <th> Heure </th>
                <th> Statut </th>
                <th> Action à réaliser </th>
            </tr>
        </thead>
        <!-- foreach -->
        <?php
        echo "<h3>$info</h3>";
        echo "<br>";
        echo ('nb lignes= ' . count($liste));

        foreach ($liste as $entry):
            echo "<tr><td><input type='checkbox' id='{$entry['check']}'><td><td>{$entry['date']}</td><td>{$entry['heure']}</td><td>{$entry['statut']}</td><td>{$entry['tache']}</td></tr>";
        endforeach; ?>

    </table>

    <div class="d-flex justify-content-around">
        <!-- <button type="button" name="action" value="add" class="btn btn-primary bouton">Ajouter</button> -->
        <button type="button" name="action" value="mod" class="btn btn-primary bouton">Modifier</button>
        <button type="button" name="action" value="sup" class="btn btn-primary bouton">Supprimer</button>
    </div>
    <?php

    // switch ($_POST['action']) {
    //     // case "add":
    //     //     echo "ajout tache";
    //     //     break;
    //     case "mod":
    //         echo "modif. tache ";
    //         break;
    //     case "sup":
    //         echo "suppr. tache";
    //     default:
    //         echo "bizarre...";
    
    // }
    // ;
    ?>

    <div class="ajout">

        <form method="post">

            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date" maxlength="8"
                    class="form-control"></input><br />
                <label for="time"></label>
                <input type="time" id="heure" name="time" class="form-control"></input><br />
                <input type="text" placeholder="Action..." id="action" name="action" maxlength="30"
                    class="form-control"></input><br />
                <button class="btn btn-primary" type="submit">Valider</button>
            </div>


        </form>
    </div>
    <?php

    // echo ($_POST['date'] . ' ' . $_POST['heure'] . ' ' . $_POST['action']);
    
    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['action'])) {
        $date_sai = $_POST['date'];
        $heure_sai = $_POST['heure'];
        $action_sai = $_POST['action'];

        $newcontent = "";

        // echo ($date_sai . ' ' . $heure_sai . ' ' . $action_sai);
        $liste[] = ['check' => 0, 'date' => $date_sai, 'heure' => $heure_sai, 'statut' => 1, 'tache' => $action_sai];
        // var_dump($liste);
        //echo "<br>";
        //echo ('nb lignes= ' . count($liste));
    
        //var_dump($liste);
        //$destination = fopen('../data/info.txt', 'w');
        for ($i = 0; $i < count($liste); $i++) {
            $detail = $liste[$i];


            //fwrite($destination, $detail['check'] . $detail['date'] . $detail['heure'] . $detail['statut'] . $detail['tache'] . "\n");
            $newcontent .= $detail['check'] . $detail['date'] . $detail['heure'] . $detail['statut'] . $detail['tache'] . "\n";
            //print_r($detail['check'] . $detail['date'] . $detail['heure'] . $detail['tache'] . $detail['statut'] . '<br>');
        }
        ;
        var_dump($newcontent);
        //fclose($destination);
        // echo ($newcontent);
        file_put_contents('../data/info.txt', $newcontent);

        //  print_r($liste[0]);
    
    }
    ;

    ?>

</div>

<?php include __DIR__ . '/footer.php'; ?>