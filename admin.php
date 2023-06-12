<?php
include("utils/connectDB.php");
session_start();

if (!array_key_exists("username", $_SESSION)) {
    header("Location: connexion.php");
}
include("parts/header.php");

?>
    <a class="btn btn-success py-0" href="create.php">ADD</a>

    <div class="d-flex flex-wrap">
        <?php
        $requete = $pdo->prepare("SELECT * from joueurs;");
        $requete->execute();

        $joueurs = $requete->fetchAll();
        foreach ($joueurs as $joueur) { ?>

            <div class="col-3 p-2">
                <div class="card text-center">
                    <img class="img-fluid" src="src/img/<?php echo $joueur["image"] ?>">
                    <p><?php echo $joueur["joueurs_nom"] ?></p>
                    <p><?php echo $joueur["joueurs_prenom"]?> </p>
                    <p><?php echo $joueur["joueurs_age"]?> </p>
                    <p><?php echo $joueur["joueurs_poste"]?> </p>
                </div>
                <div class="d-flex justify-content-evenly">
                    <a class="btn btn-warning py-0" href="update.php?id=<?php echo $joueur["joueurs_id"] ?>">Update</a>
                    <a class="btn btn-danger py-0" href="delete.php?id=<?php echo $joueur["joueurs_id"] ?>">Delete</a>
                </div>
            </div>


        <?php } ?>


    </div>

<?php
include("parts/footer.php");