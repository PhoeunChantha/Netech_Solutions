<style>
    .sticky-sub-image {
        overflow-y: scroll;
        height: 58vh;
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

    .description,
    .Specification {
        color: #A1A1A1;
        font-size: 16px;
    }

    .add-cart button {
        border-radius: 9px;
    }
    .list-products .card{
        border-radius: 15px;
    }
    .card-image img {
        width: 100%;
        height: 125px;
        object-fit: cover;
    }
    .card-image span{
        border-top-left-radius: 10px;
        border-bottom-right-radius: 10px;
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 12px;
        background-color: #B81A10;
        color: #F0F2FD;
        font-size: 14px;
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
