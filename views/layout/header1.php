<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/header.css">
    <title>Document</title>
    <style>
        /* Ajouter le style CSS pour le menu déroulant */
        .user-action {
            position: relative;
            display: inline-block;
        }

        #connexionButton {
            cursor: pointer;
            text-decoration: none;
            color: #0a2463;
        }

        #connexionButton .icon {
            margin-right: 8px;
        }

        #connexionDropdown {
            display: none;
            position: absolute;
            background-color: #f4f4f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        #connexionDropdown a {
            color: #0a2463;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        #connexionDropdown a:hover {
            background-color: #ddd;
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
</head>
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
                 
                  
                </ul>
            </nav>
        </div>

        <div class="user-actions">
            <div class="user-action">
                <a href="Client/LoginController.php">
                    <i class="fas fa-shopping-cart icon"></i>
                 
                </a>
            </div>

            <!-- Connexion Dropdown -->
            <div class="user-action">
                <a href="#" id="connexionButton" onclick="toggleDropdown()">
                    <i class="fas fa-user icon"></i>
                    <span class="text">Connexion</span>
                </a>
                <div id="connexionDropdown" class="dropdown-content">
                    <a href="Client/LoginController.php"> Client</a>
                    <a href="Responsable/LoginRespoController.php"> Responsable</a>
                </div>
            </div>
        </div>

        <button class="mobile-menu-btn">☰</button>
    </div>
</header>

<!-- JavaScript -->
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("connexionDropdown");
        dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
    }
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
