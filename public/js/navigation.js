// Navigation.js - Gestion de la navigation et des ancres

document.addEventListener('DOMContentLoaded', function() {
    initNavigation();
});

function initNavigation() {
    // Gérer le scroll vers les ancres au chargement de la page
    if (window.location.hash) {
        setTimeout(function() {
            scrollToSection(window.location.hash);
        }, 100);
    }
    
    // Gérer les clics sur les liens avec ancres
    const navLinks = document.querySelectorAll('nav a[href*="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Si le lien contient une ancre
            if (href.includes('#')) {
                const parts = href.split('#');
                const targetId = '#' + parts[parts.length - 1];
                
                // Si l'ancre cible une section sur la page actuelle
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    // Section trouvée sur cette page - faire un scroll fluide
                    e.preventDefault();
                    scrollToSection(targetId);
                    
                    // Mettre à jour l'URL sans recharger
                    history.pushState(null, null, targetId);
                } else {
                    // Section non trouvée - laisser le navigateur gérer la navigation
                    // vers la page contenant cette section
                    // La navigation normale se fera vers la page d'accueil avec l'ancre
                }
            }
        });
    });
    
    // Mettre à jour les liens actifs lors du scroll
    setupScrollSpy();
}

function scrollToSection(targetId) {
    const targetSection = document.querySelector(targetId);
    
    if (targetSection) {
        const header = document.querySelector('header');
        const headerHeight = header ? header.offsetHeight : 0;
        const targetPosition = targetSection.offsetTop - headerHeight - 20;
        
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }
}

function setupScrollSpy() {
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateActiveLinks();
                ticking = false;
            });
            ticking = true;
        }
    });
}

function updateActiveLinks() {
    const sections = document.querySelectorAll('section[id]');
    const header = document.querySelector('header');
    const headerHeight = header ? header.offsetHeight : 0;
    let currentSection = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop - headerHeight - 100;
        const sectionBottom = sectionTop + section.offsetHeight;
        const scrollPosition = window.scrollY;
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
            currentSection = section.getAttribute('id');
        }
    });
    
    // Mettre à jour les liens actifs
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        
        if (href && currentSection) {
            // Vérifier si le lien pointe vers la section actuelle
            if (href.includes('#' + currentSection) || href === '#' + currentSection) {
                link.classList.add('active');
            }
        }
        
        // Marquer "Accueil" comme actif si on est tout en haut
        if (window.scrollY < 100 && (href === '/' || href.includes('accueil') && !href.includes('#'))) {
            link.classList.add('active');
        }
    });
}

// Exporter les fonctions pour utilisation externe si nécessaire
window.scrollToSection = scrollToSection;
