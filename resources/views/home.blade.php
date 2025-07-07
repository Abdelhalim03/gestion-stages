<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StagePro - Plateforme de Gestion des Stages</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('briefcase-solid.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #3f37c9;
            --accent: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #ef233c;
            --gray: #adb5bd;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            line-height: 1.7;
            color: var(--dark);
            background-color: var(--light);
            overflow-x: hidden;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.9), rgba(58, 12, 163, 0.95)), 
                        url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 8rem 1.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.1) 0%, transparent 70%);
        }
        
        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            margin-bottom: 1.5rem;
            font-weight: 800;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }
        
        .cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: white;
            color: var(--primary);
            padding: 0.9rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-size: 1.1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent 0%, rgba(255,255,255,0.2) 100%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .cta-button:hover {
            background: var(--dark);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .cta-button:hover::before {
            transform: translateX(100%);
        }
        
        .secondary-button {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.3);
            margin-left: 1rem;
        }
        
        .secondary-button:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }
        
        /* Features Section */
        .features {
            padding: 6rem 1.5rem;
            background: white;
            position: relative;
        }
        
        .features::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to bottom, rgba(248,249,250,1), rgba(248,249,250,0));
            z-index: 1;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            z-index: 2;
        }
        
        .section-title h2 {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            color: var(--dark);
            position: relative;
            display: inline-block;
            font-weight: 700;
        }
        
        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 2px;
        }
        
        .section-subtitle {
            max-width: 700px;
            margin: 1rem auto 0;
            color: var(--gray);
            font-size: 1.1rem;
        }
        
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .feature {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            border: 1px solid rgba(0,0,0,0.03);
            position: relative;
            overflow: hidden;
        }
        
        .feature::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }
        
        .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature:hover::after {
            transform: scaleX(1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
        }
        
        .feature h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--dark);
            font-weight: 700;
        }
        
        .feature p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        
        .feature-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .feature-link i {
            margin-left: 0.5rem;
            transition: transform 0.3s;
        }
        
        .feature-link:hover {
            color: var(--primary-dark);
        }
        
        .feature-link:hover i {
            transform: translateX(5px);
        }
        
        /* Platform Specific Features */
        .platform-features {
            background: white;
            padding: 6rem 1.5rem;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 3rem auto 0;
        }
        
        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 1px solid rgba(0,0,0,0.03);
            text-align: center;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        /* Dashboard Preview */
        .dashboard-preview {
            padding: 6rem 1.5rem;
            background: linear-gradient(to bottom, var(--light), white);
        }
        
        .dashboard-image {
            max-width: 1000px;
            margin: 3rem auto 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .dashboard-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Final CTA Section */
        .final-cta {
            padding: 8rem 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .final-cta::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
        }
        
        .final-cta-content {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .final-cta h2 {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        
        .final-cta p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 5rem 1.5rem 2rem;
            position: relative;
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: inline-block;
        }
        
        .footer-logo span {
            color: var(--primary);
        }
        
        .footer-about p {
            margin-bottom: 1.5rem;
            opacity: 0.8;
            line-height: 1.6;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
        
        .footer-links h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
            font-weight: 600;
        }
        
        .footer-links h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary);
            border-radius: 3px;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 3rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.7;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero {
                padding: 6rem 1.5rem;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .secondary-button {
                margin-left: 0;
                margin-top: 1rem;
            }
        }
         html {
            scroll-behavior: smooth;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Dashboard Preview - Nouveau style */
.dashboard-container {
    max-width: 1200px;
    margin: 3rem auto 0;
}

.dashboard-tabs {
    display: flex;
    justify-content: center;
    margin-bottom: 1rem;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.tab {
    padding: 0.8rem 1.5rem;
    background: white;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    color: var(--gray);
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tab i {
    font-size: 1rem;
}

.tab:hover {
    color: var(--primary);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.tab.active {
    background: var(--primary);
    color: white;
    box-shadow: 0 5px 20px rgba(67, 97, 238, 0.3);
}

.dashboard-image {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(0,0,0,0.05);
    position: relative;
    height: 500px;
}

.dashboard-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.dashboard-image img.active {
    opacity: 1;
}
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content animate__animated animate__fadeIn">
            <h1>Plateforme Complète de Gestion des Stages</h1>
            <p>Solution tout-en-un pour simplifier la gestion des stages académiques. Conçue pour les étudiants, encadrants.</p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="cta-button animate__animated animate__pulse animate__infinite animate__slower">
                    <i class="fas fa-user-plus"></i> S'inscrire maintenant
                </a>
                <a href="#fonctionnalites" class="cta-button secondary-button ">
                    <i class="fas fa-search"></i> Explorer les fonctionnalités
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fonctionnalites">
        <div class="section-title">
            <h2>Fonctionnalités Principales</h2>
            <p class="section-subtitle">Découvrez les outils puissants de notre plateforme</p>
        </div>
        <div class="features-container">
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>Espace Étudiant</h3>
                <p>Déposez vos demandes de stage, suivez votre progression et communiquez avec vos encadrants.</p>
                <a href="#" class="feature-link">
                    Voir plus <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3>Espace Encadrant</h3>
                <p>Suivez plusieurs stagiaires, évaluez leurs performances.</p>
                <a href="#" class="feature-link">
                    Voir plus <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3>Espace Admin</h3>
                <p>Pilotez l'ensemble des stages et gérez les utilisateurs.</p>
                <a href="#" class="feature-link">
                    Voir plus <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Platform Features Section -->
    <section class="platform-features">
        <div class="section-title">
            <h2>Modules Complets</h2>
            <p class="section-subtitle">Tous les outils pour une gestion optimale des stages</p>
        </div>
        <div class="feature-grid">
            <div class="feature-card">
                <i class="fas fa-file-signature"></i>
                <h3>Conventions</h3>
                <p>Génération et suivi des conventions de stage</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-calendar-alt"></i>
                <h3>Calendrier</h3>
                <p>Planification des périodes de stage</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-tasks"></i>
                <h3>Suivi</h3>
                <p>Évaluation des missions et compétences</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-file-upload"></i>
                <h3>Documents</h3>
                <p>Dépôt et partage des rapports</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-chart-bar"></i>
                <h3>Statistiques</h3>
                <p>Analyse des données de stage</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-comments"></i>
                <h3>Messagerie</h3>
                <p>Communication centralisée</p>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview -->
<section class="dashboard-preview">
    <div class="section-title">
        <h2>Interface Moderne</h2>
        <p class="section-subtitle">Une expérience utilisateur intuitive et personnalisée</p>
    </div>
    <div class="dashboard-container">
        <div class="dashboard-tabs">
            <div class="tab active" data-tab="student">
                <i class="fas fa-user-graduate"></i> Vue Étudiant
            </div>
            <div class="tab" data-tab="supervisor">
                <i class="fas fa-chalkboard-teacher"></i> Vue Encadrant
            </div>
            <div class="tab" data-tab="admin">
                <i class="fas fa-user-shield"></i> Vue Administrateur
            </div>
        </div>
        <div class="dashboard-image">
            <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2090&q=80" 
                 alt="Interface moderne de StagePro" 
                 class="active" 
                 id="student-tab">
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                 alt="Tableau de bord encadrant" 
                 id="supervisor-tab">
            
        </div>
    </div>
</section>

    <!-- Final CTA Section -->
    <section class="final-cta">
        <div class="final-cta-content">
            <h2>Prêt à simplifier votre gestion des stages ?</h2>
            <p>Rejoignez notre plateforme gratuite dès aujourd'hui.</p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="cta-button">
                    <i class="fas fa-rocket"></i> Commencer maintenant
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-about">
                <div class="footer-logo">Stage<span>Pro</span></div>
                <p>La plateforme intelligente pour une gestion optimisée des stages académiques et professionnels.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h3>Solutions</h3>
                <ul>
                    <li><a href="#">Pour les universités</a></li>
                    <li><a href="#">Pour les écoles</a></li>
                    <li><a href="#">Pour les entreprises</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Ressources</h3>
                <ul>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Légal</h3>
                <ul>
                    <li><a href="#">Confidentialité</a></li>
                    <li><a href="#">CGU</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 StagePro. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Simple animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.feature, .feature-card');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const screenPosition = window.innerHeight / 1.3;
                    
                    if (elementPosition < screenPosition) {
                        element.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            };
            
            window.addEventListener('scroll', animateOnScroll);
            animateOnScroll();
        });
    </script>
    <script>
    // Gestion des onglets du dashboard
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab');
        const images = document.querySelectorAll('.dashboard-image img');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Retirer la classe active de tous les onglets et images
                tabs.forEach(t => t.classList.remove('active'));
                images.forEach(img => img.classList.remove('active'));
                
                // Ajouter la classe active à l'onglet cliqué
                this.classList.add('active');
                
                // Afficher l'image correspondante
                const tabName = this.getAttribute('data-tab');
                document.getElementById(`${tabName}-tab`).classList.add('active');
            });
        });
    });
</script>
</body>
</html>