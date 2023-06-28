<?php include __DIR__ . '/header.php'; ?>
<div class="container">
    <h1>Tâches à Faire</h1>

    <table class="table table-dark bobor">


        <thead>
            <tr>
                <th> Date </th>
                <th> Heure </th>
                <th> Action à réaliser </th>
                <th> Statut </th>
            </tr>
        </thead>
        <!-- foreach -->
        <?php

        while (!feof($source)) {
            //echo var_dump($source);
            $date = fread($source, $taille_1);
            $heure = fread($source, $taille_2);
            $tache = fread($source, $taille_3);
            $statut = fread($source, $taille_4);
            $retour_chariot = fread($source, 1); //La fin d'une ligne est marquée par 1 octet de retour chariot
            echo "<tr><td>$date</td><td>$heure</td><td>$tache</td><td>$statut</td></tr>";
        }
        ;
        fclose($source);

        ?>

    </table>

    <div class="d-flex justify-content-around">
        <button type="button" name="action" value="add" class="btn btn-primary bouton">Ajouter</button>
        <button type="button" name="action" value="mod" class="btn btn-primary bouton" disabled>Modifier</button>
        <button type="button" name="action" value="sup" class="btn btn-primary bouton" disabled>Supprimer</button>
    </div>


    <div class="ajout">
        <form method="post">
            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date" maxlength="8"
                    class="form-control"></input><br />
                <input type="text" placeholder="00:00" id="heure" name="heure" maxlength="5"
                    class="form-control"></input><br />
                <input type="text" placeholder="Action..." id="action" name="action" maxlength="30"
                    class="form-control"></input><br />
                <button class="btn btn-primary">Valider</button>
            </div>
        </form>
    </div>
    <?php
    $date_sai = $_POST['date'];
    $heure_sai = $_POST['heure'];
    $action_sai = $_POST['action'];


    ?>

</div>

<?php include __DIR__ . '/footer.php'; ?>