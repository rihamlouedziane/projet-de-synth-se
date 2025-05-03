<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/header.css">
    <title>Document</title>
</head>

<style>
    /* Style du menu déroulant */
    .user-action.dropdown {
        position: relative;
    }

    .dropdown-menu {
        display: none; /* Le menu est caché par défaut */
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        min-width: 180px;
        z-index: 10;
    }

    .user-action.dropdown.active .dropdown-menu {
        display: block; /* Affiche le menu lorsqu'il est activé */
    }
</style>

<body>
<header class="main-header">
    <div class="header-container">
        <div class="logo-container">
            <div class="logo"><img src="../../public/images/trotty  logo grand-04.png" alt="Trotty Logo"></div>
            <div class="text-logo"><img src="../../public/images/logotext.png" alt="Trotty"></div>
        </div>

    
            <?php if ($nom): ?>
                <div class="user-action dropdown" id="user-dropdown">
                    <a href="#" class="dropdown-toggle" id="user-name-toggle">
                        <i class="fas fa-user icon"></i>
                        <span class="text"><?= htmlspecialchars($nom) ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="profil.php">Mon profil</a>
                        <a href="commandes.php">Mes commandes</a>
                        <a href="../../auth/logout.php">Déconnexion</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="user-action">
                    <a href="../../controllers/LoginController.php">
                        <i class="fas fa-user icon"></i>
                        <span class="text">Connexion</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <button class="mobile-menu-btn">☰</button>
    </div>
</header>

<script>
    // Afficher / cacher le menu déroulant
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('user-name-toggle');
        const dropdownMenu = document.querySelector('#user-dropdown .dropdown-menu');
        const dropdown = document.querySelector('.user-action.dropdown');

        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault();  // Empêche la redirection
            // Toggle la classe 'active' pour afficher ou masquer le menu
            dropdown.classList.toggle('active');
        });
    });
</script>

</body>
</html>
