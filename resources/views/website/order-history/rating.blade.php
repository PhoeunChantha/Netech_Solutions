 <style>
     .review-container {
         /* background: #fff; */
         /* padding: 20px; */
         /* border-radius: 8px; */
         /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
         /* width: 400px; */
     }

     .review-title,
     .review-button {
         text-align: center;
         margin-bottom: 10px;
     }

     .review-title h4 {
         margin: 0;
         font-weight: 500;
     }

     .review-container .product-info {
         display: flex;
         align-items: center;
         border: 1px solid #ddd;
         padding: 10px;
         border-radius: 5px;
         margin-bottom: 20px;
     }

     .review-container .product-info img {
         width: 50px;
         height: 50px;
         border-radius: 5px;
         margin-right: 10px;
     }

     .review-container .product-info .product-details {
         font-size: 14px;
     }

     .product-details .price {
         color: red;
     }

     .stars {
         display: flex;
         justify-content: center;
         gap: 5px;
         margin-bottom: 15px;
     }

     .stars i {
         font-size: 31px;
         cursor: pointer;
         /* color: black; */
         /* Default star color */
     }

     .stars i.filled {
         color: #FFD43B;
         /* Filled star color */
     }

     .review-textarea,
     .upload-image {
         margin-bottom: 15px;
     }

     /* .review-textarea textarea {
         width: 100%;
         height: 60px;
         padding: 8px;
         font-size: 14px;
         border-radius: 5px;
         border: 1px solid #ddd;
         resize: none;
     } */

     .upload-image {
         /* display: flex; */
         align-items: center;
         gap: 10px;
     }

     .upload-image img {
         width: 70px;
         height: 70px;
         border-radius: 5px;
         object-fit: cover;
     }

     .upload-placeholder {
         width: 70px;
         height: 70px;
         border: 1px dashed #ddd;
         border-radius: 5px;
         display: flex;
         justify-content: center;
         align-items: center;
         color: #888;
         font-size: 24px;
     }

     .review-button button {
         width: 100%;
         padding: 10px;
         background-color: #a00202;
         color: #fff;
         border: none;
         border-radius: 5px;
         font-size: 16px;
         cursor: pointer;
     }
 </style>
 <div id="rating" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="my-modal-title">Submit A Review</h5>
                 {{-- <button class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button> --}}
             </div>
             <form action="" method="post">
                 <div class="modal-body">
                     <div class="review-container">
                         <div class="product-info">
                             <img src="https://via.placeholder.com/50" alt="Product Image">
                             <div class="product-details">
                                 <div>Acer desktop</div>
                                 <div>Qty: 1</div>
                                 <div class="price">Price: $20.00</div>
                             </div>
                         </div>
                         <div class="review-title">
                             <h4>Rating The Quality</h4>
                         </div>
                         <div class="stars">
                             <i class="fa-regular fa-star" data-value="1"></i>
                             <i class="fa-regular fa-star" data-value="2"></i>
                             <i class="fa-regular fa-star" data-value="3"></i>
                             <i class="fa-regular fa-star" data-value="4"></i>
                             <i class="fa-regular fa-star" data-value="5"></i>
                         </div>
                         <div id="rating-value">Rating: 0</div>

                         <div class="review-textarea mt-3">
                             <label for="review-text">Have thoughts to share?</label>
                             <textarea id="review-text" class="form-control" rows="3" placeholder="This Product is the best"></textarea>
                         </div>

                         <div class="upload-image">
                             <label>Upload Image</label>
                             <div class="d-flex align-items-center gap-2 mt-2">
                                 <div id="imageContainer" class="d-flex align-items-center gap-2"></div>
                                 <div class="upload-placeholder">
                                     <i class="fas fa-image"></i>
                                 </div>
                                 <input type="file" id="fileInput" accept="image/*" multiple style="display:none;">
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <div class="review-button">
                         <button type="button">Review</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
