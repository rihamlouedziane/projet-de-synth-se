<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Trotty - Vente et Location de Trottinettes Électriques</title>
   
  <style>
    

        body {
            background-color: var(--light-gray);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }


        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: var(--primary-blue);
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Contact Page Specific Styles */
        .contact-hero {
            background: linear-gradient(rgba(10, 36, 99, 0.85), rgba(10, 36, 99, 0.85)), 
                        url('https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            padding: 5rem 2rem;
            text-align: center;
            color: var(--white);
        }

        .contact-hero h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .contact-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .contact-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 2rem;
            display: flex;
            gap: 3rem;
        }

        .contact-form {
            flex: 1;
            background-color: var(--white);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            color: var(--primary-blue);
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-blue);
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 36, 99, 0.1);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #1a3a8f;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(10, 36, 99, 0.2);
        }

        .contact-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .info-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .info-card h3 {
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-card h3 i {
            color: var(--primary-yellow);
        }

        .info-card p {
            color: var(--dark-gray);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .info-card a {
            color: var(--primary-blue);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .info-card a:hover {
            color: var(--primary-yellow);
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--primary-blue);
            color: var(--white);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--primary-yellow);
            color: var(--primary-blue);
            transform: translateY(-3px);
        }

        .map-container {
            height: 300px;
            border-radius: 15px;
            overflow: hidden;
            margin-top: 2rem;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .contact-container {
                flex-direction: column;
            }
            
            .contact-form,
            .contact-info {
                flex: none;
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                padding: 1rem;
            }
            
            .nav-container {
                position: static;
                transform: none;
                width: 100%;
            }
            
            .main-nav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--white);
                padding: 1rem;
                display: none;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                z-index: 1000;
            }
            
            .main-nav.active {
                display: block;
            }
            
            .main-nav ul {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .main-nav a {
                display: block;
                text-align: center;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .contact-hero h1 {
                font-size: 2.2rem;
            }
            
            .contact-hero p {
                font-size: 1rem;
            }
            
            .contact-form {
                padding: 2rem;
            }
            
            .contact-form h2 {
                font-size: 1.8rem;
            }
            
            .user-actions {
                margin-left: auto;
            }
        }

        @media (max-width: 480px) {
            .contact-hero {
                padding: 3rem 1.5rem;
            }
            
            .contact-container {
                padding: 0 1.5rem;
            }
            
            .contact-form {
                padding: 1.5rem;
            }
            
            .info-card {
                padding: 1.5rem;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include('../layout/header.php'); ?>
    
    <section class="contact-hero">
        <h1>Contactez-nous</h1>
        <p>Nous sommes à votre écoute pour toutes questions concernant nos trottinettes électriques, nos services de location ou nos pièces détachées.</p>
    </section>
    
    <div class="contact-container">
        <div class="contact-form">
            <h2>Envoyez-nous un message</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="subject">Sujet</label>
                    <select id="subject" name="subject" required>
                        <option value="">Sélectionnez un sujet</option>
                        <option value="question">Question sur un produit</option>
                        <option value="technical">Support technique</option>
                        <option value="rental">Demande de location</option>
                        <option value="parts">Demande de pièces détachées</option>
                        <option value="other">Autre demande</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Envoyer le message</button>
            </form>
        </div>
        
        <div class="contact-info">
            <div class="info-card">
                <h3><i class="fas fa-map-marker-alt"></i> Notre magasin</h3>
                <p>123 Avenue des Trottinettes<br>75015 Paris, France</p>
                <p>Ouvert du lundi au samedi de 9h à 19h</p>
            </div>
            
            <div class="info-card">
                <h3><i class="fas fa-phone-alt"></i> Contact téléphonique</h3>
                <p><a href="tel:+33123456789">+33 1 23 45 67 89</a></p>
                <p>Service client disponible du lundi au vendredi de 8h à 18h</p>
            </div>
            
            <div class="info-card">
                <h3><i class="fas fa-envelope"></i> Email</h3>
                <p><a href="mailto:contact@trotty.fr">contact@trotty.fr</a></p>
                <p>Nous répondons sous 24 heures</p>
            </div>
            
            <div class="info-card">
                <h3><i class="fas fa-share-alt"></i> Suivez-nous</h3>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.99144060821!2d2.292292615509614!3d48.85837007928746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1623258123456!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.main-nav').classList.toggle('active');
        });
    </script>
</body>
</html>