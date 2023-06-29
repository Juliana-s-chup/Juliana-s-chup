<?php
$conn = mysqli_connect("localhost", "root", "", "gestions_projet");

// Récupérer les tâches non terminées ou en cours
$query = "SELECT * FROM taches WHERE fin >= NOW()";
$result = mysqli_query($conn, $query);

// Récupérer les catégories et les priorités pour affichage
$query_categories = "SELECT * FROM categories";
$result_categories = mysqli_query($conn, $query_categories);

$query_priorites = "SELECT * FROM priorites";
$result_priorites = mysqli_query($conn, $query_priorites);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Gestion de Projet</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    body {
      background-color: <?php echo isset($_GET['color']) ? $_GET['color'] : '#f1c40f'; ?>;
    }

    /* Magnifique navbar */
    .navbar {
      background-color: #333;
      padding: 10px;
      border-radius: 0;
    }

    .navbar-brand,
    .navbar-nav a {
      color: #fff;
    }

    .navbar-brand:hover,
    .navbar-nav a:hover {
      color: #aaa;
    }

    /* Magnifique JavaScript avec des animations et de la logique supplémentaires */
    $(document).ready(function() {
      // Ajouter des animations supplémentaires
      $('.navbar-brand').addClass('animate__animated animate__bounce');
      $('form').addClass('animate__animated animate__fadeInUp');
    });

    .table-container {
      margin-top: 50px;
      animation: animate__animated animate__fadeIn;
    }

    .table-container h1 {
      text-align: center;
      font-size: 36px;
      margin-bottom: 30px;
      color: #fff;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      animation: animate__animated animate__bounceIn;
    }

    .table {
      animation: animate__animated animate__fadeInUp;
    }

    .btn-primary {
      animation: animate__animated animate__pulse;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="taches.php">Gestion de Projet</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="taches.php">Tâches</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Index</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="historique.php">Historique</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="statistique.php">Statistiques</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="table-container">
      <h1>Liste des tâches <i class="fas fa-tasks"></i></h1>
      <table class="table">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Début</th>
            <th>Fin</th>
            <th>Catégorie</th>
            <th>Priorité</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['titre']; ?></td>
              <td><?php echo $row['description']; ?></td>
              <td><?php echo $row['debut']; ?></td>
              <td><?php echo $row['fin']; ?></td>
              <td>
                <?php
                  // Récupérer le nom de la catégorie correspondante
                  $categorie_id = $row['categorie_id'];
                  $query_cat = "SELECT nom FROM categories WHERE id = $categorie_id";
                  $result_cat = mysqli_query($conn, $query_cat);
                  $cat = mysqli_fetch_assoc($result_cat);
                  echo $cat['nom'];
                ?>
              </td>
              <td>
                <?php
                  // Récupérer le nom de la priorité correspondante
                  $priorite_id = $row['priorite_id'];
                  $query_prior = "SELECT nom FROM priorites WHERE id = $priorite_id";
                  $result_prior = mysqli_query($conn, $query_prior);
                  $prior = mysqli_fetch_assoc($result_prior);
                  echo $prior['nom'];
                ?>
              </td>
              <td>
                <a href="modifier.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Modifier</a>
                <a href="supprimer.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Supprimer</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
  <script>
    // Fonction pour permettre à l'utilisateur de choisir une couleur personnalisée
    function changeBackgroundColor() {
      var color = prompt("Veuillez saisir une couleur en utilisant un code hexadécimal (par ex. #ff0000 pour le rouge) :");
      if (color) {
        document.body.style.backgroundColor = color;
      }
    }
  </script>
</body>
</html>
