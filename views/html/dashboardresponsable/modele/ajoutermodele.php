<?php 
// Inclure la page d'accueil du tableau de bord
include ('../../../views/html/dashboardresponsable/pagedaceuille.php');

// Variables des anciennes valeurs pour le formulaire
$old_libelle = isset($_POST['libelle']) ? $_POST['libelle'] : '';
$old_puissance = isset($_POST['puissance']) ? $_POST['puissance'] : '';
$old_autonomie = isset($_POST['autonomie']) ? $_POST['autonomie'] : '';
$old_type_modele = isset($_POST['type_modele']) ? $_POST['type_modele'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ajouter un Modèle</title>
    <style>
    .alert-danger {
      color: #fff;
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .alert {
      margin-bottom: 1rem;
    }
    .success {
        color: green;
        font-size: 14px;
        margin-bottom: 20px;
        text-align: center;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        color: #0a2463;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #0a2463;
    }

    input, select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input:focus, select:focus, button:focus {
        border-color: #0a2463;
        outline: none;
    }

    button {
        background-color: #FFD700;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0a2463;
    }

    .optional-fields {
        display: block; /* Initially show optional fields */
    }
    .optional-fields.hidden {
        display: none; /* Hide optional fields */
    }
    </style>
</head>
<body>

<main class="main-content" id="mainContent">
    <div class="container">
        <h2>Ajouter un modèle</h2>

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

     
        <form method="POST" action="ajouterModelController.php"  enctype="multipart/form-data" id="form-ajouter-modele">
            <div class="row mb-3">
                <div class="col-md-6 col-sm-12">
                    <label for="libelle">Libelle :</label>
                    <input type="text" id="libelle" name="libelle" value="<?php echo htmlspecialchars($old_libelle); ?>" placeholder="Entrez le libellé du modèle" required>
                </div>
                <div class="col-md-6 col-sm-12 optional-fields">
                    <label for="puissance">Puissance :</label>
                    <input type="number" id="puissance" name="puissance" value="<?php echo htmlspecialchars($old_puissance); ?>" placeholder="Entrez la puissance en kW">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 col-sm-12 optional-fields">
                    <label for="autonomie">Autonomie (en km) :</label>
                    <input type="number" id="autonomie" name="autonomie" value="<?php echo htmlspecialchars($old_autonomie); ?>" placeholder="Entrez l'autonomie du modèle">
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="type_modele">Type de modèle :</label>
                    <select id="type_modele" name="type_modele" required>
                        <option value="">Sélectionner le type de modèle</option>
                        <option value="piece" <?php echo ($old_type_modele == 'piece') ? 'selected' : ''; ?>>Pièce</option>
                        <option value="trottinette" <?php echo ($old_type_modele == 'trottinette') ? 'selected' : ''; ?>>Trottinette</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
        <label for="photo">Photo du modèle :</label>
        <input type="file" id="photo" name="photo" accept="image/*">
    </div>

            <button type="submit">Ajouter le modèle</button>
        </form>
    </div>
</main>

<script>
    // Récupérer le select du type de modèle
    const typeModeleSelect = document.getElementById('type_modele');
    const optionalFields = document.querySelectorAll('.optional-fields');
    const puissanceField = document.getElementById('puissance');
    const autonomieField = document.getElementById('autonomie');

    // Fonction pour ajuster l'affichage et les champs requis en fonction de la sélection
    typeModeleSelect.addEventListener('change', function() {
        if (this.value === 'piece') {
            // Masquer les autres champs si le type est 'piece'
            optionalFields.forEach(function(field) {
                field.classList.add('hidden');
            });

            // Rendre les champs non requis
            puissanceField.removeAttribute('required');
            autonomieField.removeAttribute('required');
        } else {
            // Afficher les autres champs si le type est 'trottinette'
            optionalFields.forEach(function(field) {
                field.classList.remove('hidden');
            });

            // Rendre les champs requis
            puissanceField.setAttribute('required', 'required');
            autonomieField.setAttribute('required', 'required');
        }
    });

    // Simuler un changement au chargement si une valeur est déjà sélectionnée
    if (typeModeleSelect.value === 'piece') {
        optionalFields.forEach(function(field) {
            field.classList.add('hidden');
        });

        // Rendre les champs non requis si 'piece' est sélectionné
        puissanceField.removeAttribute('required');
        autonomieField.removeAttribute('required');
    }
</script>


</body>
</html>
