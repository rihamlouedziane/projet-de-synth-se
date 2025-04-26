<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/signup1.css">
</head>
<style>
    .alert-danger {
      color: #fff;
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .alert {
      margin-bottom: 1rem;
    }
</style>
<body>
  
  <header>
    <div class="logo"><img src="../public/images/trotty  logo grand-04.png" alt="Logo de l'hôtel"></div>
    <div class="title"><img src="../public/images/trotty [Récupéré]-02-02.png" alt="Nom de l'hôtel"></div>
  </header>

  <?php if (isset($error) && !empty($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo htmlspecialchars($error); ?>
  </div>
  <?php endif; ?>

  <div class="container container-form">
    <div class="form-title">Formulaire d'inscription</div>

    <form method="POST" action="../controllers/ClientController.php" onsubmit="return validateForm()">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="nom" class="form-label">Nom:</label>
          <input type="text" name="nom" class="form-control" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required>
        </div>
        <div class="col-md-6">
          <label for="telephone" class="form-label">Téléphone:</label>
          <input type="text" name="telephone" class="form-control" value="<?php echo isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : ''; ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
      </div>

      <div class="mb-3">
        <label for="adresse" class="form-label">Adresse:</label>
        <input type="text" name="adresse" class="form-control" value="<?php echo isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : ''; ?>" required>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="password" class="form-label">Mot de passe:</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label for="confirm_password" class="form-label">Confirmer le mot de passe:</label>
          <input type="password" name="confirm_password" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="type_client" class="form-label">Type de client:</label>
        <select name="type_client" id="type_client" class="form-select" required>
          <option value="particulier" <?php echo (isset($_POST['type_client']) && $_POST['type_client'] == 'particulier') ? 'selected' : ''; ?>>Particulier</option>
          <option value="entreprise" <?php echo (isset($_POST['type_client']) && $_POST['type_client'] == 'entreprise') ? 'selected' : ''; ?>>Entreprise</option>
        </select>
      </div>

      <!-- Client particulier -->
      <div id="particulier_fields" class="conditional-fields mb-3">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="date_naissance" class="form-label">Date de naissance:</label>
            <input type="date" name="date_naissance" class="form-control" value="<?php echo isset($_POST['date_naissance']) ? htmlspecialchars($_POST['date_naissance']) : ''; ?>">
          </div>
        </div>
        <div class="mb-3">
          <label for="civilite" class="form-label">Civilité:</label>
          <select name="civilite" class="form-select">
            <option value="" <?php echo (isset($_POST['civilite']) && $_POST['civilite'] == '') ? 'selected' : ''; ?>>-- Choisir --</option>
            <option value="M" <?php echo (isset($_POST['civilite']) && $_POST['civilite'] == 'M') ? 'selected' : ''; ?>>M</option>
            <option value="F" <?php echo (isset($_POST['civilite']) && $_POST['civilite'] == 'F') ? 'selected' : ''; ?>>F</option>
            <option value="Autre" <?php echo (isset($_POST['civilite']) && $_POST['civilite'] == 'Autre') ? 'selected' : ''; ?>>Autre</option>
          </select>
        </div>
      </div>

      <!-- Client entreprise -->
      <div id="entreprise_fields" class="conditional-fields mb-3">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="siret" class="form-label">Numéro SIRET:</label>
            <input type="text" name="siret" class="form-control" value="<?php echo isset($_POST['siret']) ? htmlspecialchars($_POST['siret']) : ''; ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="secteur" class="form-label">Secteur d'activité:</label>
            <input type="text" name="secteur" class="form-control" value="<?php echo isset($_POST['secteur']) ? htmlspecialchars($_POST['secteur']) : ''; ?>">
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Inscription</button>
    </form>
  </div>

<script>
  function updateClientFields() {
    const typeClient = document.getElementById('type_client').value;
    const particulierFields = document.getElementById('particulier_fields');
    const entrepriseFields = document.getElementById('entreprise_fields');

    if (typeClient === 'particulier') {
      particulierFields.style.display = 'block';
      entrepriseFields.style.display = 'none';
      document.querySelector('input[name="prenom"]').setAttribute('required', '');
      document.querySelector('input[name="date_naissance"]').setAttribute('required', '');
      document.querySelector('select[name="civilite"]').setAttribute('required', '');
      document.querySelector('input[name="siret"]').removeAttribute('required');
      document.querySelector('input[name="secteur"]').removeAttribute('required');
    } else {
      entrepriseFields.style.display = 'block';
      particulierFields.style.display = 'none';
      document.querySelector('input[name="prenom"]').removeAttribute('required');
      document.querySelector('input[name="date_naissance"]').removeAttribute('required');
      document.querySelector('select[name="civilite"]').removeAttribute('required');
      document.querySelector('input[name="siret"]').setAttribute('required', '');
      document.querySelector('input[name="secteur"]').setAttribute('required', '');
    }
  }

  window.addEventListener('DOMContentLoaded', updateClientFields);
  document.getElementById('type_client').addEventListener('change', updateClientFields);

  function validateForm() {
    const typeClient = document.getElementById('type_client').value;
    if (typeClient === 'entreprise') {
      const siret = document.querySelector('input[name="siret"]').value.trim();
      const secteur = document.querySelector('input[name="secteur"]').value.trim();
      if (!siret || !secteur) {
        alert("Veuillez remplir tous les champs pour l'entreprise.");
        return false;
      }
    }
    if (typeClient === 'particulier') {
      const prenom = document.querySelector('input[name="prenom"]').value.trim();
      const dateNaissance = document.querySelector('input[name="date_naissance"]').value.trim();
      const civilite = document.querySelector('select[name="civilite"]').value.trim();
      if (!prenom || !dateNaissance || !civilite) {
        alert("Veuillez remplir tous les champs pour le particulier.");
        return false;
      }
    }
    return true;
  }
</script>

</body>
</html>
