<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/signup1.css">
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
    <div class="logo"><img src="../../public/images/trotty  logo grand-04.png" alt="Logo de l'hôtel"></div>
    <div class="title"><img src="../../public/images/trotty [Récupéré]-02-02.png" alt="Nom de l'hôtel"></div>
  </header>

  <?php if (isset($error) && !empty($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo htmlspecialchars($error); ?>
  </div>
  <?php endif; ?>

  <div class="container container-form">
    <div class="form-title">Formulaire d'inscription</div>

    <form method="POST" action="../Client/ClientController.php" onsubmit="return validateForm()">
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
          <option value="" <?php echo (empty($_POST['type_client']) ? 'selected' : ''); ?>>Sélectionner un type de client</option>
          <option value="particulier" <?php echo (isset($_POST['type_client']) && $_POST['type_client'] == 'particulier') ? 'selected' : ''; ?>>Particulier</option>
          <option value="entreprise" <?php echo (isset($_POST['type_client']) && $_POST['type_client'] == 'entreprise') ? 'selected' : ''; ?>>Entreprise</option>
        </select>
      </div>



      <!-- Client entreprise -->
      <div id="entreprise_fields" class="conditional-fields mb-3" style="display:none;">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="ice" class="form-label">Numéro ICE:</label>
            <input type="text" name="ice" class="form-control" value="<?php echo isset($_POST['ice']) ? htmlspecialchars($_POST['ice']) : ''; ?>" >
          </div>
          <div class="col-md-6 mb-3">
            <label for="forme_juridique" class="form-label">Forme juridique:</label>
            <select name="forme_juridique" class="form-select">
                <option value="SARL" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SARL') ? 'selected' : ''; ?>>SARL (Société à Responsabilité Limitée)</option>
                <option value="SA" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SA') ? 'selected' : ''; ?>>SA (Société Anonyme)</option>
                <option value="EI" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'EI') ? 'selected' : ''; ?>>EI (Entreprise Individuelle)</option>
                <option value="EIRL" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'EIRL') ? 'selected' : ''; ?>>EIRL (Entreprise Individuelle à Responsabilité Limitée)</option>
                <option value="SAS" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SAS') ? 'selected' : ''; ?>>SAS (Société par Actions Simplifiée)</option>
                <option value="SASU" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SASU') ? 'selected' : ''; ?>>SASU (Société par Actions Simplifiée Unipersonnelle)</option>
                <option value="SCI" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SCI') ? 'selected' : ''; ?>>SCI (Société Civile Immobilière)</option>
                <option value="SCOP" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SCOP') ? 'selected' : ''; ?>>SCOP (Société Coopérative et Participative)</option>
                <option value="SARL_de_famille" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SARL_de_famille') ? 'selected' : ''; ?>>SARL de famille</option>
                <option value="SNC" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SNC') ? 'selected' : ''; ?>>SNC (Société en Nom Collectif)</option>
                <option value="SELARL" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SELARL') ? 'selected' : ''; ?>>SELARL (Société d'Exercice Libéral à Responsabilité Limitée)</option>
                <option value="SELAS" <?php echo (isset($_POST['forme_juridique']) && $_POST['forme_juridique'] == 'SELAS') ? 'selected' : ''; ?>>SELAS (Société d'Exercice Libéral par Actions Simplifiée)</option>
            </select>


          </div>
        </div>
        <div class="mb-3">
          <label for="representant" class="form-label">Nom du représentant:</label>
          <input type="text" name="representant" class="form-control" value="<?php echo isset($_POST['representant']) ? htmlspecialchars($_POST['representant']) : ''; ?>" >
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Inscription</button>
    </form>
  </div>

<script>
  function updateClientFields() {
    const typeClient = document.getElementById('type_client').value;
    const entrepriseFields = document.getElementById('entreprise_fields');

    if (typeClient === '' ||typeClient == 'particulier') { // Particulier
      entrepriseFields.style.display = 'none';
    } else { // Entreprise
      entrepriseFields.style.display = 'block';
    iceField.setAttribute('required', 'required');
    formeJuridiqueField.setAttribute('required', 'required');
    representantField.setAttribute('required', 'required');
    }
  }

  window.addEventListener('DOMContentLoaded', updateClientFields);
  document.getElementById('type_client').addEventListener('change', updateClientFields);

  function validateForm() {
    const typeClient = document.getElementById('type_client').value;
    if (typeClient == 'entreprise') { // Entreprise
      const ice = document.querySelector('input[name="ice"]').value.trim();
      const formeJuridique = document.querySelector('input[name="forme_juridique"]').value.trim();
      const representant = document.querySelector('input[name="representant"]').value.trim();
      if (!ice || !formeJuridique || !representant) {
        alert("Veuillez remplir tous les champs pour l'entreprise.");
        return false;
      }
    }
    return true;
  }
</script>

</body>
</html>
