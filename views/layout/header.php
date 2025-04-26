<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/header.css">
    <title>Document</title>
</head>
<body>
<header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <div class="logo"><img src="../../public/images/trotty  logo grand-04.png" alt="Trotty Logo"></div>
                <div class="text-logo"><img src="../../public/images/logotext.png" alt="Trotty"></div>
            </div>
            
            <div class="nav-container">
                <nav class="main-nav">
                    <ul>
                        <li><a href="paged'aceuille.php">Accueil</a></li>
                        <li><a href="sell.php">Acheter</a></li>
                        <li><a href="location.php">Louer</a></li>
                        <li><a href="piece.php">Pièces</a></li>
                        <li><a href="contactus.php" class="active">Contact</a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="user-actions">
                <div class="user-action">
                    <a href="panier.php">
                        <i class="fas fa-shopping-cart icon"></i>
                        <span class="text">Panier</span>
                        <span class="cart-count">3</span>
                    </a>
                </div>
                <div class="user-action">
                    <a href="../auth/login.php">
                        <i class="fas fa-user icon"></i>
                        <span class="text">Connexion</span>
                    </a>
                </div>
            </div>
            
            <button class="mobile-menu-btn">☰</button>
        </div>
    </header>
</body>
</html>