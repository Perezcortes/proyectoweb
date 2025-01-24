document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 'auto',  // Mostrar múltiples imágenes
      spaceBetween: 10,
      centeredSlides: false, // No centrado, todas las imágenes visibles
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  
    document.querySelectorAll('.swiper-slide img').forEach(img => {
      img.addEventListener('click', function () {
        var imageView = document.createElement('div');
        imageView.style.position = 'fixed';
        imageView.style.top = '0';
        imageView.style.left = '0';
        imageView.style.width = '100%';
        imageView.style.height = '100%';
        imageView.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
        imageView.style.display = 'flex';
        imageView.style.alignItems = 'center';
        imageView.style.justifyContent = 'center';
        imageView.innerHTML = '<img src="' + img.src + '" style="max-width:90%; max-height:90%;">';
        document.body.appendChild(imageView);
  
        imageView.addEventListener('click', function () {
          document.body.removeChild(imageView);
        });
      });
    });
  });
  