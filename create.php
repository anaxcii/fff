<?php
include("utils/connectDB.php");
include("parts/header.php");

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST["nom"])) {
        $errors["nom"] = 'Veuillez saisir un nom';
    }

    if (empty($_POST["prenom"])) {
        $errors["prenom"] = 'Veuillez saisir un prenom';
    }

    if (empty($_POST["age"])) {
        $errors["age"] = 'Veuillez saisir un âge';
    }

    if (empty($_POST["poste"])) {
        $errors["poste"] = 'Veuillez saisir un poste';
    }

    if (empty($_POST["image"])) {
        $errors["image"] = 'Veuillez saisir une image';
    }


    if (count($errors) == 0) {
        // Compte le nombre de joueurs existants
        $countReq = $pdo->query("SELECT COUNT(*) FROM joueurs");
        $count = $countReq->fetchColumn();

        if ($count < 23) {
            // Si le nombre de joueurs est inférieur à 23, insérez le nouveau joueur dans la base de données
            $requete = $pdo->prepare("INSERT INTO joueurs(joueurs_nom, joueurs_prenom,joueurs_age,joueurs_poste,image) VALUES(:nom,:prenom,:age,:poste,:image);");

            $requete->execute([
                "nom" => $_POST["nom"],
                "prenom" => $_POST["prenom"],
                "age" => $_POST["age"],
                "poste" => $_POST["poste"],
                "image" => $_POST["image"],
            ]);

            header('Location: admin.php');
        } else {
            // Sinon, affiche une erreur
            $errors["limit"] = 'La limite de joueurs a été atteinte. Vous ne pouvez pas ajouter plus de 23 joueurs.';
        }
    }
}
?>



<form method="POST" action="create.php">
    <label>Nom</label>
    <input type="text" name="nom">
    <label>Prénom</label>
    <input type="text" name="prenom">
    <label>Âge</label>
    <input type="number" name="age">
    <label>Poste</label>
    <select name="poste" >
        <option value="Gardien">Gardien</option>
        <option value="Défenseur">Défenseur</option>
        <option value="Millieu">Millieu</option>
        <option value="Attaquant">Attaquant</option>
    </select>
    <label>Image</label>
    <input type="text" name="image">


    <button>Valider</button>
</form>

<?php
    if (isset($errors["limit"])) {
        echo '<p>' . $errors["limit"] . '</p>';
    }
include("parts/footer.php");
?>