 <script>
     const content = [{
             title: 'Camera security Installer',
             description: 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty',
             image: '/website/upload/service.png',
             backgroundImage: '/website/upload/service.png'
         },
         {
             title: 'Set up and install network',
             description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s  when an unknown printer took a galley of type and scrambled it to make a ty',
             image: '/website/upload/service1.png',
             backgroundImage: '/website/upload/service1.png'
         },
         {
             title: 'Wifi solution',
             description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s  when an unknown printer took a galley of type and scrambled it to make a ty',
             image: '/website/upload/service2.png',
             backgroundImage: '/website/upload/service2.png'
         },
         {
             title: 'Solution for data back up',
             description: 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty',
             image: '/website/upload/service3.png',
             backgroundImage: '/website/upload/service3.png'
         }
         // Add more objects for additional items
     ];

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
         divTitle.classList.add('fade-out');
         const serviceImage = document.getElementById('serviceImage');
         serviceImage.classList.add('fade-out');
         setTimeout(() => {
             const currentContent = content[currentIndex];
             document.getElementById('divTitle').textContent = currentContent.title;
             document.getElementById('divDescription').textContent = currentContent.description;
             document.getElementById('serviceImage').src = currentContent.image;
             document.getElementById('cardBackground').style.backgroundImage =
                 `url(${currentContent.backgroundImage})`;
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
 <script>
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
 </script>
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
