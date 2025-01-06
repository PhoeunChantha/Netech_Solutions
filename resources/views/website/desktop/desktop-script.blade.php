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

<script>
    var lowerSlider = document.querySelector('#lower');
    var upperSlider = document.querySelector('#upper');

    document.querySelector('#two').value = upperSlider.value;
    document.querySelector('#one').value = lowerSlider.value;

    var lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);

    upperSlider.oninput = function() {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);

        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
                upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value = this.value
    };

    lowerSlider.oninput = function() {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value = this.value
    };
</script>
<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
    });
</script>
