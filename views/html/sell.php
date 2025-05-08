

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Acheter des Trottinettes Électriques</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2a4b8d;
            --primary-yellow: #f5a623;
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #333333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Main Content Styles */
        .products-section {
            padding: 4rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h1 {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1.2rem;
            color: var(--dark-gray);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Products Grid - 4 columns */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .product-card {
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--primary-yellow);
            color: var(--dark-gray);
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            z-index: 2;
        }

        .product-info {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 1.3rem;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .product-specs {
            margin-bottom: 1rem;
            flex: 1;
        }

        .spec-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: var(--dark-gray);
        }

        .spec-item i {
            margin-right: 0.5rem;
            color: var(--primary-blue);
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.7rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            text-align: center;
            flex: 1;
            cursor: pointer;
            border: none;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #1a3a8f;
        }

        .btn-secondary {
            background-color: var(--light-gray);
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
        }

        .btn-secondary:hover {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        /* Filter Section */
        .filter-section {
            background-color: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            margin-bottom: 3rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .filter-title {
            font-size: 1.5rem;
            color: var(--primary-blue);
            font-weight: 700;
        }

        .reset-filters {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .reset-filters:hover {
            color: var(--primary-yellow);
        }

        .filter-groups {
            display: flex;
            gap: 2rem;
        }

        .filter-group {
            flex: 1;
            margin-bottom: 0;
        }

        .filter-group h3 {
            font-size: 1.2rem;
            color: var(--primary-blue);
            margin-bottom: 1.2rem;
            font-weight: 600;
        }

        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
        }

        .filter-option {
            padding: 0.8rem 1.5rem;
            background-color: var(--light-gray);
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            text-decoration: none;
            color: inherit;
        }

        .filter-option:hover, .filter-option.active {
            background-color: var(--primary-blue);
            color: var(--white);
            border-color: var(--primary-blue);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.5rem;
        }
        
        .pagination a {
            padding: 0.5rem 1rem;
            background: #f0f0f0;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }
        
        .pagination a.active, .pagination a:hover {
            background: var(--primary-blue);
            color: white;
        }
        
        /* No products message */
        .no-products {
            text-align: center;
            grid-column: 1 / -1;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 2rem;
            text-align: center;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .filter-groups {
                flex-direction: column;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .products-section {
                padding: 3rem 1.5rem;
            }

            .section-header h1 {
                font-size: 2rem;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-actions {
                flex-direction: column;
            }

            .filter-section {
                padding: 1.5rem;
            }

            .filter-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .filter-option {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
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
                            <a href="../controllers/PanierController.php?id=<?= $trott['IDTrotinette'] ?>" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Ajouter au panier
                            </a>
                        <?php else: ?>
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