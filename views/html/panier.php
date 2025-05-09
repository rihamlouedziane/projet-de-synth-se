<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Trotty - Vente et Location de Trottinettes Électriques</title>
    <link rel="stylesheet" href="../public/css/panier.css">
 
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php if (isset($_SESSION['client_id'])): ?>
    <?php include('../views/html/dashboardclient/headerCP.php'); ?>
<?php else: ?>
    <?php include('../views/layout/header1.php'); ?>
<?php endif; ?>
    

    <?php
    // Calculate totals
    $subtotal = 0;
    $total = 0;
    
    if (!empty($paniers)) {
        foreach ($paniers as $panier) {
            $subtotal += $panier['Quantite'] * $panier['Tarif'];
        }
        $total = $subtotal; // Add shipping costs here if needed
    }
    ?>
    
    <section class="cart-hero">
        <div class="container">
            <h1>Votre Panier</h1>
            <p>Revoyez vos articles avant de passer à la caisse</p>
        </div>
    </section>
    
    <div class="container cart-container">
        <div class="cart-items">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cartItemsContainer">

                    <?php if (!empty($paniers)) : ?>
                        <?php foreach ($paniers as $panier) : 
                            $isPiece = !is_null($panier['IDPiece']);
                            $prixTotal = $panier['Quantite'] * $panier['Tarif'];
                        ?>
                            <tr>
                                <td class="product-cell">
                                    <div class="product-image">
                                        <img src="../public/uploads/image/<?= htmlspecialchars($panier['modele_photo'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($panier['modele_nom']) ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="product-info">
                                        <h4>
                                            <?= $isPiece 
                                                ? $panier['piece_reference'] 
                                                : $panier['modele_nom'] ?>
                                        </h4>
                                        <?php if (!$isPiece) : ?>
                                            <p>Numéro de série : <?= $panier['NumSerie'] ?></p>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="price"><?= number_format($panier['Tarif'], 2, ',', ' ') ?>€</td>
                                <td class="quantity-control">
                                    <button class="quantity-btn">-</button>
                                    <input type="number" class="quantity-input" value="<?= $panier['Quantite'] ?>" min="1">
                                    <button class="quantity-btn">+</button>
                                </td>
                                <td class="price"><?= number_format($prixTotal, 2, ',', ' ') ?>€</td>
                                <td>
                                    <a href="SuprimerPanierController.php?idPanier=<?= $panier['IDPanier'] ?>" 
                                       class="remove-link" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="empty-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <h3>Votre panier est vide</h3>
                                <p>Commencez par ajouter des produits à votre panier</p>
                                <a href="sell.php" class="btn">Voir nos produits</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="cart-summary">
            <div class="summary-card">
                <h3>Résumé de la commande</h3>
                
                <div class="summary-row">
                    <span>Sous-total</span>

                    <span id="summarySubtotal"><?= number_format($subtotal, 2, ',', ' ') ?>€</span>
                </div>
                
                <div class="summary-row">
                    <span>Livraison</span>
                    <span>Gratuite</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="summaryTotal"><?= number_format($total, 2, ',', ' ') ?>€</span>
                </div>
                
                <button class="checkout-btn" id="checkoutBtn">Passer la commande</button>
                
                <a href="sell.php" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i> Continuer vos achats
                </a>
            </div>
        </div>
    </div>


<?php include('../views/layout/footer.php'); ?>
  

    <script>
// Function to update totals when quantity changes
function updateTotals() {
    let newSubtotal = 0;

    // Calculate new subtotal from all items
    document.querySelectorAll('tbody tr').forEach(row => {
        if (!row.querySelector('.empty-cart')) {
            const priceText = row.querySelector('td:nth-child(3)').textContent;
            const price = parseFloat(priceText.replace(',', '.').replace('€', ''));
            const quantity = parseInt(row.querySelector('.quantity-input').value);
            newSubtotal += price * quantity;
            
            // Update row total
            const rowTotal = price * quantity;
            row.querySelector('td:nth-child(5)').textContent = rowTotal.toFixed(2).replace('.', ',') + '€';
        }
    });

    // Save totals to localStorage
    localStorage.setItem('subtotal', newSubtotal.toFixed(2));
    localStorage.setItem('total', newSubtotal.toFixed(2)); // You can add shipping costs here if needed

    // Update summary
    document.getElementById('summarySubtotal').textContent = newSubtotal.toFixed(2).replace('.', ',') + '€';
    document.getElementById('summaryTotal').textContent = newSubtotal.toFixed(2).replace('.', ',') + '€';

    return newSubtotal;
}

// Handle quantity button clicks
document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.quantity-input');
        let quantity = parseInt(input.value);
        
        if (this.textContent === '+') {
            quantity += 1;
        } else {
            quantity = Math.max(1, quantity - 1);
        }
        
        input.value = quantity;
        updateTotals();
    });
});

// Handle direct input changes
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        const quantity = Math.max(1, parseInt(this.value) || 1);
        this.value = quantity;
        updateTotals();
    });
});

// Initialize totals on page load
document.addEventListener('DOMContentLoaded', function() {
    const savedSubtotal = localStorage.getItem('subtotal');
    const savedTotal = localStorage.getItem('total');

    if (savedSubtotal && savedTotal) {
        document.getElementById('summarySubtotal').textContent = savedSubtotal.replace('.', ',') + '€';
        document.getElementById('summaryTotal').textContent = savedTotal.replace('.', ',') + '€';
    } else {
        updateTotals(); // Ensure totals are calculated if not in localStorage
    }
});

document.getElementById('checkoutBtn').addEventListener('click', function() {
    window.location.href = '../controllers/PaiementController.php';
});

    
    </script>
    <?php include('../views/layout/footer.php'); ?>
</body>
</html>