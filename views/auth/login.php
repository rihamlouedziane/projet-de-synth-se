<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/login1.css">
</head>
<style>
    .alert-error {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 15px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .alert-error strong {
        display: block;
        font-size: 18px;
        margin-bottom: 5px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 15px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .alert-success strong {
        display: block;
        font-size: 18px;
        margin-bottom: 5px;
    }
</style>
<body>
<?php
// Afficher les messages de succès ou d'erreur
if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?php 
        echo htmlspecialchars($_SESSION['success']);
        unset($_SESSION['success']); 
        ?>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-error" role="alert">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<header>
    <div class="logo"><img src="../../public/images/trotty  logo grand-04.png" alt="Logo de l'hôtel"></div>
    <div class="title"><img src="../../public/images/trotty [Récupéré]-02-02.png" alt="Nom de l'hôtel"></div>
</header>

<div class="body">
    <form action="" method="POST">
        <label for="email">Email</label>
        <input type="email" placeholder="Email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" id="password" required>

        <button type="submit">Login</button>

        <div class="forget-password">
            <a href="#">Forgot password?</a>
        </div>
    </form>

    <div class="signup">
        <p>Don't have an account? <a href="../Client/ClientController.php">Sign up</a></p>
    </div>
</div>
</body>
</html>
