<!DOCTYPE html>
<html>
<head>
  <title>Gestion de Projet</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
      color: #red;
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
      color: #red;
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
    <h1 class="animate__animated animate-bounce">Ajouter une tâche <i class="fas fa-plus"></i></h1>
    <form action="traitement.php" method="POST">
      <div class="form-group">
        <label for="titre">Titre :</label>
        <input type="text" class="form-control" id="titre" name="titre" required>
      </div>
      <div class="form-group">
        <label for="description">Description :</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
      </div>
      <div class="form-group">
        <label for="debut">Début :</label>
        <input type="datetime-local" class="form-control" id="debut" name="debut" required>
      </div>
      <div class="form-group">
        <label for="fin">Fin :</label>
        <input type="datetime-local" class="form-control" id="fin" name="fin" required>
      </div>
      <div class="form-group">
        <label for="categorie">Catégorie :</label>
        <select class="form-control" id="categorie" name="categorie" required>
          <option value="">Sélectionner une catégorie</option>
          <!-- PHP: Récupérer les catégories de la base de données et les afficher -->
          <?php
            $conn = mysqli_connect("localhost", "root", "", "gestions_projet");
            $query = "SELECT * FROM categories";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['id']."'>".$row['nom']."</option>";
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="priorite">Priorité :</label>
        <select class="form-control" id="priorite" name="priorite" required>
          <option value="">Sélectionner une priorité</option>
          <!-- PHP: Récupérer les priorités de la base de données et les afficher -->
          <?php
            $query = "SELECT * FROM priorites";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['id']."'>".$row['nom']."</option>";
            }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary animate__animated animate-fadeInUp">Enregistrer <i class="fas fa-check"></i></button>
    </form>
    
    <h2 class="animate__animated animate-pulse">Tâches terminées <i class="fas fa-check"></i></h2>
    <ul>
      <!-- PHP: Récupérer et afficher les tâches terminées de la base de données -->
      <?php
        $query = "SELECT * FROM taches WHERE fin < NOW()";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<li class='terminee'>".$row['titre']."</li>";
        }
      ?>
    </ul>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
