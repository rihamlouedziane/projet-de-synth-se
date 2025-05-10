<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Acheter des Trottinettes Électriques</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/sell.css">

    <style>
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            text-align: center;
            animation: modalSlideIn 0.3s ease-out;
        }
        @keyframes modalSlideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .modal-buttons {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        .modal-button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .confirm-btn {
            background: #2ecc71;
            color: white;
        }
        .confirm-btn:hover {
            background: #27ae60;
        }
        .cancel-btn {
            background: #e74c3c;
            color: white;
        }
        .cancel-btn:hover {
            background: #c0392b;
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
            <a href="sell.php" class="reset-filters"><i class="fas fa-undo"></i> Réinitialiser</a>
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
        <div class="error-message"><?= htmlspecialchars($errorMessage) ?></div>
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
                        <img src="../public/uploads/image/<?= htmlspecialchars($trott['Photo'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($trott['Libelle']) ?>">
                        <?php if (($trott['IsBestSeller'] ?? rand(0, 5)) == 1): ?>
                            <span class="product-badge">Best Seller</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?= htmlspecialchars($trott['Libelle']) ?></h3>
                        <div class="product-specs">
                            <div class="spec-item"><i class="fas fa-bolt"></i> Vitesse: <?= round($trott['Puissance'] / 10) ?> km/h</div>
                            <div class="spec-item"><i class="fas fa-battery-full"></i> Autonomie: <?= htmlspecialchars($trott['Autonomie']) ?> km</div>
                        </div>
                        <div class="product-price"><?= number_format($trott['Tarif'], 0, ',', ' ') ?> €</div>
                        <div class="product-actions">
                            <?php if (isset($_SESSION['client_id'])): ?>
                                <a href="../controllers/BuyController.php?id=<?= $trott['IDTrotinette'] ?>" 
                               class="btn btn-success buy-btn"
                               data-product-name="<?= htmlspecialchars($trott['Libelle']) ?>">
                                <i class="fas fa-credit-card"></i> Acheter
                            </a>
                                <a href="../controllers/PanierController.php?id=<?= $trott['IDTrotinette'] ?>" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                </a>
                            <?php else: ?>
                                 <a href="../controllers/BuyController.php?id=<?= $trott['IDTrotinette'] ?>" 
                                    class="btn btn-success buy-btn"
                                    data-product-name="<?= htmlspecialchars($trott['Libelle']) ?>">
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

<!-- Modal HTML (si utilisé dans le futur) -->
<div class="confirmation-modal" id="confirmationModal">
    <div class="modal-content">
        <p id="confirmationMessage">Êtes-vous sûr ?</p>
        <div class="modal-buttons">
            <button class="modal-button confirm-btn" id="confirmBtn">Oui</button>
            <button class="modal-button cancel-btn" id="cancelBtn">Annuler</button>
        </div>
    </div>
</div>
<div class="confirmation-modal" id="confirmationModal">
    <div class="modal-content">
        <h3>Confirmer l'achat</h3>
        <p id="confirmationMessage"></p>
        <div class="modal-buttons">
            <button class="modal-button confirm-btn" id="confirmBtn">Confirmer</button>
            <button class="modal-button cancel-btn" id="cancelBtn">Annuler</button>
        </div>
    </div>
</div>

<script>
    // Gestion future du modal (non activé actuellement)
    const buyButtons = document.querySelectorAll('.buy-btn');
    const confirmationModal = document.getElementById('confirmationModal');
    const confirmationMessage = document.getElementById('confirmationMessage');
    let currentHref = '';

    buyButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            currentHref = this.href;
            const productName = this.dataset.productName;
            confirmationMessage.textContent = `Êtes-vous sûr de vouloir acheter "${productName}" ?`;
            confirmationModal.style.display = 'flex';
        });
    });

    document.getElementById('confirmBtn')?.addEventListener('click', () => {
        window.location.href = currentHref;
    });

    document.getElementById('cancelBtn')?.addEventListener('click', () => {
        confirmationModal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === confirmationModal) {
            confirmationModal.style.display = 'none';
        }
    });

    // Menu mobile
    document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
        document.querySelector('.main-nav').classList.toggle('active');
    });
</script>

</body>
</html>
