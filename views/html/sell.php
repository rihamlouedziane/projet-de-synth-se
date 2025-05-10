

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Acheter des Trottinettes Électriques</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/sell.css">

</head>
<body>
<?php if (isset($_SESSION['client_id'])): ?>
    <?php include('../views/html/dashboardclient/headerCP.php'); ?>
<?php else: ?>
    <?php include('../views/layout/header1.php'); ?>
<?php endif; ?>



<section class="products-section">
    <div class="section-header">
        <h1>Nos Trottinettes à Vendre</h1>
        <p>Découvrez notre gamme complète de trottinettes électriques haut de gamme pour tous les besoins et budgets.</p>
    </div>

    <div class="filter-section">
        <div class="filter-header">
            <h2 class="filter-title">Filtrer les produits</h2>
            <a href="sell.php" class="reset-filters">
                <i class="fas fa-undo"></i>
                Réinitialiser
            </a>
        </div>
        
        <div class="filter-groups">
            <div class="filter-group">
                <h3>Catégories</h3>
                <div class="filter-options">
                    <a href="sell.php" class="filter-option <?= empty($category) ? 'active' : '' ?>">Tous</a>
                    <a href="sell.php?category=1" class="filter-option <?= $category == 1 ? 'active' : '' ?>">Ville</a>
                    <a href="sell.php?category=2" class="filter-option <?= $category == 2 ? 'active' : '' ?>">Tout-terrain</a>
                    <a href="sell.php?category=3" class="filter-option <?= $category == 3 ? 'active' : '' ?>">Compacte</a>
                    <a href="sell.php?category=4" class="filter-option <?= $category == 4 ? 'active' : '' ?>">Puissante</a>
                </div>
            </div>
            
            <div class="filter-group">
                <h3>Nombre d'articles</h3>
                <div class="filter-options">
                    <a href="sell.php?<?= $category ? "category=$category&" : '' ?>limit=12" class="filter-option <?= $limit == 12 ? 'active' : '' ?>">12</a>
                    <a href="sell.php?<?= $category ? "category=$category&" : '' ?>limit=24" class="filter-option <?= $limit == 24 ? 'active' : '' ?>">24</a>
                    <a href="sell.php?<?= $category ? "category=$category&" : '' ?>limit=36" class="filter-option <?= $limit == 36 ? 'active' : '' ?>">36</a>
                    <a href="sell.php?<?= $category ? "category=$category&" : '' ?>limit=0" class="filter-option <?= $limit == 0 ? 'active' : '' ?>">Tous</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php if (isset($errorMessage)): ?>
        <div class="error-message">
            <?= $errorMessage ?>
        </div>
    <?php endif; ?>
    
    <div class="products-grid">
        <?php if (empty($trottinettes)): ?>
            <div class="no-products">
                <h3>Aucune trottinette disponible dans cette catégorie</h3>
                <p>Veuillez essayer une autre catégorie ou revenir plus tard.</p>
                <a href="sell.php" class="btn btn-primary">Voir toutes les trottinettes</a>
            </div>
        <?php else: ?>
            <?php foreach ($trottinettes as $trott): ?>
                <div class="product-card" onclick="window.location.href='details.php?id=<?= $trott['IDTrotinette'] ?>'">
                    <div class="product-image">
                        <img src="../public/uploads/image/<?= htmlspecialchars($trott['Photo'] ?? 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') ?>" 
                             alt="<?= htmlspecialchars($trott['Libelle']) ?>">
                        <?php if ($trott['IsBestSeller'] ?? rand(0, 5) === 1): ?>
                            <span class="product-badge">Best Seller</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?= htmlspecialchars($trott['Libelle']) ?></h3>
                        <div class="product-specs">
                            <div class="spec-item">
                                <i class="fas fa-bolt"></i> Vitesse: <?= round($trott['Puissance'] / 10) ?> km/h
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-battery-full"></i> Autonomie: <?= $trott['Autonomie'] ?> km
                            </div>
                        </div>
                        <div class="product-price"><?= number_format($trott['Tarif'], 0, ',', ' ') ?> €</div>
                       <div class="product-actions">
                            <?php if (isset($_SESSION['client_id'])): ?>
                            <a href="../controllers/BuyController.php?id=<?= $trott['IDTrotinette'] ?>" class="btn btn-success">
                                    <i class="fas fa-credit-card"></i> Acheter
                                </a>
                                  <a href="../controllers/PanierController.php?id=<?= $trott['IDTrotinette'] ?>" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                </a>
                            <?php else: ?>
                                   <a href="../controllers/BuyController.php?id=<?= $trott['IDTrotinette'] ?>" class="btn btn-success">
                                    <i class="fas fa-credit-card"></i> Acheter
                                </a>
                                  <a href="../controllers/Client/LoginController.php" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                </a>
                            <?php endif; ?>

                            <a href="../controllers/DetailsellController.php?id=<?= $trott['IDTrotinette'] ?>" class="btn btn-secondary" onclick="event.stopPropagation()">
                                <i class="fas fa-info-circle"></i> Détails
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <?php if ($limit > 0 && count($trottinettes) >= $limit): ?>
        <div class="pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="fas fa-chevron-right"></i></a>
        </div>
    <?php endif; ?>
</section>

<script>
    // Mobile menu toggle
    document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
        document.querySelector('.main-nav').classList.toggle('active');
    });

    // Add to cart function
    function addToCart(productId, productName, productPrice, productImage) {
        // Get existing cart items or initialize empty array
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        
        // Check if product already exists in cart
        const existingItem = cartItems.find(item => item.id === productId);
        
        if (existingItem) {
            // Increment quantity if already in cart (max 10)
            if (existingItem.quantity < 10) {
                existingItem.quantity += 1;
            }
        } else {
            // Add new item to cart
            cartItems.push({
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage,
                quantity: 1
            });
        }
        
        // Save back to localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        
        // Update cart count in header
        updateCartCount();
        
        // Show confirmation
        alert(`${productName} a été ajouté à votre panier !`);
    }

    // Update cart count in header
    function updateCartCount() {
        const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
        
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = totalItems;
            el.style.display = totalItems > 0 ? 'flex' : 'none';
        });
    }

    // Make entire product card clickable except for buttons
    document.querySelectorAll('.product-actions a, .product-actions button').forEach(element => {
        element.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
</script>

<?php include('../views/layout/footer.php'); ?>
</body>
</html>