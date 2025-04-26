<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<style>
    :root {
    --primary-blue: #0a2463;
    --primary-yellow: #FFD700;
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
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

header {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1.2rem;
    background-color: var(--white);
    box-shadow: 0 2px 12px rgba(10, 36, 99, 0.1);
    text-align: center;
    height: 100px;
}

header .logo img {
    max-width: 150px;
    height: auto;
    transition: transform 0.3s ease;
}

header .logo img:hover {
    transform: scale(1.05);
}

.dashboard-container {
    display: flex;
    flex-grow: 1;
    padding: 2rem;
    justify-content: space-between;
}

.menu {
    width: 200px;
    background-color: var(--primary-blue);
    color: var(--white);
    padding: 1rem;
    border-radius: 8px;
}

.menu nav ul {
    list-style-type: none;
}

.menu nav ul li {
    margin: 1rem 0;
}

.menu nav ul li a {
    color: var(--white);
    text-decoration: none;
    font-size: 1.2rem;
    display: block;
    padding: 0.5rem;
    transition: background-color 0.3s ease;
}

.menu nav ul li a:hover {
    background-color: var(--primary-yellow);
    border-radius: 8px;
}

.client-info {
    flex-grow: 1;
    background-color: var(--white);
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 12px rgba(10, 36, 99, 0.1);
}

.client-info h1 {
    color: var(--primary-blue);
    margin-bottom: 1rem;
}

.client-info h2 {
    margin-top: 2rem;
    color: var(--primary-blue);
    font-size: 1.5rem;
}

.client-info p {
    font-size: 1.2rem;
    color: #333;
}

a {
    color: var(--primary-blue);
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

</style>
    <header>
        <div class="logo">
            <img src="votre-logo.png" alt="Logo">
        </div>
    </header>

    <div class="dashboard-container">
        <div class="menu">
            <nav>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Mon compte</a></li>
                    <li><a href="#">Paramètres</a></li>
                    <li><a href="logout.php">Se déconnecter</a></li>
                </ul>
            </nav>
        </div>

        <div class="client-info">
            <h1>Bienvenue, <?php echo htmlspecialchars($email); ?>!</h1>
            <h2>Informations sur votre compte :</h2>
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($nom); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($telephone); ?></p>
            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($adresse); ?></p>
        </div>
    </div>

</body>
</html>
