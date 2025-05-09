<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Pièces Détachées pour Trottinettes</title>
    <link rel="stylesheet" href="../public/css/piece.css">
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
<?php include('../views/layout/footer.php'); ?>

</body>
</html>