<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Location de Trottinettes Électriques</title>
 
    <style>
 
        body {
            background-color: var(--light-gray);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        /* Rental Controls */
        .rental-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            background-color: var(--light-gray);
            border-radius: 50px;
            padding: 0.5rem;
        }

        .days-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .days-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--primary-blue);
            color: white;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .days-btn:hover {
            background-color: #1a3a8f;
        }

        .days-value {
            font-weight: 600;
            min-width: 30px;
            text-align: center;
        }

        .rental-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            text-align: center;
        }

        .daily-price {
            font-size: 0.9rem;
            color: var(--dark-gray);
            text-align: center;
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
        }

        .filter-option:hover, .filter-option.active {
            background-color: var(--primary-blue);
            color: var(--white);
            border-color: var(--primary-blue);
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: var(--primary-blue);
            cursor: pointer;
            padding: 0.5rem;
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

        @media (max-width: 1024px) {
            .user-actions {
                gap: 1rem;
            }

            .user-action a span.text {
                display: none;
            }

            .user-action a {
                padding: 0.5rem;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                padding: 1rem;
            }
            
            .nav-container {
                position: static;
                transform: none;
                width: 100%;
            }
            
            .main-nav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--white);
                padding: 1rem;
                display: none;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                z-index: 1000;
            }
            
            .main-nav.active {
                display: block;
            }
            
            .main-nav ul {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .main-nav a {
                display: block;
                text-align: center;
            }
            
            .mobile-menu-btn {
                display: block;
            }

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

            .user-actions {
                margin-left: auto;
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php if (isset($_SESSION['client_id'])): ?>
    <?php include('../views/html/dashboardclient/headerCP.php'); ?>
<?php else: ?>
    <?php include('../views/layout/header1.php'); ?>
<?php endif; ?>
    
    <section class="products-section">
        <div class="section-header">
            <h1>Location de Trottinettes</h1>
            <p>Louez la trottinette électrique qui correspond à vos besoins pour la durée que vous souhaitez.</p>
        </div>

        <div class="filter-section">
            <div class="filter-header">
                <h2 class="filter-title">Filtrer les produits</h2>
                <a href="#" class="reset-filters">
                    <i class="fas fa-undo"></i>
                    Réinitialiser
                </a>
            </div>
            
            <div class="filter-groups">
                <div class="filter-group">
                    <h3>Catégories</h3>
                    <div class="filter-options">
                        <div class="filter-option active">Tous</div>
                        <div class="filter-option">Ville</div>
                        <div class="filter-option">Tout-terrain</div>
                        <div class="filter-option">Compacte</div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Prix journalier</h3>
                    <div class="filter-options">
                        <div class="filter-option">Moins de 20€</div>
                        <div class="filter-option">20-30€</div>
                        <div class="filter-option">30-40€</div>
                        <div class="filter-option">Plus de 40€</div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Autonomie</h3>
                    <div class="filter-options">
                        <div class="filter-option">Moins de 30km</div>
                        <div class="filter-option">30-50km</div>
                        <div class="filter-option">Plus de 50km</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                <img src="../public/uploads/image/<?= htmlspecialchars($product['Photo'] ?? 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') ?>" alt="<?= htmlspecialchars($product['Nom']) ?>">
                    <?php if ($product['IsPopular'] ?? false): ?>
                    <span class="product-badge">Populaire</span>
                    <?php endif; ?>
                </div>
                <div class="product-info">
                    <h3 class="product-title"><?= htmlspecialchars($product['Libelle']) ?></h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> <?= htmlspecialchars($product['Puissance'] ?? 'N/A') ?> km/h - Autonomie <?= htmlspecialchars($product['Autonomie'] ?? 'N/A') ?>km
                        </div>
                        
                       
                    </div>
                    
                    <div class="daily-price">Prix journalier: <strong><?= htmlspecialchars($product['Tarif'] ?? 'N/A') ?>€</strong></div>
                    
                    <div class="rental-controls">
                        <div class="days-control">
                            <button class="days-btn minus-btn">-</button>
                            <span class="days-value">1</span>
                            <button class="days-btn plus-btn">+</button>
                        </div>
                        <span>jour(s)</span>
                    </div>
                    
                    <div class="rental-price"><?= htmlspecialchars($product['Tarif'] ?? 'N/A') ?>€</div>
                    
                    <div class="product-actions">
                    <?php if (isset($_SESSION['client_id'])): ?>
                        <a href="rent_process.php?id=<?= $product['IDTrotinette'] ?>" class="btn btn-primary">Louer maintenant</a>
                        <?php else: ?>
                            <a href="../controllers/Client/LoginController.php" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Louer maintenant
                            </a>
                        <?php endif; ?>
                     
                        <a href="../controllers/DetailsrentController.php?id=<?= $product['IDTrotinette'] ?>" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            document.querySelector('.main-nav').classList.toggle('active');
        });

        // Filter functionality
        document.querySelectorAll('.filter-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove active class from all options in the same group
                this.parentNode.querySelectorAll('.filter-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                
                // Add active class to clicked option
                this.classList.add('active');
            });
        });

        // Rental days controls
        document.querySelectorAll('.product-card').forEach(card => {
            const minusBtn = card.querySelector('.minus-btn');
            const plusBtn = card.querySelector('.plus-btn');
            const daysValue = card.querySelector('.days-value');
            const rentalPrice = card.querySelector('.rental-price');
            const dailyPriceText = card.querySelector('.daily-price strong');
            const dailyPrice = parseFloat(dailyPriceText.textContent.replace('€', ''));
            
            let days = 1;
            
            function updatePrice() {
                const totalPrice = days * dailyPrice;
                rentalPrice.textContent = totalPrice + '€';
                daysValue.textContent = days;
            }
            
            minusBtn.addEventListener('click', function() {
                if (days > 1) {
                    days--;
                    updatePrice();
                }
            });
            
            plusBtn.addEventListener('click', function() {
                days++;
                updatePrice();
            });
        });
    </script>
<?php include('../views/layout/footer.php'); ?>

</body>
</html>