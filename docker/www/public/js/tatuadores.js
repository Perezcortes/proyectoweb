document.addEventListener("DOMContentLoaded", function () {
  var swiper = new Swiper(".swiper-container", {
    slidesPerView: "auto", // Mostrar múltiples imágenes
    spaceBetween: 10,
    centeredSlides: false, // No centrado, todas las imágenes visibles
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  document.querySelectorAll(".swiper-slide img").forEach((img) => {
    img.addEventListener("click", function () {
      var imageView = document.createElement("div");
      imageView.style.position = "fixed";
      imageView.style.top = "0";
      imageView.style.left = "0";
      imageView.style.width = "100%";
      imageView.style.height = "100%";
      imageView.style.backgroundColor = "rgba(0, 0, 0, 0.9)";
      imageView.style.display = "flex";
      imageView.style.alignItems = "center";
      imageView.style.justifyContent = "center";
      imageView.innerHTML =
        '<img src="' + img.src + '" style="max-width:90%; max-height:90%;">';
      document.body.appendChild(imageView);

      imageView.addEventListener("click", function () {
        document.body.removeChild(imageView);
      });
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  let searchBar = document.getElementById("searchBar");
  let searchButton = document.getElementById("searchButton");
  let results = document.getElementById("results");

  function performSearch() {
    let searchTerm = searchBar.value.trim();
    if (searchTerm === "") {
      results.innerHTML = "Por favor, ingresa un término de búsqueda.";
      return;
    }

    // Realizar la solicitud al backend
    fetch(`controller.php?search=${encodeURIComponent(searchTerm)}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.length > 0) {
          // Buscar en el DOM y hacer scroll
          let found = false;
          data.forEach((tatuador) => {
            let artistElements = document.querySelectorAll(
              ".artist-header .artist-name"
            );
            artistElements.forEach((artist) => {
              if (
                artist.textContent
                  .toLowerCase()
                  .includes(tatuador.nombre.toLowerCase())
              ) {
                found = true;
                artist.scrollIntoView({ behavior: "smooth" });
              }
            });
          });

          if (!found) {
            results.innerHTML =
              "No se encontró la sección correspondiente en la página.";
          }
        } else {
          results.innerHTML = "No se encontraron tatuadores con ese nombre.";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        results.innerHTML = "Hubo un error al buscar los tatuadores.";
      });
  }

  searchButton.addEventListener("click", performSearch);
});
