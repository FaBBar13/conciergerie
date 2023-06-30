<?php
// Aymeric : stocke le html ds un buffer et à la fin du code , mettre ob_flush() pour la chasse d'eau du buffer vers la page
// permet d'utilise header(location)
ob_start();

include __DIR__ . '/header.php'; ?>
<div class="container">
    <h1>Tâches à Faire</h1>

    <table class="table table-dark bobor">


        <thead>
            <tr>
                <th> Action </th>
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
        echo "<br>";

        $input_data = [];
        function majFichier()
        {
            global $liste;
            for ($i = 0; $i < count($liste); $i++) {
                $lg = $liste[$i];
                $newcontent .= $lg['check'] . '%' . $lg['date'] . '%' . $lg['heure'] . '%' . $lg['statut'] . '%' . $lg['tache'] . "\n";
            }

            file_put_contents('../data/info.txt', $newcontent);
            header("Location: ./");
            exit;
        }
        //var_dump($liste);
        foreach ($liste as $line => $entry):
            //var_dump($entry);
            //echo "<tr><td><input type='checkbox' " . (!!$entry['check'] ? 'checked' : '') . "></td><td>{$entry['date']}</td><td>{$entry['heure']}</td><td>{$entry['statut']}</td><td>{$entry['tache']}</td></tr>";
        

            // ajouter test sur ligne 0 avec isset et non empty
            // + voir PHP_EOL et ranger le tableau modifié avec $contenu = array_values($contenu);
        

            $chaine_btn = "<form method='post' class='boboy'>
            <input type='hidden' name='line' value='{$line}'>
            <button name='action' type='submit' value='mod' class='btn btn-warning bouton'>Modif.</button>
            <button name='action' type='submit' value='sup' class='btn btn-danger bouton'>Suppr</button>
                </form>";

            echo "<tr><td>" . $chaine_btn . "</td><td>{$entry['date']}</td><td>{$entry['heure']}</td><td>{$entry['statut']}</td><td>{$entry['tache']}</td></tr>";
        endforeach;
        ?>

    </table>


    <?php



    function Suppr($par_numlig)
    {
        echo "suppr. tache N°= " . $par_numlig;
        echo ('<br>');
        global $liste;
        unset($liste[$par_numlig]);
        $liste = array_values($liste);
        majFichier();
        //var_dump($liste);
    }


    if (!empty($_POST['action'])) {

        //var_dump($_POST['action']);
        switch ($_POST['action']) {
            case "edit":
                echo "ajout tache";
                break;
            case "mod":
                echo "modif. tache ";
                break;
            case "sup":
                //echo ($_POST['line']);
                Suppr($_POST['line']);
                break;
            default:
                echo "bizarre...";
        }
    }


    ?>

    <div class="ajout">

        <form method="post">

            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date" maxlength="8" class="form-control"
                    value="<?= $input_data['date'] ?? '' ?>"></input><br />
                <!-- <label for="time"> et l'horloge ???</label> -->
                <input type="time" id="heure" name="time" value="<?= $input_data['heure'] ?? '' ?>"
                    class="form-control"></input><br />
                <input type="text" placeholder="Action..." id="action" name="action" maxlength="20"
                    value="<?= $input_data['tache'] ?? '' ?>" class="form-control"></input><br />
                <?php if (!empty($input_data)) { ?>
                    <input type="hidden" name="line" value="<?= $input_data['line'] ?>">
                    <button class="btn btn-primary" type="submit" name="action" value="edit">Modifier</button>

                <?php } else { ?>
                    <button class="btn btn-success" type="submit" name="action" value="add">Valider</button>
                <?php } ?>

            </div>


        </form>
    </div>
    <?php

    // echo ($_POST['date'] . ' ' . $_POST['heure'] . ' ' . $_POST['action']);
    if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['action'])) {

        $date_sai = $_POST['date'];
        $heure_sai = $_POST['time'];
        $action_sai = $_POST['action'];
        // echo ('VALIDATION');
        // echo "<br>";
        $newcontent = "";
        $liste[] = ['check' => 0, 'date' => $date_sai, 'heure' => $heure_sai, 'statut' => '1', 'tache' => $action_sai];
        //var_dump($liste);
        echo "<br>";

        majFichier();
        // for ($i = 0; $i < count($liste); $i++) {
        //     $lg = $liste[$i];
        //     $newcontent .= $lg['check'] . '%' . $lg['date'] . '%' . $lg['heure'] . '%' . $lg['statut'] . '%' . $lg['tache'] . "\n";
        // }
    
        // file_put_contents('../data/info.txt', $newcontent);
        // header("Location: ./");
        // exit;
    }


    ?>

</div>

<?php

ob_flush();

include __DIR__ . '/footer.php'; ?>