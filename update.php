<?php
include("utils/connectDB.php");
include("parts/header.php");

if (isset($_GET["id"])) {
    $joueurs_id = $_GET["id"];

    // Récupérer les informations actuelles du joueur
    $requete = $pdo->prepare("SELECT * FROM joueurs WHERE joueurs_id = :joueurs_id");
    $requete->execute([
        "joueurs_id" => $joueurs_id,
    ]);
    $joueur = $requete->fetch();

    if (!$joueur) {
        echo "Le joueur spécifié n'existe pas.";
    } else {
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nouveauNom = $_POST["nom"];
            $nouveauPrenom = $_POST["prenom"];
            $nouvelAge = $_POST["age"];
            $nouveauPoste = $_POST["poste"];

            // Mettre à jour les informations du joueur dans la base de données
            $requete = $pdo->prepare("UPDATE joueurs SET joueurs_nom = :nom, joueurs_prenom = :prenom, joueurs_age = :age, joueurs_poste = :poste WHERE joueurs_id = :joueurs_id");
            $requete->execute([
                "nom" => $nouveauNom,
                "prenom" => $nouveauPrenom,
                "age" => $nouvelAge,
                "poste" => $nouveauPoste,
                "joueurs_id" => $joueurs_id,
            ]);

            echo "Les informations du joueur ont été mises à jour.";
        }

        // Afficher le formulaire de mise à jour avec les informations actuelles du joueur
        ?>
        <h2>Modifier les informations du joueur</h2>
        <form method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $joueur["joueurs_nom"]; ?>"><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $joueur["joueurs_prenom"]; ?>"><br>

            <label for="age">Âge :</label>
            <input type="text" id="age" name="age" value="<?php echo $joueur["joueurs_age"]; ?>"><br>

            <label for="poste">Poste :</label>
            <select name="poste" value="<?php echo $joueur["joueurs_poste"]; ?>">
                <option value="Gardien">Gardien</option>
                <option value="Défenseur">Défenseur</option>
                <option value="Millieu">Millieu</option>
                <option value="Attaquant">Attaquant</option>
            </select>

            <input type="submit" value="Mettre à jour">
        </form>
        <?php
    }
} else {
    echo "L'identifiant du joueur n'a pas été spécifié.";
}

include("parts/footer.php");
?>

