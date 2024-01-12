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

  // Fonction pour filtrer les photos
  function filteredPhotos() {
    const filters = {
      categorie: $("#categorie").val(),
      format: $("#format").val(),
      annees: $("#annees").val(),
    };

    // Vérifier si tous les filtres sont vides
    const areFiltersEmpty = Object.values(filters).every((value) => !value);

    // Si tous les filtres sont vides, actualiser la page
    if (areFiltersEmpty) {
      location.reload();
      return;
    }

    // Sinon, effectuer la requête AJAX de filtrage
    $.ajax({
      url: ajax_object.ajaxurl,
      data: {
        action: "filter_photos",
        filter: filters,
      },
      type: "POST",
      beforeSend: function () {
        $("#galerie").html('<div class="load">Chargement...</div>');
      },
      success: function (data) {
        $("#galerie").html(data);
        setTimeout(function () {
          document.getElementById("galerie").scrollIntoView();
        }, 0);
      },
    });
  }

  // Gestion du changement dans les filtres
  $("#dropdown select").on("change", function (event) {
    event.preventDefault();
    filteredPhotos();
  });

  // Initialisation de select2 pour les éléments avec la classe "taxonomy-select"
  $(document).ready(function () {
    $(".taxonomy-select").select2({
      dropdownPosition: "below",
    });
  });
})(jQuery);
