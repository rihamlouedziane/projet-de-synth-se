<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de commande</title>
    <style>
         :root {
            --primary-blue: #2a4b8d;
            --primary-yellow: #f5a623;
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #333333;
            --success-green: #28a745;
            --error-red: #dc3545;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark-gray);
            background-color: var(--light-gray);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .confirmation-hero {
            background: linear-gradient(rgba(10, 36, 99, 0.85), rgba(10, 36, 99, 0.85)),
                        url('https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            padding: 4rem 2rem;
            text-align: center;
            color: var(--white);
            margin-bottom: 3rem;
        }

        .confirmation-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .invoice-container {
            max-width: 1000px;
            margin: -3rem auto 3rem auto;
            padding: 0 2rem;
        }

        .invoice-card {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 3rem;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 3rem;
            border-bottom: 2px solid var(--light-gray);
            padding-bottom: 2rem;
        }

        .invoice-header h2 {
            color: var(--primary-blue);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .invoice-section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            color: var(--primary-blue);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-gray);
        }

        .client-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .info-block {
            background: var(--light-gray);
            padding: 1.5rem;
            border-radius: 10px;
        }

        .info-block h3 {
            color: var(--primary-blue);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
        }

        .order-table th {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 1.2rem;
            text-align: left;
        }

        .order-table td {
            padding: 1.2rem;
            border-bottom: 1px solid var(--light-gray);
        }

        .total-row {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .total-amount {
            color: var(--success-green);
            font-size: 1.3rem;
        }

        .actions {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-top: 3rem;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #1a3a8f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.2);
        }

        .btn-secondary {
            background-color: var(--light-gray);
            color: var(--primary-blue);
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
        }

        .error-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--white);
            border-radius: 15px;
            margin: 2rem;
        }

        .error-state i {
            font-size: 3rem;
            color: var(--error-red);
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .invoice-container {
                padding: 0 1rem;
            }

            .invoice-card {
                padding: 2rem;
            }

            .client-info {
                grid-template-columns: 1fr;
            }

            .order-table td {
                padding: 1rem;
            }

            .actions {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
        @media print {
    body {
        font-size: 12px;
        line-height: 1.4;
        background: none;
        margin: 0;
        padding: 0;
    }

    .confirmation-hero {
        padding: 2rem 1rem !important;
        margin-bottom: 1rem !important;
    }

    .invoice-container {
        margin: -1rem auto 1rem auto !important;
        padding: 0 !important;
    }

    .invoice-card {
        padding: 1rem !important;
        box-shadow: none;
        border-radius: 0;
    }

    .invoice-header {
        margin-bottom: 1rem !important;
        padding-bottom: 0.5rem !important;
    }

    .section-title {
        margin-bottom: 0.5rem !important;
        padding-bottom: 0.25rem !important;
        font-size: 1.2rem !important;
    }

    .client-info {
        gap: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .info-block {
        padding: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    .order-table th,
    .order-table td {
        padding: 0.5rem !important;
        font-size: 12px;
    }

    .total-amount {
        font-size: 1rem !important;
    }

    .actions {
        display: none !important;
    }

    /* Réduction générale des marges */
    * {
        margin-top: 0.2rem !important;
        margin-bottom: 0.2rem !important;
    }

    /* Suppression des éléments superflus */
    .btn, .shadow, .hero-decoration {
        display: none !important;
    }
}
    </style>
</head>
<body>
    <div class="confirmation-hero">
        <h1>Confirmation de commande</h1>
    </div>

    <div class="invoice-container">
        <?php if(isset($_SESSION['invoice_data'])): 
            $data = $_SESSION['invoice_data'];
            unset($_SESSION['invoice_data']);
        ?>
            <div class="invoice-card">
                <div class="invoice-header">
                   
                    <h2>Facture #<?= htmlspecialchars($data['commande']['id']) ?></h2>
                    <p>Date : <?= htmlspecialchars($data['commande']['date']) ?></p>
                </div>

                <div class="invoice-section">
                    <div class="section-title">Informations client</div>
                    <div class="client-info">
                        <div class="info-block">
                            <h3>Nom</h3>
                            <p><?= htmlspecialchars($data['client']['nom']) ?></p>
                        </div>
                        <div class="info-block">
                            <h3>Adresse</h3>
                            <p><?= htmlspecialchars($data['client']['adresse']) ?></p>
                        </div>
                        <div class="info-block">
                            <h3>Téléphone</h3>
                            <p><?= htmlspecialchars($data['client']['telephone']) ?></p>
                        </div>
                    </div>
                </div>

                <div class="invoice-section">
                    <div class="section-title">Détails de la commande</div>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= htmlspecialchars($data['produit']['nom']) ?></td>
                                <td><?= number_format($data['produit']['prix'], 2, ',', ' ') ?> €</td>
                                <td><?= htmlspecialchars($data['produit']['quantite']) ?></td>
                                <td><?= number_format($data['commande']['total'], 2, ',', ' ') ?> €</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="total-amount">Total TTC : <?= number_format($data['commande']['total'], 2, ',', ' ') ?> €</p>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" onclick="window.print()">Imprimer</button>
                    <a class="btn btn-secondary" href="../../controllers/TrotinettesellController.php">Retour à la boutique</a>
                </div>
            </div>

        <?php else: ?>
            <div class="error-state">
                <i>⚠️</i>
                <h2>Aucune donnée de commande disponible</h2>
                <p>La commande n'a pas pu être récupérée.</p>
                <a class="btn btn-secondary" href="../../controllers/TrotinettesellController.php">Retour à la boutique</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>