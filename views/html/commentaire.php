<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de commentaire</title>
    <style>
       * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary-blue: #0a2463;
            --primary-yellow: #FFD700;
            --secondary-yellow: #FFF200;
            --white: #ffffff;
            --light-gray: #f8f9fa;
        }

        body {
            background-color: var(--light-gray);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255, 215, 0, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(10, 36, 99, 0.1) 0%, transparent 20%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container-form {
            width: 100%;
            margin: 40px 0;
            padding: 40px 15%;
            background-color: var(--white);
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
        }

        h1 {
            color: var(--primary-blue);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.8rem;
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 1.2rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1.1rem;
            background-color: var(--light-gray);
            transition: border-color 0.3s ease;
        }

        textarea {
            min-height: 200px;
            max-width: 100%;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 8px rgba(10, 36, 99, 0.1);
        }

        button[type="submit"] {
            width: 100%;
            padding: 1.2rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            margin-top: 1rem;
        }

        button:hover {
            background: linear-gradient(135deg, var(--primary-blue), #0d2e7a);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(10, 36, 99, 0.2);
        }

        .error {
            color: #dc3545;
            background-color: #f8d7da;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            border: 1px solid #f5c6cb;
        }

        .success {
            color: #28a745;
            background-color: #d4edda;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            border: 1px solid #c3e6cb;
        }

        @media (max-width: 1200px) {
            .container-form {
                padding: 40px 10%;
            }
        }

        @media (max-width: 768px) {
            .container-form {
                padding: 20px 5%;
                margin: 0;
            }
            
            h1 {
                font-size: 2rem;
            }

            textarea {
                min-height: 150px;
            }
        }
    </style>

    </style>
</head>
<body>


    <div class="container-form">
        <h1>Laissez un commentaire</h1>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="contenu">Commentaire :</label>
                <textarea id="contenu" name="contenu" required><?= htmlspecialchars($contenu ?? '') ?></textarea>
            </div>

            <button type="submit">Envoyer le commentaire</button>
        </form>
    </div>


</body>
</html>