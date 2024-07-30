document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.cart-increment').forEach(button => {
        button.addEventListener('click', function () {
            let quantityElement = this.previousElementSibling;
            let quantity = parseInt(quantityElement.textContent, 10);
            quantityElement.textContent = quantity + 1;
        });
    });
  
    document.querySelectorAll('.cart-decrement').forEach(button => {
        button.addEventListener('click', function () {
            let quantityElement = this.nextElementSibling;
            let quantity = parseInt(quantityElement.textContent, 10);
            if (quantity > 1) {
                quantityElement.textContent = quantity - 1;
            }
        });
    });
  });
  
  const prev = document.querySelector(".prev");
  const next = document.querySelector(".next");
  const carousel = document.querySelector(".carousel-container");
  const track = document.querySelector(".track");
  let width = carousel.offsetWidth;
  let index = 0;
  window.addEventListener("resize", function () {
    width = carousel.offsetWidth;
  });
  next.addEventListener("click", function (e) {
    e.preventDefault();
    index = index + 1;
    prev.classList.add("show");
    track.style.transform = "translateX(" + index * -width + "px)";
    if (track.offsetWidth - index * width < index * width) {
      next.classList.add("hide");
    }
  });
  prev.addEventListener("click", function () {
    index = index - 1;
    next.classList.remove("hide");
    if (index === 0) {
      prev.classList.remove("show");
    }
    track.style.transform = "translateX(" + index * -width + "px)";
  });