<?php

try {
    $host = 'localhost';
    $dbName = 'fff';
    $user = 'root';
    $password = '';
    $pdo = new PDO(
        'mysql:host='.$host.';dbname='.$dbName.';charset=utf8',
        $user,
        $password);

    // Cette ligne demandera à pdo de renvoyer les erreurs SQL si il y en a
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
    // Cette ligne permet de ne fetch que les indice ASSOCIATIF
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC);

}
catch (PDOException $e) {
    throw new InvalidArgumentException('Erreur connexion à la base de
       données : '.$e->getMessage());
    exit;
}

?>