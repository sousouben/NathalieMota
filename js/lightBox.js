console.log("Lightbox ok");

$(document).ready(function () {
  const $lightbox = $("#lightboxWrapper");
  const $lightboxImage = $(".lightboxImage");
  const $lightboxCategory = $(".lightboxCategory");
  const $lightboxReference = $(".lightboxReference");
  const $lightboxOpen = $(".lightboxContainer");
  let currentIndex = 0;

  function updateLightbox(index) {
    const $images = $(".fullscreen-icon");
    const $image = $images.eq(index);

    const categoryText = $image.data("category").toUpperCase();
    const referenceText = $image.data("reference").toUpperCase();

    $lightboxImage.attr("src", $image.data("full"));
    $lightboxCategory.text(categoryText);
    $lightboxReference.text(referenceText);
    currentIndex = index;
  }

  function openLightbox(index) {
    $lightboxOpen.css("display", "flex");
    updateLightbox(index);
    $lightbox.show();
  }

  function closeLightbox() {
    $lightboxOpen.css("display", "none");
    $lightbox.hide();
  }

  window.attachEventsToImages = function () {
    const $images = $(".fullscreen-icon");
    $images.off("click", imageClickHandler);
    $images.on("click", imageClickHandler);
  };

  function imageClickHandler() {
    const $images = $(".fullscreen-icon");
    const index = $images.index($(this).closest(".fullscreen-icon"));
    openLightbox(index);
  }

  attachEventsToImages();

  $(".closeLightbox").on("click", closeLightbox);

  $(".lightboxPrevious").on("click", function () {
    const $images = $(".fullscreen-icon");
    currentIndex = (currentIndex - 1 + $images.length) % $images.length;
    updateLightbox(currentIndex);
  });

  $(".lightboxNext").on("click", function () {
    const $images = $(".fullscreen-icon");
    currentIndex = (currentIndex + 1) % $images.length;
    updateLightbox(currentIndex);
  });
});
