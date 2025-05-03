<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define absolute paths
$rootPath = dirname(__DIR__, 2);

// Include required files
require_once $rootPath . '/config/database.php';
require_once $rootPath . '/Models/Trotinette.php';
require_once $rootPath . '/Controllers/TrotinetteController.php';

// Get product ID from URL
$productId = $_GET['id'] ?? 0;

try {
    $controller = new TROTYY\Controllers\TrotinetteController();
    $product = $controller->getProductDetails($productId);
    
    if (!$product) {
        throw new Exception("Product not found");
    }
} catch (Exception $e) {
    // Handle errors
    error_log("Error loading product: " . $e->getMessage());
    header("Location: sell.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['Libelle']) ?> - Trotty</title>
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
            line-height: 1.6;
            color: #333;
            background-color: var(--light-gray);
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .product-detail {
            display: flex;
            flex-wrap: wrap;
            gap: 3rem;
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .product-gallery {
            flex: 1;
            min-width: 300px;
        }
        
        .main-image {
            width: 100%;
            height: 400px;
            object-fit: contain;
            background: var(--light-gray);
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        
        .thumbnail-container {
            display: flex;
            gap: 1rem;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .thumbnail:hover, .thumbnail.active {
            border-color: var(--primary-blue);
        }
        
        .product-info {
            flex: 1;
            min-width: 300px;
        }
        
        .product-title {
            font-size: 2rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        
        .product-price {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-blue);
            margin: 1.5rem 0 0.5rem 0;
        }
        
        .total-price {
            font-weight: bold;
            color: var(--primary-blue);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .total-price span {
            color: var(--primary-yellow);
        }
        
        .product-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .badge-yellow {
            background-color: var(--primary-yellow);
            color: var(--dark-gray);
        }
        
        .product-description {
            margin-bottom: 2rem;
            line-height: 1.8;
        }
        
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .spec-item {
            display: flex;
            align-items: center;
        }
        
        .spec-item i {
            margin-right: 0.8rem;
            color: var(--primary-blue);
            width: 20px;
            text-align: center;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }
        
        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--white);
            flex: 1;
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
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            background: var(--light-gray);
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 0.5rem;
        }
        
        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column;
            }
            
            .specs-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php include('../layout/header.php'); ?>
    
    <div class="container">
        <a href="sell.php" class="back-link" style="display: inline-block; margin-bottom: 1rem; color: var(--primary-blue); text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Retour aux produits
        </a>
        
        <div class="product-detail">
            <div class="product-gallery">
                <img src="<?= htmlspecialchars($product['ImageURL'] ?? 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') ?>" 
                     alt="<?= htmlspecialchars($product['Libelle']) ?>" class="main-image" id="mainImage">
                
                <div class="thumbnail-container">
                    <img src="<?= htmlspecialchars($product['ImageURL'] ?? 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') ?>" 
                         alt="<?= htmlspecialchars($product['Libelle']) ?>" class="thumbnail active">
                    <!-- Additional thumbnails can be added here -->
                </div>
            </div>
            
            <div class="product-info">
                <h1 class="product-title"><?= htmlspecialchars($product['Libelle']) ?></h1>
                
                <?php if ($product['IsBestSeller'] ?? false): ?>
                    <div class="badge badge-yellow">Best Seller</div>
                <?php endif; ?>
                
                <div class="product-price"><?= number_format($product['Tarif'], 0, ',', ' ') ?> €</div>
                <div class="total-price">Total: <span id="totalPrice"><?= number_format($product['Tarif'], 0, ',', ' ') ?></span> €</div>
                
                <div class="product-description">
                    <p><?= nl2br(htmlspecialchars($product['Description'] ?? 'Trottinette électrique haut de gamme offrant performance et confort.')) ?></p>
                </div>
                
                <div class="specs-grid">
                    <div class="spec-item">
                        <i class="fas fa-bolt"></i>
                        <span>Puissance: <?= $product['Puissance'] ?? 'N/A' ?> W</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Vitesse max: <?= round($product['Puissance'] / 10) ?? 'N/A' ?> km/h</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-battery-full"></i>
                        <span>Autonomie: <?= $product['Autonomie'] ?? 'N/A' ?> km</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-weight-hanging"></i>
                        <span>Poids: <?= $product['Poids'] ?? 'N/A' ?> kg</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-clock"></i>
                        <span>Temps de charge: <?= $product['TempsCharge'] ?? 'N/A' ?> heures</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-road"></i>
                        <span>Type: <?= $product['Type'] ?? 'N/A' ?></span>
                    </div>
                </div>
                
                <div class="quantity-selector">
                    <label for="quantity">Quantité:</label>
                    <button class="quantity-btn minus" type="button">-</button>
                    <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="10">
                    <button class="quantity-btn plus" type="button">+</button>
                </div>
                
                <div class="action-buttons">
                    <button class="btn btn-primary" id="addToCart">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                    <a href="achat.php?id=<?= $product['IDTrotinette'] ?>" class="btn btn-secondary">
                        <i class="fas fa-credit-card"></i> Acheter maintenant
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    // Get the initial price from PHP
    const unitPrice = <?= $product['Tarif'] ?>;
    const totalPriceElement = document.getElementById('totalPrice');
    const quantityInput = document.getElementById('quantity');
    const productId = <?= $product['IDTrotinette'] ?>;
    const productName = '<?= htmlspecialchars(addslashes($product['Libelle'])) ?>';
    const productImage = '<?= htmlspecialchars($product['ImageURL'] ?? 'https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') ?>';

    // Function to update the total price
    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value);
        const totalPrice = unitPrice * quantity;
        totalPriceElement.textContent = formatPrice(totalPrice);
    }

    // Helper function to format price with spaces (10000 -> 10 000)
    function formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

    // Update price when quantity changes
    quantityInput.addEventListener('change', updateTotalPrice);
    quantityInput.addEventListener('input', updateTotalPrice);

    // Update price when plus/minus buttons are clicked
    document.querySelector('.quantity-btn.minus').addEventListener('click', function() {
        if (quantityInput.value > 1) {
            quantityInput.value--;
            updateTotalPrice();
        }
    });

    document.querySelector('.quantity-btn.plus').addEventListener('click', function() {
        if (quantityInput.value < 10) {
            quantityInput.value++;
            updateTotalPrice();
        }
    });

    // Add to cart functionality
    document.getElementById('addToCart').addEventListener('click', function() {
        const quantity = parseInt(quantityInput.value);
        const totalPrice = unitPrice * quantity;
        
        // Get existing cart items from localStorage or initialize empty array
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        
        // Check if product already exists in cart
        const existingItemIndex = cartItems.findIndex(item => item.id === productId);
        
        if (existingItemIndex !== -1) {
            // Update quantity if product already in cart
            cartItems[existingItemIndex].quantity += quantity;
        } else {
            // Add new item to cart
            cartItems.push({
                id: productId,
                name: productName,
                price: unitPrice,
                quantity: quantity,
                image: productImage
            });
        }
        
        // Save updated cart to localStorage
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        
        // Show success message
        alert(`Ajouté au panier: ${quantity} x ${productName} (Total: ${formatPrice(totalPrice)} €)`);
        
        // Optional: Update cart count in header
        updateCartCount();
    });

    // Function to update cart count in header
    function updateCartCount() {
        const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
        
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = totalItems;
            el.style.display = totalItems > 0 ? 'inline-block' : 'none';
        });
    }

    // Image gallery functionality
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));
            // Add active class to clicked thumbnail
            this.classList.add('active');
            // Update main image
            mainImage.src = this.src;
        });
    });

    // Initialize the total price on page load
    updateTotalPrice();
    
    // Update cart count on page load
    updateCartCount();
</script>
</body>
</html>