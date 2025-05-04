<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Trotty - Vente et Location de Trottinettes Électriques</title>
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
            line-height: 1.6;
            color: #333;
            background-color: var(--light-gray);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Cart Page Specific Styles */
        .cart-hero {
            background: linear-gradient(rgba(10, 36, 99, 0.85), rgba(10, 36, 99, 0.85)), 
                        url('https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            padding: 3rem 2rem;
            text-align: center;
            color: var(--white);
        }

        .cart-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .cart-hero p {
            font-size: 1.2rem;
        }

        .cart-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
            display: flex;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .cart-items {
            flex: 2;
            min-width: 300px;
        }

        .cart-summary {
            flex: 1;
            min-width: 300px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .cart-table th {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 1.2rem;
            text-align: left;
        }

        .cart-table td {
            padding: 1.2rem;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .cart-table tr:last-child td {
            border-bottom: none;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .product-image {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info h4 {
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }

        .product-info p {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--light-gray);
            border: none;
            color: var(--primary-blue);
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .remove-btn {
            color: #ff4444;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            transform: scale(1.2);
        }

        .price {
            font-weight: 600;
            color: var(--primary-blue);
        }

        /* Summary Card */
        .summary-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .summary-card h3 {
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .summary-row.total {
            font-weight: 600;
            font-size: 1.2rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .checkout-btn {
            width: 100%;
            padding: 1.2rem;
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }

        .checkout-btn:hover {
            background-color: #1a3a8f;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.2);
        }

        .continue-shopping {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .continue-shopping:hover {
            color: var(--primary-yellow);
            text-decoration: underline;
        }

        .empty-cart {
            text-align: center;
            padding: 5rem 0;
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .empty-cart i {
            font-size: 5rem;
            color: var(--primary-blue);
            margin-bottom: 2rem;
            opacity: 0.5;
        }

        .empty-cart h3 {
            color: var(--primary-blue);
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .empty-cart p {
            color: var(--dark-gray);
            margin-bottom: 2rem;
        }

        .empty-cart .btn {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: var(--primary-blue);
            color: var(--white);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .empty-cart .btn:hover {
            background-color: #1a3a8f;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.2);
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .cart-container {
                flex-direction: column;
            }
        }

        @media (max-width: 768px) {
            .cart-hero h1 {
                font-size: 2rem;
            }
            
            .cart-hero p {
                font-size: 1rem;
            }
            
            .product-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .product-image {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 480px) {
            .cart-table thead {
                display: none;
            }
            
            .cart-table tr {
                display: block;
                margin-bottom: 1.5rem;
                border-bottom: 2px solid #eee;
            }
            
            .cart-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.8rem;
                border-bottom: 1px solid #eee;
            }
            
            .cart-table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--primary-blue);
                margin-right: 1rem;
            }
            
            .quantity-control {
                justify-content: space-between;
                width: 100%;
            }
            
            .empty-cart {
                padding: 3rem 1.5rem;
            }
            
            .empty-cart i {
                font-size: 3rem;
            }
            
            .empty-cart h3 {
                font-size: 1.5rem;
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
                    <img src="../public/uploads/image/<?= htmlspecialchars($panier['modele_photo'] ?? 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') ?>" >

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
        <tr><td colspan="6" class="empty-cart">Votre panier est vide.</td></tr>
    <?php endif; ?>
</tbody>

            </table>
        </div>
        
        <div class="cart-summary">
            <div class="summary-card">
                <h3>Résumé de la commande</h3>
                
                <div class="summary-row">
                    <span>Sous-total</span>
                    <span id="summarySubtotal">0€</span>
                </div>
                
                <div class="summary-row">
                    <span>Livraison</span>
                    <span>Gratuite</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="summaryTotal">0€</span>
                </div>
                
                <button class="checkout-btn" id="checkoutBtn">Passer la commande</button>
                
                <a href="sell.php" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i> Continuer vos achats
                </a>
            </div>
        </div>
    </div>

  
</body>
</html>