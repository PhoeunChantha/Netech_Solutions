<style>
    .slide {
        width: 100%;
        padding: 0 0 0 0 !important;
    }

    .main-card {
        background-color: #EBF7FF;
    }

    /* body card start */
    .card-body {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        width: 100%;
    }
    /* end body card */

    /* categorgy start */
    .all-category {
        position: relative;
        width: 30%;
        height: auto;
        box-sizing: border-box;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* end category */
    .image-container {
        width: 100%;
        height: 720px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #0072C6; /* Blue background color */
    }

    /* ime set  start */
    .img-container img {
        width: 100%;
        height: auto;
        display: inline-block;
        object-fit: contain;
    }
    /* end imge set  */


    /* overlay style start  */
    .text-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        opacity: 1;
        transition: opacity 0.3s ease;

    }
    /* end overlay style */

    /*start set font style and span style */
    .text-overlay h3 {
        position: absolute;
        margin: 0;
        top: 10px;
        left: 20px;
        font-size: 24px;
    }
    .text-overlay span {
        position: absolute;
        top: 40px;
        left: 20px;
    }
    .text-overlay span {
        position: absolute;
        top: 40px;
        left: 20px;

    }
      /* end set font style and span style */

    .img-container img,
    .img-container .text-overlay {
        transition: transform 0.5s ease;
    }

 /* start imge when ohver on imge */
    .img-container:hover img,
    .img-container:hover .text-overlay {
        transform: scale(1.1);
    }
    /* end imge when ohver on imge */


    .banner1>img {
        width: 100%;
        border-radius: 5px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    @keyframes scroll {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .main-product {
        background-color: #FFFFFF;
        margin: 0;
        padding: 0;
        overflow: hidden;
        white-space: nowrap;
    }

    .product {
        display: flex;
        flex-wrap: wrap;
        gap: 5em;
        justify-content: center;
        align-content: center;
        align-items: center;
        display: inline-block;
        animation: scroll 30s linear infinite;
    }

    .product>img {
        width: 10%;
        padding: 1em;
        margin-right: 5em;
        /* display: inline-block; */
    }

    .product:hover {
        animation-play-state: paused;
    }

    .container-card {
        background-color: #EBF7FF;
    }

    .card .title {
        font-size: 23px;
        color: #1077B8;
        font-weight: 700;
    }
    .latest-product{
        background-image:  url('/website/desktop/technology.png');
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 350px;
        background-repeat: no-repeat;
        border-radius: 10px;
        padding: 10px;
        position: relative;
    }
    .latest-product img{
        width: 70%;
        height: 350px;
    }
    .annimation {
        position: relative;
        left: 10px;
        top: 20px;
        height: 150px; /* Adjust size as needed */
        transform: translateY(-10%);
        animation: moveUpDown 2s infinite alternate ease-in-out;
    }
    @keyframes moveUpDown {
        0% {
            top: 30px;
        }

        100% {
            top: 0px;
        }
    }
    .text-over{
        position: absolute;
        top: 50%;
        left: 50%;
        text-align: center;
        color: white;
        border: none;

    }
    .text-overlay h3 {
        font-size: 24px;
        margin: 0;

    }
    .text-over a {

        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        padding: 10px 20px;
        background-color: rgb(10, 209, 10);
        color: white;
        font-size: 18px;
        border-radius: 10px;
        letter-spacing: 2px
    }



    /* .latest-product {
        background-image: url('/website/upload/p3.png');
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 350px;
        background-repeat: no-repeat;
        border-radius: 10px;
        padding: 10px;

    }
    .latest-product img{}
    .latest-product .col-7 .annimation {
        width: 80%;
        position: relative;
        left: 30px;
        top: 40px;
        margin-top: 20px;
        animation: moveUpDown 2s infinite alternate ease-in-out;
    } */

    /* @keyframes moveUpDown {
        0% {
            top: 30px;
        }

        100% {
            top: 0px;
        }
    } */





    .card-pro {
        display: flex;
        /* justify-content: space-between; */
        /* align-items: center; */
        border: none;
        float: right;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        padding: 10px;
    }

    .main-text {
        position: absolute;
        top: 20px;
        left: 2em;
        text-align: center;
        margin-right: 10px;
    }

    /* .text-pro {
        position: absolute;
        top: 20px;
        left: 20px;
        margin-right: 10px;
    } */

    .main-img {
        display: flex;
        align-items: center;
    }

    .main-img .img5 {
        width: 28%;
        border-radius: 5px;
        margin-left: auto;
        margin-right: 1em;
    }

    .card-pro .main-text a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 700;
        padding: 4px 17px;
        background-color: #008E06;
        border-radius: 15px;
        margin-top: 5px;

    }

    .main-text .text-pro {
        font-size: 20px;
        font-weight: 800;
        /* margin-right: 2em; */
        /* margin-top: 0.5em; */
        margin-bottom: 5px;
        display: inline-block;
        background: linear-gradient(90deg, #3D0D0D 50%, #000000 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .main-text span {
        color: #1077B8;
        font-weight: 700;
        font-size: 18px;

    }

    .container-card {
        /* display: flex; */
        justify-content: space-around;
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
    }

    .card-img {

        margin: 0;
        padding: 0;
        position: relative;
        overflow: hidden;
        width: 11em;
        box-sizing: border-box;
        border: none;
        height: 10em;
        border-radius: 20px;
        align-items: center;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        transition: transform 0.5s ease;

    }

    .card-img img {
        width: 100%;
        height: auto !;
        margin: 0;
        padding: 0;
    }

    .card-img:hover {
        transform: scale(1.1);
    }


    .card-img::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: background 0.3s ease;
        pointer-events: none;
    }

    .card-img:hover::before {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.15));
        /* background: linear-gradient(to top, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.20)); */
    }

    .text-price {
        position: absolute;
        bottom: 10px;
        left: 10px;
        color: white;
        padding: 5px;
        border-radius: 3px;
        opacity: 0;
    }

    .card-img:hover .text-price {
        opacity: 1;
    }

    .text-price h6 {
        margin: 0;
        font-size: 14px;
    }

    .text-price span {
        display: block;
        margin-top: 5px;
        font-size: 15px;
    }

    /* Product start */
    .card-header.head-img {
        width: 100%;
        height: 0;
        padding-bottom: 90.25%; /* 16:9 aspect ratio */
        position: relative;
        overflow: hidden;
    }

    .card-header.head-img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .desktop-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px;
    }

    .card-title,
    .card-text {
        margin: 0; /* Remove any margin from the heading and paragraph elements */
    }

    .addcard>a>i {
        color: #A1A1A1;
    }
    /* End product */

    /* .head-img {
        border: none;
        background-color: #ffffff;
    }

    .head-img img {
        background-color: #ffffff;
        width: 100%;
    }

    .desktop-body .rate {
        margin: 0;
        margin-top: 0.5em;
    }


    .addcard {
        display: flex;
        align-items: center;
        justify-content: center;
        align-content: center;
        width: 35px;
        height: 35px;
        top: -6px;
        position: relative;
        background-color: #F0F2FD;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(239, 234, 234, 0.3);
    }

    .addcard a {
        color: #F0F2FD;
        text-decoration: none;
        position: relative;
    } */



    /* .card-background {
        background-image: url('/website/upload/service.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(2px);
        height: 31em;
        width: 100%;
    } */



    /* .main-service {
        position: absolute;
        top: 6.2em;
    } */


    .carousel-button {
        position: relative;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #1077B8;
        color: #fff;
        border: none;
        outline: none;
        cursor: pointer;
        z-index: 1;

    }


    .carousel-button .carousel-control-prev-icon,
    .carousel-button .carousel-control-next-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 30px;
        background-size: 100%, 100%;
    }

    .container-button {
        align-content: center;
    }

    /* .div-title {
        font-size: 40px;
        margin-bottom: 1em;
    } */

    /* .card-service>.col-md-10 {
        height: 28.4em;
    }

    .card-service {
        background-color: rgba(255, 255, 255, 0.9);
        overflow: hidden;
    } */

    #contentContainer {
        transition: opacity 0.5s ease-in-out;
    }

    .fade-out {
        opacity: 1;
    }

    .fade-in {
        opacity: 1;
    }
    #serviceImage{
        border-radius: 20px;
    }
</style>
