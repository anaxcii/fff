<?php
include("utils/connectDB.php");
include("parts/header.php");

if (isset($_GET["id"])) {
        $joueurs_id = $_GET["id"];

        $requete = $pdo->prepare("DELETE FROM joueurs WHERE joueurs_id = :joueurs_id");

        $requete->execute([
            "joueurs_id" => $joueurs_id,
        ]);

        header('Location: admin.php');
} else {
        echo "L'identifiant du joueur n'a pas été spécifié.";
}

include("parts/footer.php");
?>
