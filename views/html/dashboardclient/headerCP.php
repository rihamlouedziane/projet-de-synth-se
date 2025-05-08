<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/header.css">
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
            /* Style du lien actif */
.main-nav a.active {
    color: white;
    position: relative;
    font-weight: 600;
}

.main-nav a.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 2px;
    background: white;
    animation: underline 0.3s ease-out;
}

@keyframes underline {
    from { width: 0 }
    to { width: 100% }
}
    
</style>

<body>
<header class="main-header">
    <div class="header-container">
        <div class="logo-container">
            <div class="logo"><img src="../public/images/trotty  logo grand-04.png" alt="Trotty Logo"></div>
            <div class="text-logo"><img src="../public/images/logotext.png" alt="Trotty"></div>
        </div>

        <div class="nav-container">
            <nav class="main-nav">
                <ul>
                    <li><a href="PagedaceuilleContoller.php">Accueil</a></li>
                    <li><a href="TrotinettesellController.php">Acheter</a></li>
                    <li><a href="TrotinetterentController.php">Louer</a></li>
                    <li><a href="PieceController.php">Pièces</a></li>
                    <li><a href="CommentaireController.php">Commantaire</a></li>

                </ul>
            </nav>
        </div>

        <div class="user-actions">
            <div class="user-action">
                <a href="IndexPanierController.php">
                    <i class="fas fa-shopping-cart icon"></i>
                    <span class="text">Panier</span>
                    <span class="cart-count">3</span>
                </a>
            </div>

            <?php if (isset($_SESSION['nom'])): ?>
                <div class="user-action dropdown" id="user-dropdown">
                    <a href="#" class="dropdown-toggle" id="user-name-toggle">
                        <i class="fas fa-user icon"></i>
                        <span class="text"><?= htmlspecialchars($_SESSION['nom']) ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="ProfileController.php">Mon profil</a>
                        <a href="commandes.php">Mes commandes</a>
                        <a href="../Controllers/Client/LogoutController.php">Déconnexion</a>
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
    document.addEventListener('DOMContentLoaded', function() {
    // Gestion du menu déroulant
    function toggleDropdown() {
        var dropdown = document.getElementById("connexionDropdown");
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    }

    // Highlight des liens actifs
    const currentPage = window.location.pathname.split('/').pop().toLowerCase();
    const navLinks = document.querySelectorAll('.main-nav a');
    
    navLinks.forEach(link => {
        const linkPage = link.getAttribute('href').toLowerCase().split('/').pop();
        if (currentPage === linkPage) {
            link.classList.add('active');
        }
    });

    // Fermer le dropdown en cliquant ailleurs
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.user-action')) {
            document.getElementById('connexionDropdown').style.display = 'none';
        }
    });
    
    // Gestion du menu mobile
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
        document.querySelector('.main-nav').classList.toggle('active');
    });
});
</script>

</body>
</html>
