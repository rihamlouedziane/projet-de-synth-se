<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Vente et Location de Trottinettes Électriques</title>
    <link rel="stylesheet" href="../public/css/pagedaceuille.css">
 
    <style>
        
      .add-comment-link {
    text-align: center;
    margin: 20px 0;
}

.add-comment-btn {
    background-color: var(--primary-blue); /* Bleu moderne */
    color: white;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 16px;
    transition: background-color 0.3s ease;
    display: inline-block;
}

.add-comment-btn:hover {
    background-color: #0056b3;
}

.add-comment-btn i {
    margin-right: 8px;
}

#commentFormContainer {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.container-form h1 {
    font-size: 18px;
    color: #333;
    margin-bottom: 15px;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 14px;
    color: #666;
    display: block;
    margin-bottom: 5px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-group textarea {
    resize: vertical;
    height: 100px;
}

button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: var(--primary-blue);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

.add-comment-btn {
    background-color: var(--primary-blue);
    color: white;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 16px;
    transition: background-color 0.3s ease;
    display: inline-block;
    margin: 20px 0;
}

.add-comment-btn:hover {
    background-color: #0056b3;
}

.add-comment-btn i {
    margin-right: 8px;
}

.add-comment-link {
    text-align: center;
    margin: 20px 0;
}
.close-btn {
    background: none;
    border: none;
    font-size: 20px;
    color: #333;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

.close-btn:hover {
    color: #0056b3;
}


    </style>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php if (isset($_SESSION['client_id'])): ?>
    <?php include('../views/html/dashboardclient/headerCP.php'); ?>
<?php else: ?>
    <?php include('../views/layout/header1.php'); ?>
<?php endif; ?>
    
<!-- Conteneur pour le formulaire de commentaire -->

<div id="commentFormContainer" style="display: none;">
    <div class="container-form">
        <button type="button" class="close-btn" onclick="closeCommentForm()">
            <i class="fas fa-times"></i>
        </button>
        <h1>Laissez un commentaire</h1>
        
        <!-- Ici ton formulaire -->
        <form method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="contenu">Commentaire :</label>
                <textarea id="contenu" name="contenu" required></textarea>
            </div>

            <button type="submit">Envoyer le commentaire</button>
        </form>
    </div>
</div>


    <section class="action-section">
        <div class="action-buttons">
            <a href="sell.php" class="action-btn sale-btn">
                <div class="btn-content">
                    <h2>Acheter</h2>
                    <p>Possédez votre propre trottinette électrique haut de gamme</p>
                    <span class="btn-icon">Voir les modèles</span>
                </div>
            </a>
            
            <a href="location.php" class="action-btn rent-btn">
                <div class="btn-content">
                    <h2>Louer</h2>
                    <p>Essai avant achat ou location courte durée</p>
                    <span class="btn-icon">Découvrir l'offre</span>
                </div>
            </a>
        </div>
        
        <div class="parts-btn-section">
            <a href="piece.php" class="parts-btn">
                <div class="btn-content">
                    <h2>Pièces & Accessoires</h2>
                    <p>Trouvez toutes les pièces détachées pour votre trottinette</p>
                    <span class="btn-icon">Explorer le catalogue</span>
                </div>
            </a>
        </div>
    </section>




       
                     
   
<?php if (!isset($_SESSION['client_id'])): ?>
 
 <section class="reviews-section">
     <div class="section-header">
         <h2>Avis de nos clients</h2>
         <p>Découvrez ce que nos clients pensent de nos produits et services</p>
     </div>
     
     <div class="reviews-container" id="reviewsContainer">
         <?php if (!empty($commentaires)): ?>
             <?php foreach ($commentaires as $index => $commentaire): ?>
                 <div class="review-card" data-index="<?= $index ?>">
                     <div class="review-header">
                         <img src="https://api.dicebear.com/7.x/initials/svg?seed=<?= urlencode($commentaire['email']) ?>" 
                              alt="Avatar client" 
                              class="review-avatar">
                         <div class="reviewer-info">
                             <div class="reviewer-name"><?= htmlspecialchars($commentaire['email']) ?></div>
                             <div class="review-date">
                                 <?= date('d/m/Y H:i', strtotime($commentaire['date_commentaire'])) ?>
                             </div>
                         </div>
                     </div>
                     <div class="review-content">
                         "<?= htmlspecialchars($commentaire['contenu']) ?>"
                     </div>
                 </div>
             <?php endforeach; ?>
         <?php else: ?>
             <p class="no-reviews">Aucun commentaire pour le moment. Soyez le premier à donner votre avis !</p>
         <?php endif; ?>
     </div>
     <div class="add-comment-link">
        <a href="#" class="add-comment-btn" onclick="showCommentForm(event)">
            <i class="fas fa-comment-dots"></i> Ajouter un commentaire
        </a>

    </div>

  

 
     <?php if (count($commentaires) > 3): ?>
         <div class="pagination-controls">
             <button class="pagination-arrow" id="prevBtn" aria-label="Précédent">
                 <i class="fas fa-chevron-left"></i>
             </button>
             <button class="pagination-arrow" id="nextBtn" aria-label="Suivant">
                 <i class="fas fa-chevron-right"></i>
             </button>
         </div>
     <?php endif; ?>
 </section>
 
 <?php endif; ?> 


 
</section>

<?php include('../views/layout/footer.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('reviewsContainer');
        const cards = container.querySelectorAll('.review-card');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentIndex = 0;
        const cardsPerPage = 3;

        function updateVisibility() {
            cards.forEach((card, index) => {
                card.style.display = (index >= currentIndex && index < currentIndex + cardsPerPage) 
                    ? 'block' 
                    : 'none';
            });

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex + cardsPerPage >= cards.length;
        }

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex -= cardsPerPage;
                    updateVisibility();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentIndex + cardsPerPage < cards.length) {
                    currentIndex += cardsPerPage;
                    updateVisibility();
                }
            });
        }

        // Initial setup
        updateVisibility();
    });
 
         // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.main-nav').classList.toggle('active');
        });
        
function showCommentForm(event) {
    event.preventDefault(); // Empêche le comportement par défaut du lien
    const formContainer = document.getElementById('commentFormContainer');
    formContainer.style.display = 'block'; // Afficher le formulaire
    setTimeout(() => {
        formContainer.style.opacity = '1'; // Transition de l'opacité pour un effet fluide
    }, 10);
}


function closeCommentForm() {
    const formContainer = document.getElementById('commentFormContainer');
    formContainer.style.opacity = '0'; // Effet de transition
    setTimeout(() => {
        formContainer.style.display = 'none'; // Masquer le formulaire après l'animation
    }, 300);
}




</script>
</body>

</html>