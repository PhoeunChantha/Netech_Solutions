<style>
     #payment_modal .modal-content {
        border: none;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    #payment_modal .modal-header {
        background: linear-gradient(135deg, #2980b9, #1a5276);
        color: white;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        padding: 15px 20px;
    }

    #payment_modal .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
        letter-spacing: 0.5px;
    }

    #payment_modal .close {
        color: white;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    #payment_modal .close:hover {
        opacity: 1;
    }

    #payment_modal .modal-body {
        padding: 25px;
        background-color: #f8f9fa;
    }

    /* Form Control Styling */
    #payment_modal .form-control {
        border-radius: 4px;
        border: 1px solid #dee2e6;
        padding: 10px 15px;
        height: auto;
        transition: all 0.3s;
        box-shadow: none;
    }

    #payment_modal .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    #payment_modal .input-group-text {
        background-color: #4e73df;
        color: white;
        border: none;
        border-radius: 4px 0 0 4px;
    }

    #payment_modal select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 8px 10px;
        padding-right: 30px;
    }

    /* Calculator Styling */
    .payment-calculator {
        background-color: white;
        /* border-radius: 8px; */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 20px;
    }

    .payment-calculator label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 8px;
        display: block;
    }

    #recieve_amount {
        font-size: 1.25rem;
        font-weight: 500;
        text-align: right;
        height: 50px;
    }

    .calc-buttons {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 4px;
        margin-top: 15px;
    }

    .key-pad {
        padding: 12px;
        font-weight: 500;
        font-size: 1rem;
        border: none;
        border-radius: 4px;
        transition: all 0.2s;
    }

    /* Button styling for different types */
    .key-pad:not(.btn-danger) {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #e2e6ea;
    }

    .key-pad:not(.btn-danger):hover {
        background-color: #e2e6ea;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Special styling for buttons with monetary values */
    .key-pad:nth-child(4n), 
    .key-pad:nth-child(5n) {
        background-color: #eaecf4;
        color: #4e73df;
        font-weight: 600;
    }

    .key-pad:nth-child(4n):hover, 
    .key-pad:nth-child(5n):hover {
        background-color: #d8dcf0;
    }

    .key-pad.btn-danger {
        background-color: #e74a3b;
    }

    .key-pad.btn-danger:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Payment Summary Styling */
    .payment-summary {
        background-color: white;
        /* border-radius: 8px; */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        height: 100%;
    }

    .payment-summary:before {
        content: 'Payment Summary';
        display: block;
        font-size: 1.1rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
    }

    .summary-item {
        padding: 12px 0;
        display: flex;
        justify-content: space-between;
        font-size: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-item span {
        font-weight: 500;
    }

    .summary-item span:last-child {
        font-weight: 600;
    }

    /* Specific styling for different amount displays */
    #payment_display {
        color: #e74a3b;
        font-size: 1.1rem;
    }

    #recieve_display {
        color: #4e73df;
        font-size: 1.1rem;
    }

    #change_return {
        color: #1cc88a;
        font-size: 1.1rem;
    }

    .due-amount {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 6px;
        margin-top: 10px;
    }

    #due_amount {
        color: #e74a3b;
        font-size: 1.25rem;
        font-weight: 700;
    }

    /* Done Button Styling */
    .btn-done {
        background: linear-gradient(135deg, #1cc88a, #169b6b);
        color: white;
        border: none;
        border-radius: 4px;
        padding: 12px 20px;
        font-weight: 600;
        width: 100%;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-done:hover {
        background: linear-gradient(135deg, #169b6b, #148f6c);
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    .btn-done:active {
        transform: translateY(0);
    }

</style>
<style>
    /* Professional Payment Section Styling */

    .pay {
        margin-top: 1.5rem;
    }

    .pay .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        background-color: #ffffff;
        overflow: hidden;
    }

    /* Order Summary Section */
    .pay .container {
        padding: 0;
    }

    .pay .row {
        margin: 0;
    }

    /* Left column - Order details */
    .pay .col-md-9 {
        padding: 0.5rem;
        background-color: #f8f9fa;
        border-right: 1px solid #e9ecef;
    }

    /* Right column - Action buttons */
    .pay .col-md-3 {
        padding: 1.5rem 1rem;
        background-color: #ffffff;
    }

    /* Line items in the summary */
    .pay .d-flex {
        border-bottom: 1px solid #e9ecef;
        padding: 0 !important;
        margin-bottom: 0.8rem;
    }

    .pay .d-flex:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .pay .d-flex.line {
        margin-top: 0.6rem;
    }

    /* Column labels */
    .pay .col-md-6:first-child {
        text-align: left;
        font-weight: 500;
        color: #495057;
    }

    /* Amount values */
    .pay .col-md-6:last-child {
        text-align: right;
        font-weight: 600;
        color: #212529;
    }

    /* Styling for total row */
    .pay .d-flex:last-child .col-md-6:first-child {
        font-weight: 700;
        font-size: 1.1rem;
        color: #212529;
    }

    .pay .d-flex:last-child .col-md-6:last-child {
        font-weight: 700;
        font-size: 1.1rem;
        color: #0d6efd;
    }

    /* Button styling */
    .pay .btn {
        border-radius: 6px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .pay .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .pay .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Discount button styling */
    .pay .discount-price {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .pay .discount-price:hover {
        background-color: #5c636a;
        border-color: #565e64;
    }

    .pay .discount-price img {
        width: 16px;
        height: 16px;
        margin-right: 8px;
    }

    /* Pay button styling - make it stand out */
    .pay .btn-pay-price {
        background-color: #198754;
        border-color: #198754;
        margin-top: 0.5rem;
    }

    .pay .btn-pay-price:hover {
        background-color: #157347;
        border-color: #146c43;
    }

    /* Highlight animation for total changes */
    @keyframes highlight {
        0% {
            color: #0d6efd;
        }

        50% {
            color: #0a58ca;
        }

        100% {
            color: #0d6efd;
        }
    }

    .total-container.highlight,
    .subtotal-container.highlight,
    .discount-container.highlight {
        animation: highlight 0.6s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .pay .row {
            flex-direction: column;
        }

        .pay .col-md-9 {
            border-right: none;
            border-bottom: 1px solid #e9ecef;
        }

        .pay .col-md-3 {
            padding-top: 1rem;
            flex-direction: row !important;
            justify-content: space-between !important;
        }

        .pay .btn {
            width: 48% !important;
            margin: 0 !important;
        }
    }
</style>
<style>
    .category-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 8px;
        background-color: #f8f9fa;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .category-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 76px;
        height: 76px;
        padding: 10px;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .category-card.selected {
        /* background-color: #007bff; */
        border: 1px solid #007bff;
        color: black;
        /* border: none; */
    }
    .category-card:hover {
        /* background-color: #007bff; */
        border: 1px solid #007bff;
        color: black;
        /* border: none; */
    }

    .category-card img {
        width: 32px;
        height: 32px;
        object-fit: contain;
        margin-bottom: 5px;
    }

    .category-card p {
        margin: 0;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 100%;
    }

    /* Product Search Styling */
    .product-search {
        /* margin-bottom: 15px; */
    }

    .product-search .input-group {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    .product-search .input-group-text {
        background-color: #f8f9fa;
        border: none;
        color: #6c757d;
    }

    .product-search .form-control {
        border: none;
        padding: 7px;
        height: auto;
    }

    .product-search .form-control:focus {
        box-shadow: none;
        border-color: #007bff;
    }

    /* Product Grid Styling */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 15px;
        max-height: 66vh;
        overflow-y: auto;
        padding-right: 5px;
    }

    .product-grid::-webkit-scrollbar {
        width: 5px;
    }

    .product-grid::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .product-grid::-webkit-scrollbar-thumb {
        background: #d1d1d1;
        border-radius: 10px;
    }

    .product-card {
        position: relative;
        display: flex;
        flex-direction: column;
        border-radius: 8px;
        overflow: hidden;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
        width: 100%;
        height: 100px;
        object-fit: contain;
        border-bottom: 1px solid #f0f0f0;
    }

    .product-card .product-title {
        margin: 8px;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.2;
        height: 34px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-card .div-price {
        display: flex;
        flex-direction: column;
        margin: 0 8px 8px;
    }

    .product-card .product-price {
        font-size: 14px;
        color: #212529;
    }

    .product-card .discount-price {
        font-weight: 600;
        color: #007bff;
    }

    .product-card .original-price {
        font-size: 12px;
        color: #6c757d;
    }

    .product-card .discount-amount {
        position: absolute;
        top: 0px;
        width: 32%;
        padding: 3px 6px;
        border-radius: 0px;
        font-size: 10px;
        font-weight: 600;
    }

    .product-card .instock,
    .product-card .out-stock {
        margin: 0 8px 8px;
        font-size: 12px;
        font-weight: 500;
    }

    .product-card .instock {
        color: #28a745;
    }

    .product-card .out-stock {
        color: #dc3545;
    }

    /* Product Table Styling */
    #product-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    #product-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        padding: 12px 15px;
        text-align: left;
        border-bottom: 2px solid #dee2e6;
    }

    #product-table td {
        padding: 12px 15px;
        /* border-bottom: 1px solid #dee2e6; */
        vertical-align: middle;
    }

    #product-table tr:last-child td {
        border-bottom: none;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-control button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
        color: #212529;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .quantity-control button:hover {
        background-color: #e9ecef;
    }

    .quantity-control .quantity {
        font-size: 14px;
        font-weight: 500;
    }

    .btn-delete {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        opacity: 0.7;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }

        .category-card {
            width: 70px;
            height: 70px;
        }
    }

    .btn-delete .fa-trash {
        font-size: 18px;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* calculator */
    .modal-body {
        display: flex;
        flex-wrap: wrap;
    }

    .payment-calculator {
        flex: 2;
        border-right: 1px solid #ddd;
        padding-right: 20px;
    }

    .payment-summary {
        flex: 1;
        padding-left: 20px;
    }

    .calc-buttons button {
        width: 60px;
        height: 60px;
        margin: 5px;
        font-size: 18px;
    }

    .btn-done {
        width: 100%;
        background-color: #28a745;
        color: white;
        border: none;
        font-size: 18px;
    }

    .summary-item {
        font-size: 16px;
        margin-bottom: 10px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
    }

    .summary-item span {
        font-weight: bold;
    }

    .summary-item .text-danger {
        color: red !important;
    }

    .summary-item .text-success {
        color: green !important;
    }

    .table-order {
        height: 20rem;
    }

    .table-container {
        max-height: 336px
        ;
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-width: thin;
        scrollbar-color: #1177B8 #ddd;
    }

    .table-container::-webkit-scrollbar {
        width: 2px !important;
    }

    .table-container::-webkit-scrollbar-thumb {
        background-color: #1177B8;
        border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-track {
        background-color: #ddd;
    }

    .text-decoration-line-through {
        text-decoration: line-through !important;
        color: gray !important;
        margin-left: 5%;
    }


    .instock {
        color: green;
        font-size: 12px;
        display: inline-block;
        font-weight: 600;
        padding: 3px 7px;
        border-radius: 5px;
        background-color: #dff0d8;
    }

    .out-stock {
        color: red;
        font-size: 12px;
        display: inline-block;
        font-weight: 600;
        padding: 3px 7px;
        border-radius: 5px;
        background-color: #dff0d8;
    }
</style>
