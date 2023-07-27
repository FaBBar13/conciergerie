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

    </table>


    <?php







    ?>

    <div class="ajout">

        <form method="POST">

            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date" maxlength="8" class="form-control"
                    value="<?= $input_data['date'] ?? '' ?>"></input><br />

                <input type="time" id="heure" name="time" value="<?= $input_data['heure'] ?? '' ?>"
                    class="form-control"></input><br />
                <input type="text" placeholder="Tache..." id="tache" name="tache" maxlength="30"
                    value="<?= $input_data['tache'] ?? '' ?>" class="form-control"></input><br />
                <?php if (!empty($input_data)) { ?>
                    <input type="hidden" name="line" value="<?= $input_data['line'] ?? '' ?>">
                    <button class="btn btn-primary" type="submit" name="action" value="edit">Modifier</button>

                <?php } else { ?>
                    <button class="btn btn-success" type="submit" name="action" value="add">Valider</button>
                <?php } ?>

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