<style>
    .category-tabs {
        display: flex;
        justify-content: space-around;
        /* Adjust card alignment */
        background-color: #f4f4f4;
        padding: 5px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        gap: 5px;
        /* Add space between cards */
    }

    .category-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 88px;
        padding: 5px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        background-color: white;
        margin: 0 5px;
    }

    .category-card img {
        width: 30px;
        height: 30px;
        margin-bottom: 3px;
    }

    .category-card p {
        font-size: 12px;
        margin: 0;
        color: #333;
    }

    .category-card:hover {
        border: 1px solid #007bff;
    }

    .category-card.selected {
        border: 1px solid #007bff;
        box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3);
    }

    /* style card desktop */

    /* .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 20px;
    padding: 20px;
    } */
    .product-discount {
        position: absolute;
        color: red;
        font-size: 12px;
        padding: 6px 8px;
        /* text-decoration: line-through; */
        margin-bottom: 5px;
        border-top-left-radius: 10px;
        border-bottom-right-radius: 10px;
        margin-left: 0 !important;
    }

    .product-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .product-card .product-title {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin: 5px 0;
    }

    .product-card .product-price {
        font-size: 14px;
        color: green;
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .div-price {
        display: flex;
        justify-content: center;
        /* align-items: center; */
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .product-card {
        height: 270px !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card img {
        width: 150px;
        height: 120px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    /* img{
        width: 100px;
        height: 100px;
    } */

    .product-card .product-title {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin: 5px 0;
    }

    .product-card .product-price {
        font-size: 14px;
        color: green;
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .pay {
        margin-top: 1rem;
        /* background: red; */
    }

    .line {
        border-top: 1px solid #ccc;
    }

    .product-grid {
        /* display: flex; */
        /* flex-direction: column; */
        margin-top: 6px;
        overflow-y: auto;
        overflow-x: hidden;
        gap: 1rem;
        height: 440px;
        padding: 1rem 5px;
        scroll-behavior: smooth;
        scrollbar-width: thin;
        scrollbar-color: #888 #ddd;
    }

    .product-grid::-webkit-scrollbar {
        width: 8px;
    }

    .product-grid::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .product-grid::-webkit-scrollbar-track {
        background: #ddd;
    }


    .category-tabs {
        /* display: flex; */
        overflow-x: auto;
        overflow-y: hidden;
        /* gap: 1rem; */
        padding: 0.5rem;
        scroll-behavior: smooth;
        scrollbar-width: thin;
        scrollbar-color: #1177B8 #ddd;
    }

    .category-tabs::-webkit-scrollbar {
        height: 8px;
    }

    .category-tabs::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .category-tabs::-webkit-scrollbar-track {
        background: #ddd;
    }

    .quantity-control {
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid #025492;
        border-radius: 10px;
        width: 91px;
    }

    .quantity-control button {
        border: none;
        background-color: #f8f9fa;
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
    }

    .quantity-control button:hover {
        background-color: #e0e0e0;
    }

    .action-buttons i {
        cursor: pointer;
    }

    .action-buttons i:hover {
        color: red;
    }

    .button-limit {
        display: flex;
        justify-content: center;
        align-items: center;
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
        height: 25rem;
    }

    .table-container {
        max-height: 400px;
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

    .discount-amount {
        margin-left: -115px !important;
        margin-top: -10px;
        border-top-left-radius: 9px;
        border-bottom-right-radius: 9px;
        padding: 4px 7px;
        font-size: 12px;
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
