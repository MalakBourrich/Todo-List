<?php

if (isset($_POST['supprimer'])) {
    require_once 'database.php';
    $id = $_POST['id'];
    $sqlState = $pdo->prepare('DELETE FROM items where id= ?');
    var_dump($pdo);
    $result = $sqlState->execute([$id]);
    if ($result) {
        echo "Suppression réussie.";
    } else {
        echo "Erreur lors de la suppression.";
    }

    header('location: index.php');
}
