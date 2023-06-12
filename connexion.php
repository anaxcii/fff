<?php
include("utils/connectDB.php");
$title = "connexion";
include("parts/header.php");
session_start();


$errors = [];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST["username"])) {
        $errors["username"] = 'Veuillez saisir un username';
    }

    if (empty($_POST["password"])) {
        $errors["password"] = 'Veuillez saisir un mot de passe';
    }


    if (count($errors) == 0) {

        $stmt = $pdo->prepare(
            'SELECT * FROM utilisateur WHERE username = :username'
        );
        $stmt->bindParam(':username', $_POST["username"]);

        $stmt->execute();

        $res = $stmt->fetch();

        if (!$res || !password_verify($_POST["password"], $res["password"])) {

            $errors["password"] = 'Identifiants ou mot de passe incorrecte';
        } else {
            // CONNEXION RÉUSSIE
            // Le hash correspond
            // J'ajoute la session et je redirige l'utilisateur
            $_SESSION["username"] = $res["username"];
            header('Location: admin.php');
        }
    }
}

?>

    <form method="post" action="connexion.php" class="p-5">
        <div class="form-group">
            <label for="username">Utilisateur</label>
            <input id="username" name="username" class="form-control">
        </div>

        <div class="form-group mt-2">
            <label for="password">Mot de passe</label>
            <input id="password" name="password" class="form-control">
        </div>
        <?php
        //Affichage des erreurs
        if (count($errors) != 0) {
            echo (' <h4>Erreurs lors de la dernière soumission du formulaire : </h2>');
            foreach ($errors as $error) {
                echo ('<div class="text-danger">' . $error . '</div>');
            }
        }
        ?>

        <input type="submit" class="btn btn-success mt-3">
    </form>



<?php
include("parts/footer.php");

