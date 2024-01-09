console.log("ajax ok");

(function ($) {
  // Fonction pour charger plus d'images
  function loadMoreImages() {
    const button = $(this);
    const data = {
      action: "load_more",
      query: ajaxChargerPlus.query_vars,
      page: button.data("page"),
    };

    $.ajax({
      url: ajax_object.ajaxurl,
      data: data,
      type: "POST",
      beforeSend: function () {
        button.text("Chargement...");
      },
      success: function (data) {
        if (data === "no_posts") {
          button.text("Aucune photo disponible");
        } else if (data) {
          button.data("page", button.data("page") + 1);
          $("#btnchargPlus").before($(data));
          button.text("Charger plus");
          // La fonction attachEventsToImages() a été supprimée
        }
      },
      error: function (status, error) {
        console.error("Erreur lors de la requête AJAX:", status, error);
        button.text("Erreur de chargement");
      },
    });
  }

  // Gestion du clic sur le bouton d'ajout d'images
  $("#imagePlus").click(loadMoreImages);
})(jQuery);
