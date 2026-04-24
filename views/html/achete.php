 <?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>Informations client</title>
    <style>
        :root {
            --primary-blue: #0a2463;
            --primary-yellow: #FFD700;
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 2rem;
        }

        .reservation-form {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .form-title {
            font-size: 1.8rem;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-blue);
        }

        input[type="text"],
        input[type="tel"] {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .btn {
            width: 100%;
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1a3a8f;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="reservation-form">
            <h2 class="form-title">Informations client</h2>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']) ?></div>
            <?php endif; ?>

            <form action="../../controllers/AcheteController.php" method="post" onsubmit="return confirmAchat();">
            <input type="hidden" name="trottinette_id" value="<?= isset($_SESSION['achat_temp']['trottinette_id']) ? htmlspecialchars($_SESSION['achat_temp']['trottinette_id']) : '' ?>">


                <div class="form-group">
                    <label for="nom">Nom complet *</label>
                    <input type="text" name="nom" id="nom" required>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse *</label>
                    <input type="text" name="adresse" id="adresse" required>
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone *</label>
                    <input type="tel" name="telephone" id="telephone" pattern="[0-9]{10}" required>
                </div>

                <button type="submit" class="btn">Confirmer la commande</button>
            </form>
        </div>
    </div>

    
</body>
</html>