/**
 * Script de protection des animations et proportions de la navbar
 * Empêche toute modification dynamique des styles critiques
 */

(function() {
    'use strict';
    
    // Configuration des proportions fixes
    const NAVBAR_CONFIG = {
        logoIconSize: 80,
        logoIconSizeMobile: 70,
        headerTopHeight: 40,
        mainHeaderMinHeight: 110,
        animationDuration: 300, // ms
        animationEasing: 'cubic-bezier(0.4, 0, 0.2, 1)'
    };
    
    /**
     * Force les proportions de la navbar au chargement de la page
     */
    function enforceNavbarProportions() {
        const header = document.querySelector('header');
        const logoIcon = document.querySelector('.logo-icon');
        const headerTop = document.querySelector('.header-top');
        const mainHeader = document.querySelector('.main-header');
        
        if (header) {
            header.style.setProperty('position', 'sticky', 'important');
            header.style.setProperty('top', '0', 'important');
            header.style.setProperty('z-index', '1000', 'important');
        }
        
        if (headerTop) {
            headerTop.style.setProperty('height', NAVBAR_CONFIG.headerTopHeight + 'px', 'important');
        }
        
        if (logoIcon) {
            const isMobile = window.innerWidth <= 768;
            const size = isMobile ? NAVBAR_CONFIG.logoIconSizeMobile : NAVBAR_CONFIG.logoIconSize;
            logoIcon.style.setProperty('width', size + 'px', 'important');
            logoIcon.style.setProperty('height', size + 'px', 'important');
        }
        
        if (mainHeader) {
            mainHeader.style.setProperty('min-height', NAVBAR_CONFIG.mainHeaderMinHeight + 'px', 'important');
        }
    }
    
    /**
     * Protège les animations de la navbar
     */
    function protectNavbarAnimations() {
        const navLinks = document.querySelectorAll('nav ul li a');
        const cartIcon = document.querySelector('.cart-icon a');
        const adminBtn = document.querySelector('.admin-btn');
        const headerContacts = document.querySelectorAll('.header-contact a');
        const socialLinks = document.querySelectorAll('.social-links a');
        
        // Applique les animations uniformes
        const elementsToAnimate = [
            ...navLinks,
            cartIcon,
            adminBtn,
            ...headerContacts,
            ...socialLinks
        ].filter(el => el !== null);
        
        elementsToAnimate.forEach(element => {
            element.style.setProperty(
                'transition', 
                `all ${NAVBAR_CONFIG.animationDuration}ms ${NAVBAR_CONFIG.animationEasing}`,
                'important'
            );
        });
        
        // Protection des pseudo-éléments (lignes de soulignement)
        navLinks.forEach(link => {
            // Création d'un style inline pour le pseudo-élément via une classe
            link.classList.add('nav-link-animated');
        });
    }
    
    /**
     * Observe les changements et réapplique les styles si nécessaire
     */
    function setupMutationObserver() {
        const header = document.querySelector('header');
        if (!header) return;
        
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    enforceNavbarProportions();
                }
            });
        });
        
        observer.observe(header, {
            attributes: true,
            attributeFilter: ['style', 'class'],
            subtree: true
        });
    }
    
    /**
     * Gère le redimensionnement de la fenêtre
     */
    function handleResize() {
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                enforceNavbarProportions();
            }, 250);
        });
    }
    
    /**
     * Marque le lien actif dans la navigation
     */
    function setActiveNavLink() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('nav ul li a:not(.admin-btn)');
        
        navLinks.forEach(link => {
            // Retire la classe active de tous les liens sauf le panier
            if (!link.closest('.cart-icon')) {
                link.classList.remove('active');
            }
            
            const linkHref = link.getAttribute('href');
            
            // Gestion des liens avec ancres
            if (linkHref && linkHref.includes('#')) {
                const linkPath = linkHref.split('#')[0];
                const linkHash = linkHref.split('#')[1];
                
                // Si c'est un lien ancre vers la page actuelle
                if (linkPath === '' || linkPath === currentPath || linkPath.endsWith('accueil')) {
                    if (currentPath === '/' || currentPath === '/accueil' || currentPath.includes('accueil')) {
                        // Active uniquement si le hash correspond ou si c'est "Accueil" sans hash
                        if (window.location.hash && linkHref.includes(window.location.hash)) {
                            link.classList.add('active');
                        } else if (!window.location.hash && link.textContent.trim() === 'Accueil') {
                            link.classList.add('active');
                        }
                    }
                }
            } else {
                // Pour les liens normaux sans ancre
                try {
                    const linkURL = new URL(link.href, window.location.origin);
                    const linkPath = linkURL.pathname;
                    
                    // Active le lien si le chemin correspond exactement
                    if (linkPath === currentPath) {
                        link.classList.add('active');
                    }
                    // Cas spécial pour l'accueil
                    else if ((currentPath === '/' || currentPath === '/accueil') && 
                             (linkPath === '/' || linkPath.includes('accueil'))) {
                        link.classList.add('active');
                    }
                    // Pour les autres pages, correspondance partielle
                    else if (linkPath !== '/' && currentPath.includes(linkPath) && linkPath.length > 1) {
                        link.classList.add('active');
                    }
                } catch (e) {
                    // Ignore les liens invalides
                    console.warn('Invalid link:', link.href);
                }
            }
        });
    }
    
    /**
     * Initialisation au chargement du DOM
     */
    document.addEventListener('DOMContentLoaded', function() {
        // Application des protections
        enforceNavbarProportions();
        protectNavbarAnimations();
        setActiveNavLink();
        setupMutationObserver();
        handleResize();
        
        // Écouter les changements de hash pour les liens ancres
        window.addEventListener('hashchange', setActiveNavLink);
        
        console.log('✅ Navbar protection active - Proportions et animations garanties');
    });
    
    /**
     * Réapplication après chargement complet (images, etc.)
     */
    window.addEventListener('load', function() {
        setTimeout(() => {
            enforceNavbarProportions();
        }, 100);
    });
    
    /**
     * Expose les fonctions pour un usage externe si nécessaire
     */
    window.NavbarProtection = {
        enforce: enforceNavbarProportions,
        config: NAVBAR_CONFIG
    };
    
})();
