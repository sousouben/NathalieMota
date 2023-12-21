console.log("modale ok");

$(document).ready(() => {
  // Sélection des éléments du DOM
  const CONTACT_LINK = $("#menu-item-40");
  const MODAL_OVERLAY = $(".bg_modale");
  const referencePhoto = $("#ref");
  const boutonContact = $("#boutonContact");

  // Fonction pour ouvrir la modale
  const openModal = () => {
    // Affichage de la modale en utilisant Flexbox
    MODAL_OVERLAY.css("display", "flex");
    if (
      boutonContact.attr("data-reference") &&
      boutonContact.attr("data-reference").trim() !== ""
    ) {
      referencePhoto.val(boutonContact.attr("data-reference"));
    }
  };

  // Fonction pour fermer la modale
  const closeModal = () => {
    MODAL_OVERLAY.css("display", "none");
  };

  // Gestionnaires d'événements pour l'ouverture de la modale
  CONTACT_LINK.on("click", (event) => {
    event.preventDefault();
    openModal();
  });

  boutonContact.on("click", function (event) {
    event.preventDefault();
    openModal();
  });

  // Gestionnaire d'événement pour la fermeture de la modale lors d'un clic en dehors
  $(window).on("click", (event) => {
    if (event.target === MODAL_OVERLAY[0]) {
      closeModal();
    }
  });
});
