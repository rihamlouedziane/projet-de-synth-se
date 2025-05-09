
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - Trotty</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../public/css/paiment.css">
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
    
    <section class="payment-hero">
        <div class="container">
            <h1>Finalisez votre commande</h1>
            <p>Choisissez votre méthode de paiement et confirmez votre achat</p>
        </div>
    </section>

    <div class="container">
        <div class="payment-container">
            <div class="payment-methods">
                <div class="payment-option active" id="creditCardOption">
                    <div class="payment-header" onclick="togglePayment('creditCard')">
                        <div class="payment-icon">
                            <i class="far fa-credit-card"></i>
                        </div>
                        <h3>Paiement par carte</h3>
                    </div>
                    
                    <div class="credit-card-form active" id="creditCardForm">
                        <div class="card-icons">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg" class="card-icon" alt="Visa">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mastercard/mastercard-original.svg" class="card-icon" alt="Mastercard">
                        </div>
                        
                        <form id="paymentForm" >
                            <div class="form-group">
                                <label for="cardNumber">Numéro de carte</label>
                                <input type="text" id="cardNumber" name="cardNumber" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19" >
                            </div>
                            
                            <div class="form-group">
                                <label for="cardName">Nom sur la carte</label>
                                <input type="text" id="cardName" name="cardName" class="form-control" placeholder="John Doe" >
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiryDate">Date d'expiration</label>
                                    <input type="text" id="expiryDate" name="expiryDate" class="form-control" placeholder="MM/AA" maxlength="5" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123" maxlength="3" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="payment-option" id="cashOnDeliveryOption">
                    <div class="payment-header" onclick="togglePayment('cashOnDelivery')">
                        <div class="payment-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Paiement à la livraison</h3>
                    </div>
                    
                    <div class="cash-on-delivery-info" id="cashOnDeliveryInfo" style="display: none;">
                        <p>Vous paierez en espèces lorsque le livreur vous remettra votre commande.</p>
                        <p><strong>Frais de service:</strong> 2,00€</p>
                    </div>
                </div>
            </div>
            
            <div class="order-summary">
                <div class="summary-card">
                    <h2>Résumé de la commande</h2>
                    
                    <div class="summary-item">
                        <span>Sous-total</span>
                       <span id="summarySubtotal"><?= number_format($subtotal, 2, ',', ' ') ?>€</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    
                    <div class="summary-item">
                        <span>Frais de service</span>
                        <span id="serviceFee">0,00€</span>
                    </div>
                    
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span id="summaryTotal"><?= number_format($total, 2, ',', ' ') ?>€</span>
                    </div>
                    
                    <button type="submit" class="submit-btn" id="submitBtn">
                        Poursuivre
                    </button>
                    
                    <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem;">
                        <i class="fas fa-lock"></i> Paiement sécurisé SSL
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle between payment methods
        function togglePayment(method) {
            // Toggle active class on options
            document.getElementById('creditCardOption').classList.remove('active');
            document.getElementById('cashOnDeliveryOption').classList.remove('active');
            document.getElementById(method + 'Option').classList.add('active');
            
            // Toggle form/info visibility
            document.getElementById('creditCardForm').style.display = 'none';
            document.getElementById('cashOnDeliveryInfo').style.display = 'none';
            
            if (method === 'creditCard') {
                document.getElementById('creditCardForm').style.display = 'block';
                document.getElementById('serviceFee').textContent = '0,00€';
                document.getElementById('orderTotal').textContent = '249,99€';
            } else {
                document.getElementById('cashOnDeliveryInfo').style.display = 'block';
                document.getElementById('serviceFee').textContent = '2,00€';
                document.getElementById('orderTotal').textContent = '251,99€';
            }
        }
        
        // Format card number input
       /* document.getElementById('cardNumber').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '');
            if (value.length > 0) {
                value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
            }
            e.target.value = value;
        });
        
        // Format expiry date input
        document.getElementById('expiryDate').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
        
        // Form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable button during processing
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
            
            // Simulate payment processing
            setTimeout(function() {
                // In a real app, you would send the data to your server here
                alert('Paiement réussi! Votre commande a été passée.');
                submitBtn.innerHTML = 'Paiement réussi!';
                
                // Redirect to confirmation page
                window.location.href = 'confirmation.php';
            }, 2000);
        });*/
        document.getElementById('submitBtn').addEventListener('click', function() {
            window.location.href = 'ConfirmeController.php';
      
        });
      /*  .then(data => {
            console.log(data);
            if (data.success) {
                window.location.href = '../confirmation.php';
            } else {
                alert('Erreur: ' + data.message);
            }
        });*/
       
   
    </script>
</body>
</html>