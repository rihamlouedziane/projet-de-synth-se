<?php include ('../../../views/html/dashboardresponsable/pagedaceuille.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des Modèles</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      padding: 20px;
    }
    h1 {
      color: #0a2463;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      margin-top: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: center;
    }
    th {
      background-color: #0a2463;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .btn {
      padding: 8px 12px;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
      color: white;
    }
    .btn-edit {
      background-color: #ffc107;
    }
    .btn-delete {
      background-color: #dc3545;
    }
    .btn-add {
      background-color: #28a745;
      margin-bottom: 15px;
      float: right;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 5px;
      color: white;
    }
    .img-thumbnail {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<main class="main-content" id="mainContent">
  <h1>Liste des Modèles</h1>

  <a href="../Modele/ajouterModelController.php" class="btn-add">➕ Ajouter un modèle</a>

  <table>
    <thead>
      <tr>
        <th>Libellé</th>
        <th>Puissance (kW)</th>
        <th>Autonomie (km)</th>
        <th>Type</th>
        <th>Photo</th>  <!-- Nouvelle colonne pour la photo -->
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($modeles)): ?>
        <?php foreach ($modeles as $modele): ?>
          <tr>
            <td><?= htmlspecialchars($modele['Libelle']) ?></td>
            <td><?= htmlspecialchars($modele['Puissance']) ?></td>
            <td><?= htmlspecialchars($modele['Autonomie']) ?></td>
            <td><?= htmlspecialchars($modele['TypeModele']) ?></td>
            
           
            <td>
              <?php if (!empty($modele['Photo'])): ?>
                <img src="../../../public/uploads/image/<?= htmlspecialchars($modele['Photo']) ?>" class="img-thumbnail" alt="Photo du modèle">
              <?php else: ?>
                Pas de photo
              <?php endif; ?>
            </td>
            
            <td>          
                <a href="../Modele/ModifierModelController.php?id=<?= htmlspecialchars($modele['IDModele']) ?>" class="btn btn-edit">✏️ Modifier</a>
                <a href="../Modele/SuprimerModelController.php?id=<?= htmlspecialchars($modele['IDModele']) ?>" class="btn btn-delete" onclick="return confirm('Voulez-vous vraiment supprimer ce modèle ?');">🗑️ Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="6">Aucun modèle trouvé.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

</body>
</html>
