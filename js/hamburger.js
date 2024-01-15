console.log("hamburger ok");
/*Ouverture menu*/

// Menu hamburger
const hamburgerIcon = document.querySelector(".hamburger-icon");
const crossIcon = document.querySelector(".cross-icon");
const mobileMenu = document.querySelector(".mobile-menu");
const body = document.querySelector("body");

// Fonction pour ouvrir le menu hamburger en version mobile
function openMobileMenu() {
  mobileMenu.classList.add("open");
  hamburgerIcon.style.display = "none";
  crossIcon.style.display = "block";
  body.style.overflow = "hidden";
}

// Fonction pour fermer le menu hamburger en version mobile
function closeMobileMenu() {
  mobileMenu.classList.remove("open");
  hamburgerIcon.style.display = "block";
  crossIcon.style.display = "none";
  body.style.overflow = "scroll";
}

// Ouverture du menu au clic sur le hamburger
hamburgerIcon.addEventListener("click", openMobileMenu);

// Fermeture du menu au clic sur la croix
crossIcon.addEventListener("click", closeMobileMenu);
