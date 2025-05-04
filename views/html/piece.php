<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Pièces Détachées pour Trottinettes</title>
   
    <style>
        

        body {
            background-color: var(--light-gray);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

       
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
            height: 180px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        .product-image img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--primary-green);
            color: var(--white);
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
            font-size: 1.2rem;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            font-weight: 700;
            text-align: center;
        }

        .product-compatibility {
            font-size: 0.9rem;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
            text-align: center;
            font-style: italic;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 1rem 0;
            text-align: center;
        }

        .product-actions {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
        }

        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--white);
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background-color: #1a3a8f;
        }

        .btn-secondary {
            background-color: var(--light-gray);
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
            font-size: 0.9rem;
        }

        .btn-secondary:hover {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        .btn-icon {
            font-size: 0.8rem;
        }

        /* Filter Section */
        .filter-section {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 3rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .filter-title {
            font-size: 1.3rem;
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
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .reset-filters:hover {
            color: var(--primary-yellow);
        }

        .filter-groups {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group h3 {
            font-size: 1.1rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .filter-option {
            padding: 0.5rem 1rem;
            background-color: var(--light-gray);
            border-radius: 50px;
            font-size: 0.9rem;
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

            .filter-groups {
                flex-direction: column;
                gap: 1rem;
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
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
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
            <h1>Pièces Détachées pour Trottinettes</h1>
            <p>Trouvez toutes les pièces nécessaires pour entretenir et réparer votre trottinette électrique.</p>
        </div>

        <div class="filter-section">
            <div class="filter-header">
                <h2 class="filter-title">Filtrer les pièces</h2>
                <a href="#" class="reset-filters">
                    <i class="fas fa-undo"></i>
                    Réinitialiser
                </a>
            </div>
            
            <div class="filter-groups">
                <div class="filter-group">
                    <h3>Catégories</h3>
                    <div class="filter-options">
                        <div class="filter-option active">Toutes</div>
                        <div class="filter-option">Batteries</div>
                        <div class="filter-option">Pneus</div>
                        <div class="filter-option">Freins</div>
                        <div class="filter-option">Moteurs</div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Marques</h3>
                    <div class="filter-options">
                        <div class="filter-option">Trotty</div>
                        <div class="filter-option">Xiaomi</div>
                        <div class="filter-option">Segway</div>
                        <div class="filter-option">Dualtron</div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Prix</h3>
                    <div class="filter-options">
                        <div class="filter-option">Moins de 20€</div>
                        <div class="filter-option">20-50€</div>
                        <div class="filter-option">50-100€</div>
                        <div class="filter-option">Plus de 100€</div>
                    </div>
                </div>
            </div>
        </div>
          
        <div class="products-grid">
                    <?php foreach ($pieces as $piece): ?>
                        <div class="product-card">
                            <div class="product-image">
                        <img src="../public/uploads/image/<?= htmlspecialchars($piece['Photo'] ?? 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') ?>" >


                             
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><?= htmlspecialchars($piece['Libelle']) ?></h2>
                                <div class="product-price">Prix : <?= htmlspecialchars($piece['Prix']) ?> €</div>
                                <div class="product-price">Quantité en stock :<?= htmlspecialchars($piece['QteStock']) ?> </div>
                                <div class="product-actions">
                                <?php if (isset($_SESSION['client_id'])): ?>
                                    <a href="../controllers/PanierController.php?idp=<?=  $piece['IDPiece'] ?>" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart btn-icon"></i> Ajouter au panier
                                    </a>
                                <?php else: ?>
                                    <a href="../controllers/Client/LoginController.php" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                    </a>
                                <?php endif; ?>
                                   
                                        <a href="../controllers/DetailsellController.php?id=<?= $piece['IDPiece'] ?>" class="btn btn-secondary" onclick="event.stopPropagation()">
                                        <i class="fas fa-shopping-cart "></i> Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

        </div>
    </section>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
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
    </script>
</body>
</html>