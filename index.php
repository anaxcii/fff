<?php
session_start();
include("utils/connectDB.php");
include("utils/functions.php");
include("parts/header.php");
?>

<h1>Notre Equipe</h1>

<div class="d-flex flex-wrap p-3">
    <?php
    // Je prépare ma requete SQL
    $reponse = $pdo->query('SELECT * FROM joueurs');

    // La fonction FETCH renvoie le resultat de la requete sous forme de tableau
    $joueurs = $reponse->fetchAll();



    // Pour chaque NFT que ma renvoyé la requete
    foreach($joueurs as $joueur){
        ?>

        <div class="col-3 p-2">
            <div class="card text-center">
                <img class="img-fluid" src="src/img/<?php echo $joueur["image"] ?>">
                <p><?php echo $joueur["joueurs_nom"] ?></p>
                <p><?php echo $joueur["joueurs_prenom"]?> </p>
                <p><?php echo $joueur["joueurs_age"]?> </p>
                <p><?php echo $joueur["joueurs_poste"]?> </p>
            </div>
        </div>

        <?php
    }
    ?>
</div>


<?php
include("parts/footer.php");
?>
