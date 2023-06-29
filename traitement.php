<?php
$conn = mysqli_connect("localhost", "root", "", "gestions_projet");

// Vérifier la connexion à la base de données
if (!$conn) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

$titre = $_POST['titre'];
$description = $_POST['description'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$categorie = $_POST['categorie'];
$priorite = $_POST['priorite'];

// Préparer la requête SQL avec des paramètres liés
$query = "INSERT INTO taches (titre, description, debut, fin, categorie_id, priorite_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

// Vérifier si la préparation de la requête a réussi
if ($stmt) {
    // Lier les valeurs des paramètres
    mysqli_stmt_bind_param($stmt, "ssssii", $titre, $description, $debut, $fin, $categorie, $priorite);

    // Exécuter la requête préparée
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: index.php"); // Rediriger vers la page index.php
        exit();
    } else {
        echo "Erreur lors de l'enregistrement de la tâche: " . mysqli_stmt_error($stmt);
    }

    // Fermer la requête préparée
    mysqli_stmt_close($stmt);
} else {
    echo "Erreur lors de la préparation de la requête: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
