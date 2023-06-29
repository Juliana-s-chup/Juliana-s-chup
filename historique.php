<?php
$conn = mysqli_connect("localhost", "root", "", "gestions_projet");

// Traitement de la recherche
$search = "";
if (isset($_GET['search'])) {
  $search = $_GET['search'];

  // Requête pour récupérer les tâches correspondant à la recherche
  $query_search = "SELECT * FROM taches WHERE titre LIKE '%$search%' OR description LIKE '%$search%'";
  $result_search = mysqli_query($conn, $query_search);
  
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Gestion de Projet - Historique des tâches</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    /* Styles CSS personnalisés */
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
    }
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
    *    /* Magnifique navbar */
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

    .container {
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      max-width: 800px;
      margin: 0 auto;
      margin-top: 50px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    h2 {
      margin-top: 40px;
      margin-bottom: 20px;
      color: #666;
    }

    ul {
      padding-left: 20px;
      list-style-type: none;
    }

    input[type="text"] {
      padding: 15px;
      width: 100%;
      border: none;
      border-radius: 50px;
      box-sizing: border-box;
      margin-bottom: 20px;
      font-size: 18px;
      outline: none;
      transition: box-shadow 0.3s ease;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    input[type="text"]:focus {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .btn {
      display: block;
      margin: 0 auto;
      padding: 15px 30px;
      background-color: #0078d7;
      color: #fff;
      text-decoration: none;
      border-radius: 50px;
      transition: background-color 0.3s ease;
      font-size: 18px;
      outline: none;
      border: none;
      cursor: pointer;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn:hover {
      background-color: #005a9e;
    }

    .search-container {
      text-align: center;
    }

    .search-logo {
      width: 120px;
      margin-bottom: 20px;
      animation: spin 4s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

    .animated {
      animation-duration: 1s;
      animation-fill-mode: both;
    }

    .fadeIn {
      animation-name: fadeIn;
    }

    @keyframes fadeIn {
       0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    .btn-back {
      display: block;
      margin-top: 20px;
      background-color: #ccc;
      color: #333;
      border: none;
      padding: 15px 30px;
      border-radius: 50px;
      text-decoration: none;
      font-size: 18px;
      transition: background-color 0.3s ease;
      outline: none;
      border: none;
      cursor: pointer;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-back:hover {
      background-color: #999;
    }

    .task-info {
      color: #999;
      font-size: 14px;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="search-container">
      <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" alt="Google Logo" class="search-logo animated fadeIn">
      <form id="search-form" method="GET">
        <input type="text" name="search" placeholder="Rechercher une tâche">
        <button type="submit" class="btn">Rechercher</button>
      </form>
    </div>

    <?php if (!empty($search)): ?>
      <?php if (mysqli_num_rows($result_search) > 0): ?>
        <h2>Résultats de recherche</h2>
        <ul>
          <?php while ($row_search = mysqli_fetch_assoc($result_search)): ?>
            <li>
              <?php echo $row_search['titre']; ?>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php else: ?>
        <h2>Aucun résultat trouvé.</h2>
      <?php endif; ?>
      <a href="taches.php" class="btn-back">Retour</a>
    <?php endif; ?>
  </div>

  <!-- Inclusion de jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Attacher une fonction de gestionnaire d'événements au formulaire de recherche
    $('#search-form').submit(function(event) {
      event.preventDefault(); // Empêcher le rechargement de la page

      // Récupérer la valeur de la barre de recherche
      var searchQuery = $('input[name="search"]').val();

      
          // Mettre à jour le contenu de la page avec les résultats de recherche
          $('.container').html(response);
        }
      });
    });
  </script>
</body>
</html>
