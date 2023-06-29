<?php
$conn = mysqli_connect("localhost", "root", "", "gestions_projet");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
  // Supprimer la tâche correspondante de la base de données
  $query = "DELETE FROM taches WHERE id = $id";
  mysqli_query($conn, $query);

  header("Location: index.php"); // Rediriger vers la page d'accueil après la suppression
} else {
  echo "ID de tâche non spécifié.";
}
?>
