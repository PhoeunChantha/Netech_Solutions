
<script>
    const content =
        @json($services);
    let currentIndex = 0;

    document.getElementById('nextButton').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % content.length;
        updateContent('slide-up');
    });

    document.getElementById('prevButton').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + content.length) % content.length;
        updateContent('slide-down');
    });

    function updateContent(animationClass) {
        const divTitle = document.getElementById('divTitle');
        const serviceImage = document.getElementById('serviceImage');

        // Add fade-out animation
        divTitle.classList.add('fade-out');
        serviceImage.classList.add('fade-out');

        setTimeout(() => {
            const currentContent = content[currentIndex];

            // Update text content and image source, adjust field names if necessary
            divTitle.textContent = currentContent.name; // Adjust to `currentContent.title` if needed
            document.getElementById('divDescription').textContent = currentContent.description;

            // Set image source, prepend path if `thumbnails` doesn't include the full path
            serviceImage.src = currentContent.thumbnails ? `uploads/serviceimg/${currentContent.thumbnails}` :
                'uploads/defualt.png';
            document.getElementById('cardBackground').style.backgroundImage =
                `url(${currentContent.thumbnails ? `uploads/serviceimg/${currentContent.thumbnails}` : 'uploads/defualt.png'})`;

            // Remove fade-out and apply animation class
            divTitle.classList.remove('fade-out');
            divTitle.classList.add(animationClass);
            serviceImage.classList.remove('fade-out');
            serviceImage.classList.add(animationClass);
        }, 500); // Match the CSS transition duration

        setTimeout(() => {
            divTitle.classList.remove(animationClass);
            serviceImage.classList.remove(animationClass);
        }, 1000); // Match the CSS transition duration
    }

    // Initial content load
    updateContent('slide-up');
</script>


{{-- <script>
     document.addEventListener('DOMContentLoaded', function() {
         var modalElement = document.getElementById('videoModal');

         modalElement.addEventListener('hide.bs.modal', function() {
             var video = document.getElementById('modalVideo');
             var iframe = document.getElementById('modalIframe');

             if (video) {
                 video.pause();
                 video.currentTime = 0;
             }

             if (iframe) {
                 iframe.src = iframe.src;
             }
         });
     });
 </script> --}}
<script>
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
</script>
