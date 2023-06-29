<?php
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "gestions_projet");

// Requête pour obtenir le nombre total de tâches créées
$query_count_tasks = "SELECT COUNT(*) as total_tasks FROM taches";
$result_count_tasks = mysqli_query($conn, $query_count_tasks);
$row_count_tasks = mysqli_fetch_assoc($result_count_tasks);
$total_tasks = $row_count_tasks['total_tasks'];

// Requête pour obtenir les catégories les plus choisies
$query_top_categories = "SELECT categories.nom, COUNT(*) as count FROM taches INNER JOIN categories ON taches.categorie_id = categories.id GROUP BY taches.categorie_id ORDER BY count DESC LIMIT 5";
$result_top_categories = mysqli_query($conn, $query_top_categories);
$top_categories = mysqli_fetch_all($result_top_categories, MYSQLI_ASSOC);

// Requête pour obtenir les priorités les plus choisies
$query_top_priorities = "SELECT priorites.nom, COUNT(*) as count FROM taches INNER JOIN priorites ON taches.priorite_id = priorites.id GROUP BY taches.priorite_id ORDER BY count DESC LIMIT 5";
$result_top_priorities = mysqli_query($conn, $query_top_priorities);
$top_priorities = mysqli_fetch_all($result_top_priorities, MYSQLI_ASSOC);

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Statistiques des tâches</title>
  <!-- Inclure les liens vers les bibliothèques CSS et JavaScript nécessaires -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <!-- Inclure les styles CSS personnalisés -->
  <style>
   /* Styles généraux */
   body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      padding: 20px;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .section {
      margin-bottom: 40px;
    }

    .section h2 {
      margin-bottom: 10px;
      color: #666;
    }

    .section ul {
      list-style-type: none;
      padding-left: 20px;
    }

    .section li {
      margin-bottom: 5px;
    }

    /* Styles des graphiques */
    .chart-container {
      width: 100%;
      height: 400px;
      margin-top: 30px;
    }

    /* Styles des boutons */
    .btn {
      display: inline-block;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: bold;
      text-decoration: none;
      text-align: center;
      border-radius: 4px;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .btn-primary {
      background-color: #007bff;
      color: #fff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .btn-secondary {
      background-color: #6c757d;
      color: #fff;
    }

    .btn-secondary:hover {
      background-color: #545b62;
    }

    /* Effets d'animation */
    @keyframes slide-in {
      0% {
        transform: translateY(100%);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .animated {
      animation-fill-mode: both;
    }

    .slide-in {
      animation: slide-in 0.5s ease;
    }

    /* Styles 3D */
    .card-3d {
      perspective: 1000px;
    }

    .card-3d:hover .card-3d-inner {
      transform: rotateY(180deg);
    }

    .card-3d-inner {
      position: relative;
      width: 100%;
      height: 100%;
      transition: transform 0.5s;
      transform-style: preserve-3d;
    }

    .card-3d-front,
    .card-3d-back {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
    }

    .card-3d-front {
      background-color: #f8f9fa;
      color: #333;
    }

    .card-3d-back {
      background-color: #007bff;
      color: #fff;
      transform: rotateY(180deg);
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
  <div>
    <h1>Statistiques</h1>

    <div class="section">
      <h2>Nombre total de tâches créées</h2>
      <p><?php echo $total_tasks; ?></p>
    </div>

    <div class="section">
      <h2>Catégories les plus choisies</h2>
      <ul>
        <?php foreach ($top_categories as $category): ?>
          <li><?php echo $category['nom']; ?> (<?php echo $category['count']; ?>)</li>
        <?php endforeach; ?>
      </ul>
      <div class="chart-container">
        <canvas id="categories-chart"></canvas>
      </div>
    </div>

    <div class="section">
      <h2>Priorités les plus choisies</h2>
      <ul>
        <?php foreach ($top_priorities as $priority): ?>
          <li><?php echo $priority['nom']; ?> (<?php echo $priority['count']; ?>)</li>
        <?php endforeach; ?>
      </ul>
      <div class="chart-container">
        <canvas id="priorities-chart"></canvas>
      </div>
    </div>

  </div>

  <!-- Inclure les scripts JavaScript nécessaires pour les graphiques et l'interaction (Chart.js, Plotly, etc.) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <!-- Inclure la bibliothèque Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Inclure les scripts JavaScript personnalisés -->
  <script>
    // Code JavaScript personnalisé pour les graphiques et l'interaction

    // Données pour le graphique des catégories
    var categoryLabels = <?php echo json_encode(array_column($top_categories, 'nom')); ?>;
    var categoryCounts = <?php echo json_encode(array_column($top_categories, 'count')); ?>;

    var categoriesChart = new Chart(document.getElementById('categories-chart'), {
      type: 'pie',
      data: {
        labels: categoryLabels,
        datasets: [{
          data: categoryCounts,
          backgroundColor: [
            '#007bff',
            '#dc3545',
            '#ffc107',
            '#28a745',
            '#17a2b8'
          ]
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: 'bottom'
        },
        title: {
          display: true,
          text: 'Répartition des tâches par catégorie'
        }
      }
    });

    // Données pour le graphique des priorités
    var priorityLabels = <?php echo json_encode(array_column($top_priorities, 'nom')); ?>;
    var priorityCounts = <?php echo json_encode(array_column($top_priorities, 'count')); ?>;

    var prioritiesChart = new Chart(document.getElementById('priorities-chart'), {
      type: 'bar',
      data: {
        labels: priorityLabels,
        datasets: [{
          data: priorityCounts,
          backgroundColor: '#007bff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        title: {
          display: true,
          text: 'Tâches par priorité'
        },
        scales: {
          y: {
            beginAtZero: true,
            stepSize: 1
          }
        }
      }
    });
  </script>
</body>
</html>
