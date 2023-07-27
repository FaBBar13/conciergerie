<?php
// Aymeric : stocke le html ds un buffer et à la fin du code , mettre ob_flush() pour la chasse d'eau du buffer vers la page
// permet d'utilise header(location) librement
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
        <!-- afficher la liste -->

        <?php 
        echo "<br>";
        echo ('nb lignes= ' . count($liste_taches));

        foreach ($liste_taches as $entry):
            
            $chaine_btn = "<form method='post' class='boboy'>
            <input  type='hidden' name='line' value='{$id_tache}'>
            <button name='action' type='submit' value='mod' class='btn btn-warning bouton'>Modif.</button>
            <button name='action' type='submit' value='sup' class='btn btn-danger bouton'>Suppr</button>
                </form>";

            echo "<tr><td>" . $chaine_btn . "</td><td>{$entry['date_tache']}</td><td>{$entry['heure_tache']}</td><td>{$entry['statut']}</td><td>{$entry['tache']}</td></tr>";

        endforeach;
        echo ($id_tache);
        ?>

    </table>


    <?php

if (!empty($_POST['action'])) {

//    $numlig = $_POST['line'];
    switch ($_POST['action']) {
        case "add":
            echo "ajout tache";
            
            break;
        case "mod":
            echo "modif. tache". $_POST['$id_tache'] . "<br> ";
            
            break;
        case "sup":
            //Suppr($numlig);
            echo "suppr. tache". $id_tache . "<br> ";
            break;
        default:
            echo "bizarre...";
    }
}



    ?>

    <div class="ajout">

        <form method="POST">

            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date" maxlength="8" class="form-control"></input><br />
                <input type="time" id="heure" name="time" class="form-control"></input><br />
                <input type="text" placeholder="Tache..." id="tache" name="tache" maxlength="30" class="form-control"></input><br />
                <button class="btn btn-success" type="submit" name="action" value="add">Valider</button>
            </div>


        </form>
    </div>
    <?php

    // echo ($_POST['date'] . ' ' . $_POST['heure'] . ' ' . $_POST['action']);
    

    ?>

</div>

<?php

ob_flush();

include __DIR__ . '/footer.php'; ?>