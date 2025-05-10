<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
    
    <label for="new_password">Nouveau mot de passe :</label>
    <input type="password" name="new_password" required>
    
    <button type="submit">Réinitialiser</button>
</form>

</body>
</html>