<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Trotty - Vente et Location de Trottinettes Électriques</title>
    <link rel="stylesheet" href="../public/css/panier.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php if (isset($_SESSION['client_id'])): ?>
        <?php include('../views/html/dashboardclient/headerCP.php'); ?>
    <?php else: ?>
        <?php include('../views/layout/header1.php'); ?>
    <?php endif; ?>

    <?php
    // Calculate totals from cart items
    $subtotal = 0;
    $total = 0;
    
    if (!empty($paniers)) {
        foreach ($paniers as $panier) {
            $subtotal += $panier['Quantite'] * $panier['Tarif'];
        }
        $total = $subtotal; // Add shipping costs here if needed
        
        // Store totals in session for confirmation
        $_SESSION['cart_totals'] = [
            'subtotal' => $subtotal,
            'total' => $total
        ];
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
                    <?php if (!empty($paniers)): ?>
                        <?php foreach ($paniers as $panier): 
                            $isPiece = isset($panier['IDPiece']);
                            $prixTotal = $panier['Quantite'] * $panier['Tarif'];
                        ?>
                            <tr data-id="<?= $panier['IDPanier'] ?>">
                                <td class="product-cell">
                                    <div class="product-image">
                                        <img src="../public/uploads/image/<?= htmlspecialchars($panier['modele_photo'] ?? 'default.jpg') ?>" 
                                             alt="<?= htmlspecialchars($panier['modele_nom'] ?? $panier['piece_reference']) ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="product-info">
                                        <h4>
                                            <?= $isPiece 
                                                ? htmlspecialchars($panier['piece_reference'])
                                                : htmlspecialchars($panier['modele_nom']) ?>
                                        </h4>
                                        <?php if (!$isPiece): ?>
                                            <p>Numéro de série : <?= htmlspecialchars($panier['NumSerie']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="price" data-price="<?= $panier['Tarif'] ?>">
                                    <?= number_format($panier['Tarif'], 2, ',', ' ') ?>€
                                </td>
                                <td class="quantity-control">
                                    <form method="post" action="UpdatePanierController.php" class="quantity-form">
                                        <input type="hidden" name="idPanier" value="<?= $panier['IDPanier'] ?>">
                                        <button type="submit" name="action" value="decrease" class="quantity-btn">-</button>
                                        <input type="number" name="quantity" class="quantity-input" 
                                               value="<?= $panier['Quantite'] ?>" min="1" readonly>
                                        <button type="submit" name="action" value="increase" class="quantity-btn">+</button>
                                    </form>
                                </td>
                                <td class="price item-total">
                                    <?= number_format($prixTotal, 2, ',', ' ') ?>€
                                </td>
                                <td>
                                    <a href="SuprimerPanierController.php?idPanier=<?= $panier['IDPanier'] ?>" 
                                       class="remove-link" 
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
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
                
                <?php if (!empty($paniers)): ?>
                    <a href="../controllers/PaiementController.php" class="checkout-btn" id="checkoutBtn">
                        Passer la commande
                    </a>
                <?php else: ?>
                    <button class="checkout-btn" disabled>Passer la commande</button>
                <?php endif; ?>
                
                <a href="sell.php" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i> Continuer vos achats
                </a>
            </div>
        </div>
    </div>

    <?php include('../views/layout/footer.php'); ?>

    <script>
        // Function to format currency
        function formatCurrency(amount) {
            return amount.toFixed(2).replace('.', ',') + '€';
        }

        // Update cart totals when quantity changes (for client-side calculation)
        function updateCartTotals() {
            let subtotal = 0;
            
            document.querySelectorAll('tbody tr[data-id]').forEach(row => {
                const price = parseFloat(row.querySelector('.price[data-price]').dataset.price);
                const quantity = parseInt(row.querySelector('.quantity-input').value);
                const itemTotal = price * quantity;
                
                // Update row total display
                row.querySelector('.item-total').textContent = formatCurrency(itemTotal);
                
                subtotal += itemTotal;
            });
            
            // Update summary
            document.getElementById('summarySubtotal').textContent = formatCurrency(subtotal);
            document.getElementById('summaryTotal').textContent = formatCurrency(subtotal);
            
            return subtotal;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // If cart is not empty, calculate totals
            if (document.querySelector('tbody tr[data-id]')) {
                updateCartTotals();
            }
        });
    </script>
</body>
</html>