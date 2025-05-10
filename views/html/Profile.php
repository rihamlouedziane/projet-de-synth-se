<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    :root {
        --primary-blue: #007bff;
        --white: #ffffff;
        --light-gray: #f8f9fa;
    }

    .alert-danger {
      color: #fff;
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .alert {
      margin-bottom: 1rem;
    }
        /* Style pour le message de succès */
        .success {
    color: #fff;
    background-color: #28a745; /* vert pour succès */
    border-color: #28a745;
    padding: 10px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
    font-size: 16px;
}

    .profile-section {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: var(--white);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-header h1 {
        color: var(--primary-blue);
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .profile-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .profile-card {
        background: var(--light-gray);
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid var(--primary-blue);
    }

    .info-group {
        margin-bottom: 1.5rem;
    }

    .info-label {
        color: var(--primary-blue);
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .info-value {
        background: var(--white);
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        width: 100%;
        display: block;
        transition: all 0.3s ease;
    }

   
    .edit-btn {
        background: var(--primary-blue);
        color: var(--white);
        padding: 12px 30px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .edit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(10, 36, 99, 0.2);
    }

    @media (max-width: 768px) {
        .profile-section {
            margin: 20px;
            padding: 20px;
        }
        
        .profile-header h1 {
            font-size: 2rem;
        }
    }
    </style>
</head>
<body>

<?php if (isset($_SESSION['client_id'])): ?>
    <?php include('../views/html/dashboardclient/headerCP.php'); ?>
<?php else: ?>
    <?php include('../views/layout/header1.php'); ?>
<?php endif; ?>

<div class="profile-section">
    <form method="POST" action="">
        <div class="profile-header">
            <?php if (isset($error) && !empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($message_success)): ?>
                <div class="success">
                    <?php echo $message_success; ?>
                </div>
            <?php endif; ?>

            <h1>Mon Profil</h1>
            <p>Gérez vos informations personnelles</p>
        </div>

        <div class="profile-content">
            <div class="profile-card">
                <div class="info-group">
                    <span class="info-label">Nom complet</span>
                    <input type="text" name="nom" class="info-value" required value="<?= $nom ?>" >
                </div>

                <div class="info-group">
                    <span class="info-label">Email</span>
                    <input type="email" name="email" class="info-value" required value="<?= $email ?>" >
                </div>
            </div>

            <div class="profile-card">
                <div class="info-group">
                    <span class="info-label">Téléphone</span>
                    <input type="tel" name="telephone" class="info-value" required value="<?= $telephone ?>" >
                </div>

                <div class="info-group">
                    <span class="info-label">Adresse</span>
                    <textarea name="adresse" class="info-value" rows="3" required><?= $adresse ?></textarea>
                </div>
            </div>

            <?php if ($type_client == 2): ?>
                <div class="profile-card">
                    <div class="info-group">
                        <span class="info-label">ICE</span>
                        <input type="text" name="ice" class="info-value" required value="<?= $ice ?>" >
                    </div>

                    <div class="info-group">
                        <span class="info-label">Forme Juridique</span>
                        <input type="text" name="formeJuridique" class="info-value" required value="<?= $formeJuridique ?>" >
                    </div>

                    <div class="info-group">
                        <span class="info-label">Représentant</span>
                        <input type="text" name="representant" class="info-value" required value="<?= $representant ?>" >
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <button type="button" class="edit-btn" onclick="toggleEdit()">
                <i class="fas fa-edit"></i> Modifier le profil
            </button>
        </div>
    </form>
</div>

<script>
function toggleEdit() {
    const inputs = document.querySelectorAll('.info-value');
    const btn = document.querySelector('.edit-btn');
    const form = document.querySelector('form');
    
    if (btn.innerHTML.includes('Modifier')) {
        inputs.forEach(input => {
            input.style.backgroundColor = '#fff';
            input.style.borderColor = '#007bff';
        });
        btn.innerHTML = '<i class="fas fa-save"></i> Enregistrer les modifications';
        btn.type = 'submit';
    } else {
        form.submit();
    }
}
</script>

<?php include('../views/layout/footer.php'); ?>

</body>
</html>
