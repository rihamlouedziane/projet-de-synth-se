<?php
if(!isset($_SESSION['client_id'])) {
    session_start();
}

// Display success/error messages
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" style="padding: 15px; margin: 20px; background: #f8d7da; color: #721c24; border-radius: 5px;">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" style="padding: 15px; margin: 20px; background: #d4edda; color: #155724; border-radius: 5px;">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Trotinette - Trotty</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/header.css">

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
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .reservation-form {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .form-title {
            font-size: 1.8rem;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-blue);
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .form-row {
            display: flex;
            gap: 1rem;
        }
        
        .form-col {
            flex: 1;
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
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--white);
            width: 100%;
        }
        
        .btn-primary:hover {
            background-color: #1a3a8f;
        }
        
        .reservation-summary {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .summary-title {
            font-size: 1.2rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
            border-bottom: 1px solid #ddd;
            padding-bottom: 0.5rem;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .summary-label {
            font-weight: 600;
        }
        
        .summary-value {
            color: var(--primary-blue);
        }
        
        .total-price {
            font-size: 1.3rem;
            font-weight: bold;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #ddd;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
        
        .alert {
            padding: 15px;
            margin: 20px;
            border-radius: 5px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        /* Ajouter ces styles */
.user-action.dropdown {
    position: relative;
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    min-width: 160px;
    z-index: 1000;
}

.dropdown-menu a {
    display: block;
    padding: 10px 15px;
    color: var(--dark-gray);
    text-decoration: none;
}

.dropdown-menu a:hover {
    background: var(--light-gray);
}

/* Quand le dropdown est actif */
.dropdown.active .dropdown-menu {
    display: block;
}
    </style>
</head>
<body>
<header class="main-header">
    <div class="header-container">
        <div class="logo-container">
            <div class="logo"><img src="../../public/images/trotty  logo grand-04.png" alt="Trotty Logo"></div>
            <div class="text-logo"><img src="../../public/images/logotext.png" alt="Trotty"></div>
        </div>

        <div class="nav-container">
            <nav class="main-nav">
                <ul>
                    <li><a href="../../Controllers/PagedaceuilleContoller.php">Accueil</a></li>
                    <li><a href="../../Controllers/TrotinettesellController.php">Acheter</a></li>
                    <li><a href="../../Controllers/TrotinetterentController.php">Louer</a></li>
                    <li><a href="../../Controllers/PieceController.php">Pièces</a></li>
             

                </ul>
            </nav>
        </div>

        <div class="user-actions">
            <div class="user-action">
                <a href="IndexPanierController.php">
                    <i class="fas fa-shopping-cart icon"></i>
                    <span class="text">Panier</span>
                    <span class="cart-count">3</span>
                </a>
            </div>

            <?php if (isset($_SESSION['nom'])): ?>
               <div class="user-action dropdown">
                <a href="#" class="dropdown-toggle">
                    <i class="fas fa-user icon"></i>
                    <span class="text"><?= htmlspecialchars($_SESSION['nom'] ?? '') ?></span>
                </a>
                <div class="dropdown-menu">
                    <a href="../../Controllers/ProfileController.php">Mon profil</a>
                    <a href="commandes.php">Mes commandes</a>
                    <a href="../../Controllers/Client/LogoutController.php">Déconnexion</a>
                </div>
            </div>
            <?php else: ?>
                <div class="user-action">
                    <a href="../../controllers/LoginController.php">
                        <i class="fas fa-user icon"></i>
                        <span class="text">Connexion</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <button class="mobile-menu-btn">☰</button>
    </div>
</header>
<div class="container">
        <div class="reservation-form">
            <h1 class="form-title">Réservation de Trotinette</h1>
            
            <div class="reservation-summary">
                <h3 class="summary-title">Récapitulatif de la location</h3>
                
                <div class="summary-item">
                    <span class="summary-label">Modèle:</span>
                    <span class="summary-value" id="product-model">Chargement...</span>
                </div>
                
                <div class="summary-item">
                    <span class="summary-label">Tarif journalier:</span>
                    <span class="summary-value" id="product-price">Chargement...</span>
                </div>
                
                <div class="summary-item">
                    <span class="summary-label">Durée:</span>
                    <span class="summary-value"><span id="joursReservation">1</span> jour(s)</span>
                </div>
                
                <div class="total-price">
                    <span>Total: </span>
                    <span id="totalReservation">0,00</span> €
                </div>
            </div>
            
            <form action="../../controllers/confirmelocaController.php" method="post" >
                <input type="hidden" name="idclient" value="<?= $_SESSION['client_id'] ?? '' ?>">
                <input type="hidden" name="idtrotinette" id="product-id">
                <input type="hidden" name="tarif" id="tarifInput">
                <input type="hidden" name="total" id="totalInput">
                <input type="hidden" name="etat" value="en attente">
                
                <div class="form-group">
                    <label for="datereservation" class="form-label">Date de réservation</label>
                    <input type="datetime-local" id="datereservation" name="datereservation" class="form-control" required 
                           value="<?= date('Y-m-d\TH:i') ?>">
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="datedebut" class="form-label">Date de début</label>
                            <input type="datetime-local" id="datedebut" name="datedebut" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="datefin" class="form-label">Date de fin</label>
                            <input type="datetime-local" id="datefin" name="datefin" class="form-control" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="jours" class="form-label">Nombre de jours</label>
                    <div style="display: flex; align-items: center;">
                        <button type="button" class="btn" onclick="adjustDays(-1)" style="width: 40px;">-</button>
                        <input type="number" id="jours" name="jours" class="form-control" 
                               style="text-align: center; margin: 0 10px;" 
                               value="1" min="1" max="30" readonly>
                        <button type="button" class="btn" onclick="adjustDays(1)" style="width: 40px;">+</button>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" id="Btn-submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
// Remplacer le code existant par ceci
document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');

    if (dropdownToggle && dropdown) {
        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            dropdown.classList.toggle('active');
        });

        // Fermer le menu quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    }

    // Gestion du menu mobile
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            document.querySelector('.main-nav').classList.toggle('active');
        });
    }
}); const product = getProductFromLocalStorage();
        if (!product) {
            alert('Aucun produit sélectionné. Vous allez être redirigé.');
            window.location.href = '../Controller/TrotinettesrentController.php';
        }
        
        // Écouteur d'événement pour le bouton
    //    document.getElementById('Btn-submit').addEventListener('click', function() {
    //     console.log('Button clicked');
    //         // Vérifier si le produit est sélectionné
    //         if (!product) {
    //             alert('Aucun produit sélectionné. Vous allez être redirigé.');
    //             return;
    //         }

    //         // fetch('../../controllers/reservecontroller.php', {
    //         //     method: 'POST',
    //         //     headers: {
    //         //         'Content-Type': 'application/json'
    //         //     },
    //         //     body: JSON.stringify(product)
    //         // }).then(response => response.text())
    //         //      .then(result => {
    //         //      console.log('Server response:', result);
    //         //     });

    //         const submitBtn = document.getElementById('submitBtn');
    //         submitBtn.disabled = true;
    //         submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
            
    //         // In a real application, you would send this data to your server
            
    //         // Simulate API call
    //         setTimeout(function() {
    //             // On success, redirect to confirmation page
    //             window.location.href = 'ConfirmelocaController.php';
                
    //             // In case of error, you would re-enable the button and show an error message
    //             // submitBtn.disabled = false;
    //             // submitBtn.innerHTML = 'Poursuivre';
    //             // alert('Une erreur est survenue. Veuillez réessayer.');
    //         }, 1500);
    //     });
        // Récupérer les données du produit depuis le localStorage
        function getProductFromLocalStorage() {
            const productData = localStorage.getItem('selectedProduct');
            
            if (!productData) {
                alert('Aucun produit sélectionné. Vous allez être redirigé.');
                window.location.href = '../Controller/TrotinettesrentController.php';
                return null;
            }
            
            return JSON.parse(productData);
        }
        
        // Afficher les données du produit
        function displayProductInfo() {
        //    const product = getProductFromLocalStorage();
            
            if (!product) return;
            
            // Mettre à jour les éléments de la page
            document.getElementById('product-model').textContent = product.name;
            document.getElementById('product-price').textContent = 
                product.price.toFixed(2).replace('.', ',') + ' €';
            document.getElementById('product-id').value = product.id;
            document.getElementById('tarifInput').value = product.price;
            
            // Initialiser les calculs
            updateDaysAndTotal();
        }
        
        // Prix unitaire de la trotinette
        let tarifJournalier = 0;
        
        // Éléments du DOM
        const joursInput = document.getElementById('jours');
        const joursReservation = document.getElementById('joursReservation');
        const totalReservation = document.getElementById('totalReservation');
        const tarifInput = document.getElementById('tarifInput');
        const totalInput = document.getElementById('totalInput');
        const dateDebutInput = document.getElementById('datedebut');
        const dateFinInput = document.getElementById('datefin');
        
        // Initialiser les dates
        function initDates() {
            const now = new Date();
            const debut = new Date(now.getTime() + 60 * 60 * 1000); // 1 heure plus tard
            
            // Formater pour l'input datetime-local
            dateDebutInput.value = formatDateTimeLocal(debut);
            
            // Calculer la date de fin (1 jour plus tard)
            const fin = new Date(debut);
            fin.setDate(fin.getDate() + parseInt(joursInput.value));
            dateFinInput.value = formatDateTimeLocal(fin);
        }
        
        // Formater une date pour datetime-local
        function formatDateTimeLocal(date) {
            const offset = date.getTimezoneOffset() * 60000;
            const localISOTime = (new Date(date - offset)).toISOString().slice(0, 16);
            return localISOTime;
        }
        
        // Calculer la différence en jours entre deux dates
        function calculateDaysBetween(start, end) {
            const diffTime = Math.abs(new Date(end) - new Date(start));
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        }
        
        // Mettre à jour le nombre de jours et le total
        function updateDaysAndTotal() {
            const product = getProductFromLocalStorage();
            if (!product) return;
            
            tarifJournalier = product.price;
            const jours = parseInt(joursInput.value);
            const total = tarifJournalier * jours;
            
            joursReservation.textContent = jours;
            totalReservation.textContent = total.toFixed(2).replace('.', ',');
            totalInput.value = total;
        }
        
        // Ajuster le nombre de jours
        function adjustDays(change) {
            let newValue = parseInt(joursInput.value) + change;
            if (newValue < 1) newValue = 1;
            if (newValue > 30) newValue = 30;
            
            joursInput.value = newValue;
            updateDaysAndTotal();
            
            // Mettre à jour la date de fin
            if (dateDebutInput.value && dateFinInput.value) {
                const startDate = new Date(dateDebutInput.value);
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + newValue);
                dateFinInput.value = formatDateTimeLocal(endDate);
            }
        }
        
        // Écouteurs d'événements
        dateDebutInput.addEventListener('change', function() {
            if (dateFinInput.value) {
                const joursCalcules = calculateDaysBetween(this.value, dateFinInput.value);
                if (joursCalcules > 0) {
                    joursInput.value = joursCalcules;
                    updateDaysAndTotal();
                }
            }
        });
        
        dateFinInput.addEventListener('change', function() {
            if (dateDebutInput.value) {
                const joursCalcules = calculateDaysBetween(dateDebutInput.value, this.value);
                if (joursCalcules > 0) {
                    joursInput.value = joursCalcules;
                    updateDaysAndTotal();
                } else {
                    alert("La date de fin doit être postérieure à la date de début");
                    const startDate = new Date(dateDebutInput.value);
                    const endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + parseInt(joursInput.value));
                    this.value = formatDateTimeLocal(endDate);
                }
            }
        });
        
        // Initialiser la page
        document.addEventListener('DOMContentLoaded', function() {
            displayProductInfo();
            initDates();
            
            // Set the client ID in the hidden field if logged in
            <?php if (isset($_SESSION['client_id'])): ?>
                document.querySelector('input[name="idclient"]').value = <?= $_SESSION['client_id'] ?>;
            <?php endif; ?>
            
            // Vérifier si on vient de la page de détail avec des données en localStorage
            const fromDetail = localStorage.getItem('fromProductDetail');
            if (fromDetail) {
                localStorage.removeItem('fromProductDetail');
            }
        });
    </script>
    
</body>
</html>