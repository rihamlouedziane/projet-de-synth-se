<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe - Electric Scooter</title>
    <link rel="stylesheet" href="../../public/css/login1.css">

    <style>
  
    :root {
        --primary-blue: #0a2463;
        --primary-yellow: #FFD700;
        --secondary-yellow: #FFF200;
        --white: #ffffff;
        --light-gray: #f8f9fa;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: var(--light-gray);
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(255, 215, 0, 0.1) 0%, transparent 20%),
            radial-gradient(circle at 90% 80%, rgba(10, 36, 99, 0.1) 0%, transparent 20%);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.2rem 5%;
        background-color: var(--white);
        box-shadow: 0 2px 12px rgba(10, 36, 99, 0.1);
        height: 100px;
    }

    .logo img {
        max-width: 150px;
        height: auto;
        transition: transform 0.3s ease;
    }

    .body {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem;
    }

    form {
        background-color: var(--white);
        padding: 4rem;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(10, 36, 99, 0.2);
        width: 100%;
        max-width: 650px;
        border-top: 8px solid var(--primary-yellow);
        animation: formEntrance 0.6s ease-out;
    }

    h2 {
        color: var(--primary-blue);
        margin-bottom: 2.5rem;
        text-align: center;
        font-size: 2.8rem;
    }

    .input-group {
        margin-bottom: 2.5rem;
    }

    input[type="email"] {
        width: 100%;
        padding: 1.8rem 1.8rem 1.8rem 5rem;
        border: 3px solid #e0e0e0;
        border-radius: 12px;
        font-size: 1.4rem;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="%230a2463"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>');
        background-repeat: no-repeat;
        background-position: 1.8rem center;
        background-size: 1.8rem;
        height: 75px;
    }

    button {
        width: 100%;
        padding: 1.8rem;
        background: var(--primary-blue);
        color: var(--white);
        border: none;
        border-radius: 12px;
        font-size: 1.4rem;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 75px;
    }

    button:hover {
        background: #0d2e7a;
        transform: translateY(-3px);
    }

    @keyframes formEntrance {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-link {
        text-align: center;
        margin-top: 2rem;
    }

    .login-link a {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 500;
    }
    </style>
</head>
<body>
<header>
    <div class="logo"><img src="../../public/images/trotty  logo grand-04.png" alt="Logo de l'hôtel"></div>
    <div class="title"><img src="../../public/images/trotty [Récupéré]-02-02.png" alt="Nom de l'hôtel"></div>
</header>

    <div class="body">
        <form method="POST" action="envoyer_reset.php">
            <h2>Réinitialiser le mot de passe</h2>
            
            <div class="input-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" 
                       placeholder="Entrez votre email enregistré" required>
            </div>

            <button type="submit">Envoyer le lien de réinitialisation</button>

            <div class="login-link">
                <a href="../Client/LoginController.php">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>
</html>