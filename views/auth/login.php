
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/login1.css">

</head>
<style>
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
session_start();
if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?php
        echo htmlspecialchars($_SESSION['success']);
       
        unset($_SESSION['success']);
        ?>
    </div>
<?php endif; ?>
    <header>
    <div class="logo"><img src="../../public/images/trotty  logo grand-04.png" alt="Logo de l'hôtel"></div>
    <div class="title"><img src="../../public/images/trotty [Récupéré]-02-02.png" alt="Nom de l'hôtel"></div>
    </header>
    <div class="body">
        <form action="../../controllers/LoginController.php" method="POST">
            <label for="email">Email</label>
            <input type="email" placeholder="Email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="password" id="password" required>
            <button type="submit">login</button>
            <div class="forget-password">
                <a href="#">Forgot password?</a>
            </div>
       </form>

       
        <div class="signup">
            <p>Don't have an account? <a href="../../controllers/ClientController.php">Sign up</a></p>
        
    </div>
</body>
</html>