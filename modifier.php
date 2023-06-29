<?php
$conn = mysqli_connect("localhost", "root", "", "gestions_projet");

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    $categorie = $_POST['categorie'];
    $priorite = $_POST['priorite'];

    // Mettre à jour la tâche correspondante dans la base de données
    $query = "UPDATE taches SET titre = ?, description = ?, debut = ?, fin = ?, categorie_id = ?, priorite_id = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ssssiii", $titre, $description, $debut, $fin, $categorie, $priorite, $id);

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: index.php"); // Rediriger vers la page d'accueil après la modification
        exit();
      } else {
        echo "Erreur lors de la modification de la tâche: " . mysqli_stmt_error($stmt);
      }

      mysqli_stmt_close($stmt);
    } else {
      echo "Erreur lors de la préparation de la requête: " . mysqli_error($conn);
    }
  } else {
    // Récupérer la tâche correspondante depuis la base de données
    $query = "SELECT * FROM taches WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
  }
} else {
  echo "ID de tâche non spécifié.";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Gestion de Projet - Modifier une tâche</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    /* Styles CSS personnalisés avec des animations 3D et des couleurs harmonieuses */

/* Animation de rebondissement */
.animate-bounce {
  animation: bounce 1s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-20px);
  }
  60% {
    transform: translateY(-10px);
  }
}

/* Animation de fondu entrant vers le haut */
.animate-fadeInUp {
  animation: fadeInUp 1s;
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Animation de pulsation */
.animate-pulse {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}

/* Couleurs harmonieuses */
body {
  background-color: #f2f2f2;
}

h1, h2 {
  color: #333;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

/* Superbe mise en page */
.container {
  margin-top: 50px;
  background-color: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  position: relative;
}

.container:before {
  content: "";
  position: absolute;
  top: -15px;
  left: -15px;
  right: -15px;
  bottom: -15px;
  background: linear-gradient(45deg, #f00, #0f0, #00f);
  background-size: 400% 400%;
  z-index: -1;
  border-radius: 20px;
  animation: glowing 3s linear infinite;
}

@keyframes glowing {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
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
  color: #red;
}

/* Magnifique JavaScript avec des animations et de la logique supplémentaires */
$(document).ready(function() {
  // Ajouter des animations supplémentaires
  $('.navbar-brand').addClass('animate__animated animate-bounce');
  $('form').addClass('animate__animated animate-fadeInUp');

  // Gérer la logique des tâches terminées
  $('li').each(function() {
    if ($(this).hasClass('terminee')) {
      $(this).css('color', 'green');
    } else {
      $(this).css('color', 'red');
    }
  });
});

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
    <h1>Modifier une tâche</h1>
    <form action="" method="POST">
      <div class="form-group">
        <label for="titre">Titre :</label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $row['titre']; ?>" required>
      </div>
      <div class="form-group">
        <label for="description">Description :</label>
        <textarea class="form-control" id="description" name="description" required><?php echo $row['description']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="debut">Début :</label>
        <input type="datetime-local" class="form-control" id="debut" name="debut" value="<?php echo date('Y-m-d\TH:i', strtotime($row['debut'])); ?>" required>
      </div>
      <div class="form-group">
        <label for="fin">Fin :</label>
        <input type="datetime-local" class="form-control" id="fin" name="fin" value="<?php echo date('Y-m-d\TH:i', strtotime($row['fin'])); ?>" required>
      </div>
      <div class="form-group">
        <label for="categorie">Catégorie :</label>
        <select class="form-control" id="categorie" name="categorie" required>
          <!-- PHP: Récupérer les catégories de la base de données et les afficher -->
          <?php
            $query_categories = "SELECT * FROM categories";
            $result_categories = mysqli_query($conn, $query_categories);
            while ($cat = mysqli_fetch_assoc($result_categories)) {
              $selected = ($cat['id'] == $row['categorie_id']) ? 'selected' : '';
              echo "<option value='".$cat['id']."' ".$selected.">".$cat['nom']."</option>";
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="priorite">Priorité :</label>
        <select class="form-control" id="priorite" name="priorite" required>
          <!-- PHP: Récupérer les priorités de la base de données et les afficher -->
          <?php
            $query_priorites = "SELECT * FROM priorites";
            $result_priorites = mysqli_query($conn, $query_priorites);
            while ($prior = mysqli_fetch_assoc($result_priorites)) {
              $selected = ($prior['id'] == $row['priorite_id']) ? 'selected' : '';
              echo "<option value='".$prior['id']."' ".$selected.">".$prior['nom']."</option>";
            }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
