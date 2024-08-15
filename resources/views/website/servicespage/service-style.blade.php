<style>
    .slide {
        width: 100%;
        padding: 0 0 0 0 !important;
    }

    .main-card {
        background-color: #EBF7FF;
    }

    .text-overlay {
        position: absolute;
        top: 6%;
        left: 4%;
        /* transform: translate(-50%, -50%); */
        color: white;
        text-align: center;
        border-radius: 5px;
        font-size: 15px;
    }

    .text-overlay h5,
    .text-overlay span {
        margin: 0;
    }



    .img-container {
        position: relative;
        /* overflow: hidden; */
    }

    .img-container img,
    .img-container .text-overlay {
        transition: transform 0.5s ease;
    }

    .img-container img {
        /* width: 100%; */
        height: auto;
    }



    .img-container:hover img,
    .img-container:hover .text-overlay {
        transform: scale(1.1);
    }

    .banner1>img {
        overflow: hidden;
        width: 100%;
        border-radius: 5px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .banner1 {
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        width: 78em;
        height: auto;
        margin: 0 auto;
    }

    .card-service,
    .service-thumbnail {
        border: 0;
    }

    /* .service-thumbnail {
        width: 36em !important;
        height: auto;
    } */

    .service-thumbnail> img {
        width: 100%;
        border-radius: 10px;
        height: 25rem;
        object-fit: contain;
    }
</style>
