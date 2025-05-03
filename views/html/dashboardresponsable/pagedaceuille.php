<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Page avec menu latéral</title>
  <style>
    :root {
      --primary-yellow: #FFD700;
      --white: #ffffff;
      --light-gray: #f8f9fa;
      --primary-blue: #0a2463;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--light-gray);
      height: 100%; /* Permet de faire prendre toute la hauteur à body */
    }

    /* Header */
    header {
      background-color: var(--white);
      color: var(--primary-blue);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      z-index: 1000;
      border-bottom: 1px solid var(--light-gray);
    }

    header h1 {
      font-size: 24px;
      color: var(--primary-blue);
    }

    .user-info {
      font-weight: bold;
      color: var(--primary-blue);
      font-size: 18px;
    }

    .menu-toggle {
      background: none;
      border: none;
      color: var(--primary-blue);
      font-size: 26px;
      cursor: pointer;
      display: none;
      margin-right: 10px;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 70px;
      left: 0;
      width: 200px;
      height: calc(100vh - 70px);
      background-color: var(--primary-blue);
      padding-top: 20px;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease;
    }

    .sidebar a {
      color: var(--white);
      padding: 15px 20px;
      text-decoration: none;
      transition: background-color 0.3s;
      font-weight: bold;
    }

    .sidebar a:hover {
      background-color: var(--primary-yellow);
      color: var(--primary-blue);
    }

    /* Main content */
    .main-content {
      padding: 100px 30px 30px 230px; /* Par défaut avec le menu ouvert */
      min-height: 100vh;
      transition: padding-left 0.3s ease;
      height: calc(100vh - 70px); /* Prendre toute la hauteur restante */
      overflow-y: auto; /* Pour gérer le débordement */
    }

    .main-content h2 {
      margin-bottom: 20px;
      color: var(--primary-blue);
    }

    .main-content p {
      font-size: 16px;
      color: var(--primary-blue);
    }

    .sidebar.closed {
      transform: translateX(-100%);
    }

    .main-content.full {
      padding-left: 30px; /* Réduit le padding-left quand le menu est fermé */
    }

    /* Responsive */
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }

      .main-content {
        padding-left: 30px;
      }

      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.open {
        transform: translateX(0);
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header>
    <div style="display: flex; align-items: center;">
      <button class="menu-toggle" onclick="toggleMenu()">☰</button>
      <h1>Mon Application</h1>
    </div>
    <?php if (isset($nom)) : ?>
      <div class="user-info">👤 <?= htmlspecialchars($nom) ?></div>
    <?php else : ?>
      <div class="user-info">👤 Nom d'utilisateur</div>
    <?php endif; ?>
  </header>

  <!-- Menu latéral -->
  <nav class="sidebar" id="sidebar">
    <a href="ou.php">🏠 Accueil</a>
    <a href="indexpiece.php">📦 Pièces</a>
    <a href="">🛴 Trottinettes</a>
    <a href="../Responsable/Modele/indexmodelController.php">🧩 Modèles</a>
    <a href="#">⚙️ Paramètres</a>
  </nav>



  <!-- JavaScript -->
  <script>
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("mainContent");

    function toggleMenu() {
      sidebar.classList.toggle("closed");
      mainContent.classList.toggle("full");
    }
  </script>
</body>
</html>
