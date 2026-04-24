<?php

// Inclure l’en-tête du tableau de bord
include('../../../views/html/dashboardresponsable/pagedaceuille.php');

// Récupération des données du modèle depuis la session
$id = isset($_SESSION['modele']['id']) ? $_SESSION['modele']['id'] : '';
$libelle = isset($_SESSION['modele']['libelle']) ? $_SESSION['modele']['libelle'] : '';
$puissance = isset($_SESSION['modele']['puissance']) ? $_SESSION['modele']['puissance'] : '';
$autonomie = isset($_SESSION['modele']['autonomie']) ? $_SESSION['modele']['autonomie'] : '';
$type_modele = isset($_SESSION['modele']['type_modele']) ? $_SESSION['modele']['type_modele'] : '';
$photo = isset($_SESSION['modele']['photo']) ? $_SESSION['modele']['photo'] : ''; // Récupération de la photo
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Modèle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        h2 {
            text-align: center;
            color: #0a2463;
        }
        label {
            font-weight: bold;
            color: #0a2463;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }
        button {
            background-color: #FFD700;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0a2463;
        }
        .img-thumbnail {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
            html, body {
  overflow: hidden;
}
    </style>
</head>
<body>
<main class="main-content" id="mainContent">
    <div class="container">
        <h2>Modifier un Modèle</h2>

        <form method="POST" action="../Modele/UpdateModelController.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="libelle">Libelle :</label>
                    <input type="text" id="libelle" name="libelle" value="<?php echo htmlspecialchars($libelle); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="puissance">Puissance :</label>
                    <input type="number" id="puissance" name="puissance" value="<?php echo htmlspecialchars($puissance); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="autonomie">Autonomie (en km) :</label>
                    <input type="number" id="autonomie" name="autonomie" value="<?php echo htmlspecialchars($autonomie); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="type_modele">Type de modèle :</label>
                    <select id="type_modele" name="typemodele" required>
                        <option value="">Sélectionner un type</option>
                        <option value="piece" <?php echo ($type_modele == 'piece') ? 'selected' : ''; ?>>Pièce</option>
                        <option value="trottinette" <?php echo ($type_modele == 'trottinette') ? 'selected' : ''; ?>>Trottinette</option>
                    </select>
                </div>
            </div>


        <div class="row mb-3">
                <div class="col-md-12">
                    <label for="photo">Photo :</label>
                    <?php if (!empty($photo)) : ?>
                        <img src="../../../public/uploads/image/<?= htmlspecialchars($photo) ?>" 
                             class="img-thumbnail" alt="Photo actuelle">
                        <input type="hidden" name="existing_photo" 
                               value="<?= htmlspecialchars($photo) ?>">
                    <?php else : ?>
                        <p>Aucune photo actuelle</p>
                    <?php endif; ?>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</main>
</body>
<script>
// Activer/désactiver les champs requis selon le type de modèle
document.getElementById('type_modele').addEventListener('change', function() {
    const isPiece = this.value === 'piece';
    document.getElementById('puissance').required = !isPiece;
    document.getElementById('autonomie').required = !isPiece;
});

// Appliquer au chargement si c'est une pièce
window.onload = function() {
    const typeSelect = document.getElementById('type_modele');
    if (typeSelect.value === 'piece') {
        document.getElementById('puissance').required = false;
        document.getElementById('autonomie').required = false;
    }
};
</script>
</html>
