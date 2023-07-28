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
        // echo "<br>";
        // echo ("nb lignes= " . count($liste_taches));
        
        $entries = [];

        foreach ($liste_taches as $entry):
            $entries[(int) $entry['id_tache']] = $entry;
            // type='hidden'
            $chaine_btn = "<form method='post' class='boboy'>
            <input  type='hidden' name='id_tache' value={$entry['id_tache']}>
            <button name='action' type='submit' value='mod' class='btn btn-warning bouton'>Modif.</button>
            <button name='action' type='submit' value='sup' class='btn btn-danger bouton'>Suppr</button>
                </form>";

            echo "<tr><td>" . $chaine_btn . "</td><td>{$entry['date_tache']}</td><td>{$entry['heure_tache']}</td><td>{$entry['statut']}</td><td>{$entry['tache']}</td></tr>";

        endforeach;
        // echo ("ICI");
        // echo ($entry['id_tache']);
        ?>

    </table>


    <?php

    $formdata = [];
    if (!empty($_POST['action'])) {

        switch ($_POST['action']) {
            case "add":
                //echo "ajout tache";
                if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['tache'])) {

                    $req_new = $conn->prepare("
                    INSERT INTO taches (date_tache,heure_tache,statut,tache) " .
                        "VALUES ( :date , :time , 'en cours' , :tache)");
                    $req_new->execute([
                        ':date' => $_POST['date'],
                        ':time' => $_POST['time'],
                        ':tache' => $_POST['tache'],

                    ]);
                    header("Location: ./index.php");
                    exit;
                } else {
                    echo ('MANQUE INFOS');
                }
                ;
                //$req_new = "INSERT INTO taches VALUES ( null,'" . $_POST['date'] . "','" . $_POST['time'] . "' , 'en cours' , " . $_POST['tache'] . ")";
                //echo ($req_new);
    
                break;

            case "update":
                if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['tache']) && !empty($_POST['id_tache'])) {
                    $req_new = $conn->prepare("
                    UPDATE taches SET date_tache = :date ,heure_tache = :time,tache = :tache WHERE id_tache = :id_tache");
                    $req_new->execute([
                        ':date' => $_POST['date'],
                        ':time' => $_POST['time'],
                        ':tache' => $_POST['tache'],
                        ':id_tache' => $_POST['id_tache']

                    ]);
                    header("Location: ./index.php");
                    exit;
                } else {
                    echo ('MANQUE INFOS');
                }
                ;

                break;
            case "mod":

                $formdata = $entries[(int) $_POST['id_tache']];
                $formdata['date_tache'] = formatDateForm($formdata['date_tache']);

                break;
            case "sup":

                //$req_new = "DELETE FROM taches WHERE id_tache = " . $liste_taches[$numlig]["id_tache"];
                $req_new = $conn->prepare("DELETE FROM taches WHERE id_tache = ?");
                $req_new->execute([$_POST['id_tache']]);
                header("Location: ./index.php");
                exit;

        }
    }



    ?>

    <div class="ajout">

        <form method="POST">

            <div class="form-group">
                <input type="date" placeholder="Date" id="date" name="date" class="form-control"
                    value="<?= $formdata['date_tache'] ?? '' ?>"></input><br />
                <input type="time" id="heure" name="time" class="form-control"
                    value="<?= $formdata['heure_tache'] ?? '' ?>"></input><br />
                <input type="text" placeholder="Tache..." id="tache" name="tache"
                    value="<?= $formdata['tache'] ?? '' ?>" class="form-control"></input><br />

                <?php if (isset($formdata['id_tache'])) { ?>
                    <input type="hidden" name="id_tache" value="<?= $formdata['id_tache'] ?>">
                    <button class="btn btn-primary" type="submit" name="action" value="update">Modifier</button>

                <?php } else { ?>
                    <button class="btn btn-success" type="submit" name="action" value="add">Valider</button>
                <?php } ?>

            </div>


        </form>
    </div>
    <?php



    // if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['tache'])) {
    
    //     echo ('action new tache');
    //     //$req_new = "INSERT INTO taches VALUES ( null,'" . $_POST['date'] . "','" . $_POST['time'] . "' , 'en cours' , " . $_POST['tache'] . ")";
    //     //lance_req($req_new);
    // } else {
    //     echo ('MANQUE INFOS');
    // }
    

    // function lance_req($new_req)
    // {
    //     $servername = 'localhost';
    //     $username = 'root';
    //     try {
    //         $conn = new PDO("mysql:host=$servername;dbname=test_fab", $username);
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         echo "connnecté OK";
    
    //         $conn->exec($new_req);
    //         echo ("ordre executé");
    
    //         // relance la page pour MAJ du tableau
    //         header("Location: ./index.php");
    //         exit;
    //     }
    
    //     /* en cas d'erreur de connexion */catch (PDOException $e) {
    //         throw new ErrorException("Horreur : " . $e->getMessage());
    //     }
    //     ;
    //     //$conn = null;
    // }
    
    ?>

</div>

<?php

ob_flush();

include __DIR__ . '/footer.php'; ?>