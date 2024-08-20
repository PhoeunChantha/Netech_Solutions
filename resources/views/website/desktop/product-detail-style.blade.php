<style>
    .sticky-sub-image {
        /* position: scroll; */
        /* top: 0;
        z-index: 1; */
        overflow-y: scroll;
        height: 65vh;


    }

    .sticky-sub-image::-webkit-scrollbar {
        display: none;
    }

    .sub-img {
        /* width: 100%; */
        display: flex;
        justify-content: center;
        align-items: center;

        /* border: 5px white solid; */

    }

    .sub-img>img {
        width: 100%;
        height: 8rem;
        object-fit: cover;
        border: 5px white solid;
        border-radius: 10px;
        padding: 10px;
        cursor: pointer;
    }

    .big-img {
        padding: 10px;
        border: 7px white solid;
        border-radius: 15px;

    }

    .big-img>img {
        width: 100%;
        height: 23rem;
        object-fit: contain;
    }

    .add-cart button {
        border-radius: 9px;
    }

    .card-image img {
        width: 100%;
        height: 111px;
        object-fit: cover;
    }

    .product-body h5 {
        color: #1077B8;
        font-size: 23px;
        font-weight: 500;
    }

    .card-shop {
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #F0F2FD;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        cursor: pointer;
        bottom: 16px;
        right: 17px;
    }

    .card-shop i {
        color: #A1A1A1;
    }
</style>
