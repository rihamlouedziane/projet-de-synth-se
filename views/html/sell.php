<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Acheter des Trottinettes Électriques</title>
  
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

        /* Updated Products Grid - 4 columns */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Fixed 4 columns */
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

        /* Enhanced Filter Section */
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
                grid-template-columns: repeat(3, 1fr); /* 3 columns on smaller screens */
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
                grid-template-columns: repeat(2, 1fr); /* 2 columns on mobile */
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
                grid-template-columns: 1fr; /* 1 column on very small screens */
            }
            
            .filter-option {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include('../layout/header.php'); ?>
    
    <section class="products-section">
        <div class="section-header">
            <h1>Nos Trottinettes à Vendre</h1>
            <p>Découvrez notre gamme complète de trottinettes électriques haut de gamme pour tous les besoins et budgets.</p>
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
                        <div class="filter-option">Puissante</div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Prix</h3>
                    <div class="filter-options">
                        <div class="filter-option">Moins de 500€</div>
                        <div class="filter-option">500-1000€</div>
                        <div class="filter-option">1000-1500€</div>
                        <div class="filter-option">Plus de 1500€</div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Autonomie</h3>
                    <div class="filter-options">
                        <div class="filter-option">Moins de 30km</div>
                        <div class="filter-option">30-50km</div>
                        <div class="filter-option">50-70km</div>
                        <div class="filter-option">Plus de 70km</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Trotty Pro X">
                    <span class="product-badge">Best Seller</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty Pro X</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 45 km/h - Autonomie 60km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 4h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 15 kg - Portée 120kg
                        </div>
                    </div>
                    <div class="product-price">1 299€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1631729371254-42c2892f0e6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Trotty City">
                    <span class="product-badge">Économique</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty City</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 25 km/h - Autonomie 35km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 3h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 12 kg - Portée 100kg
                        </div>
                    </div>
                    <div class="product-price">699€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1621891337563-85a8b4b5dc25?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Trotty Adventure">
                    <span class="product-badge">Tout-terrain</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty Adventure</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 40 km/h - Autonomie 50km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 5h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 18 kg - Portée 150kg
                        </div>
                    </div>
                    <div class="product-price">1 099€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1624623278313-a930126a11c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" alt="Trotty Lite">
                    <span class="product-badge">Compacte</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty Lite</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 20 km/h - Autonomie 25km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 2h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 9 kg - Portée 80kg
                        </div>
                    </div>
                    <div class="product-price">499€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            
            <!-- Product 5 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1593764592116-bfb2a97c642a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80" alt="Trotty Speed">
                    <span class="product-badge">Nouveau</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty Speed</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 50 km/h - Autonomie 70km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 6h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 20 kg - Portée 150kg
                        </div>
                    </div>
                    <div class="product-price">1 599€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            
            <!-- Product 6 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1624628639851-57e5a8a6d4a5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Trotty Urban">
                    <span class="product-badge">Édition limitée</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty Urban</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 30 km/h - Autonomie 45km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 3h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 14 kg - Portée 110kg
                        </div>
                    </div>
                    <div class="product-price">899€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            
            <!-- Product 7 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Trotty Fold">
                    <span class="product-badge">Pliable</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty Fold</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 25 km/h - Autonomie 30km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 3h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 11 kg - Portée 100kg
                        </div>
                    </div>
                    <div class="product-price">749€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
            </div>
            
            <!-- Product 8 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1624628639851-57e5a8a6d4a5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Trotty Pro 2">
                    <span class="product-badge">Nouvelle version</span>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Trotty Pro 2</h3>
                    <div class="product-specs">
                        <div class="spec-item">
                            <i>⚡</i> 55 km/h - Autonomie 80km
                        </div>
                        <div class="spec-item">
                            <i>⏱️</i> Charge rapide 5h
                        </div>
                        <div class="spec-item">
                            <i>⚖️</i> 22 kg - Portée 160kg
                        </div>
                    </div>
                    <div class="product-price">1 799€</div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="#" class="btn btn-secondary">Détails</a>
                    </div>
                </div>
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
                
                // Here you would typically filter the products
                // For now, this is just a UI demonstration
            });
        });
    </script>
</body>
</html>