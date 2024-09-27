<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const productItems = document.querySelectorAll('.product-item');

        function filterProducts(filter) {
            let hasVisibleProducts = false;

            productItems.forEach(item => {
                const brandName = item.getAttribute('data-brand-name').toLowerCase();

                if (filter === 'all') {
                    item.style.display = 'block';
                    hasVisibleProducts = true;
                } else if (filter === 'window' && brandName !== 'apple') {
                    item.style.display = 'block';
                    hasVisibleProducts = true;
                } else if (filter === 'apple' && brandName === 'apple') {
                    item.style.display = 'block';
                    hasVisibleProducts = true;
                } else {
                    item.style.display = 'none';
                }
            });

            if (hasVisibleProducts) {
                Swal.close();
            } else {
                Swal.fire({
                    title: 'No Products Available',
                    text: 'No products match your filter criteria.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                }).then(() => {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    document.querySelector('.filter-btn[data-filter="all"]').classList.add('active');
                    filterProducts('all');
                });
            }
        }
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');

                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                filterProducts(filter);
            });
        });

        filterProducts('all');
    });
</script>
{{-- <script>
      document.addEventListener("DOMContentLoaded", function() {
          const productContainer = document.querySelector(".product");
          const images = productContainer.querySelectorAll("img");
          const numberOfImages = images.length;

          // Duplicate the images to create a seamless loop
          for (let i = 0; i < numberOfImages; i++) {
              const clone = images[i].cloneNode(true);
              productContainer.appendChild(clone);
          }

          let scrollAmount = 0;

          function scrollImages() {
              scrollAmount -= 1; // Adjust this value to control the speed
              if (scrollAmount <= -productContainer.scrollWidth / 2) {
                  scrollAmount = 0;
              }
              productContainer.style.transform = `translateX(${scrollAmount}px)`;
              requestAnimationFrame(scrollImages);
          }

          scrollImages();
      });
  </script> --}}
