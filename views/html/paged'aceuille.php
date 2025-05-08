<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trotty - Vente et Location de Trottinettes Électriques</title>
    <link rel="stylesheet" href="../public/css/pagedaceuille.css">
 
    <style>
        
      
    </style>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php if (isset($_SESSION['client_id'])): ?>
    <?php include('../views/html/dashboardclient/headerCP.php'); ?>
<?php else: ?>
    <?php include('../views/layout/header1.php'); ?>
<?php endif; ?>
    
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




    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.main-nav').classList.toggle('active');
        });
    </script>

<?php include('CommentaireController.php'); ?>
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
</script>
</body>

</html>