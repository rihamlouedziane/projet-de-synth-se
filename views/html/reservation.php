<?php
if(!isset($_SESSION['client_id'])) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Trotinette - Trotty</title>
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
    </style>
</head>
<body>
<?php if (isset($_SESSION['client_id'])): ?>
    <?php include('dashboardclient/headerCP.php'); ?>
<?php else: ?>
    <?php include('../views/layout/header1.php'); ?>
<?php endif; ?>
    
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
            
            <form action="../controllers/ReservationController.php" method="POST">
                <input type="hidden" name="idtrotinette" id="product-id">
                <input type="hidden" name="tarif" id="tarifInput">
                <input type="hidden" name="total" id="totalInput">
                
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
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
            const product = getProductFromLocalStorage();
            
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
            return date.toISOString().slice(0, 16);
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
            
            // Vérifier si on vient de la page de détail avec des données en localStorage
            const fromDetail = localStorage.getItem('fromProductDetail');
            if (fromDetail) {
                localStorage.removeItem('fromProductDetail');
            }
        });
    </script>
</body>
</html>