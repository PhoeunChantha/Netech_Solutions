<style>
    .slide {
        width: 100%;
        padding: 0 0 0 0 !important;
    }

    .main-card {
        background-color: #EBF7FF;
    }

    .body-cate {
        display: flex;
        justify-content: center;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        margin-left: 3em;
    }

    .all-category {
        text-align: center;
        position: relative;
    }

    .img-container {
        align-content: center;
        align-items: center;
        position: relative;
        width: 100%;
        display: inline-block;
    }

    .img-container img {
        width: 80%;
        display: block;
        border-radius: 5px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);

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
        width: 100%;
        border-radius: 5px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }


    /* @keyframes scroll {
        0% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(-100%);
        }
    } */

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
        width: 7%;
        padding: 1em;
        margin-right: 5em;
        /* flex-shrink: 0; */
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

    .latest-product {
        background-image: url('/website/upload/p3.png');
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 350px;
        background-repeat: no-repeat;
        border-radius: 10px;
        padding: 10px;

    }

    @keyframes moveUpDown {
        0% {
            top: 30px;
        }

        100% {
            top: 0px;
        }
    }

    .latest-product .col-7 .annimation {
        width: 80%;
        position: relative;
        left: 30px;
        top: 40px;
        margin-top: 20px;
        animation: moveUpDown 2s infinite alternate ease-in-out;
    }

    .main-price {
        text-align: center;
        /* display: flex; */
        justify-content: center;
        align-items: center;
        /* align-content: center; */
    }

    .col-5 .best-price {
        width: 100%;
        /* float: right; */
    }

    .latest-product .col-5 span {
        /* float: right; */
        font-size: 20px;
        font-weight: 700;
        margin-right: 2em;
        margin-top: 0.5em;
        display: inline-block;
        color: #FFFFFF;
    }

    .latest-product .col-5 .price {
        /* float: right; */
        font-size: 22px;
        font-weight: 800;
        margin-right: 2em;
        margin-top: 0.5em;
        display: inline-block;
        color: #FFFFFF;
    }

    .latest-product .col-5 a {
        color: #FFFFFF;
        font-size: 15px;
        text-decoration: none;
        border-radius: 15px;
        padding: 4px 11px;
        background-color: #008E06;
        float: right;
        top: 3em;
        margin-right: 5em;
    }



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
        transition: transform 0.3s ease-in-out;

    }

    .card-img img {
        width: 100%;
        height: auto !;
        margin: 0;
        padding: 0;


    }

    .card-img:hover {
        transform: scale(1.04);
    }


    .card-img::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: background 0.5s ease;
        pointer-events: none;
    }

    .card-img:hover::before {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(255, 255, 255, 0.20));
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

    .shadow-hover {
        text-decoration: none;
        transition: transform 0.5s ease;
        transition: text-shadow 0.3s ease-in-out;
    }

    .shadow-hover:hover {
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transform: scale(1.05);
    }

    .head-img {
        border: none;
        background-color: #ffffff;
    }

    .head-img img {
        background-color: #ffffff;
        width: 100%;
    }

    .home-desktop {
        transition: transform 0.3s ease-in-out;
    }

    .home-desktop:hover {
        transform: scale(1.04) translateX(2%);
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
    }

    .addcard>a>i {
        color: #A1A1A1;
    }

    /* .card-background {
        background-image: url('/website/upload/service.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(2px);
        height: 31em;
        width: 100%;
    } */

    .card-background {
        background-image: url('/website/upload/service.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(2px);
        height: 33em;
        width: 100%;
        transition: background-image 0.3s ease-in-out;
    }

    .main-service {
        position: absolute;
        top: 6.2em;


    }


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

    .carousel-button {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.5s ease;

    }

    .carousel-button:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
        /* Adjust color as needed */
    }

    .container-button {
        align-content: center;
    }

    .div-title {
        font-size: 40px;
        margin-bottom: 1em;
    }

    .card-service>.col-md-10 {
        height: 28.4em;
    }

    .card-service {
        background-color: rgba(255, 255, 255, 0.9);
        overflow: hidden;
    }

    #contentContainer {
        transition: opacity 0.5s ease-in-out;
    }

    .fade-out {
        opacity: 1;
    }

    .fade-in {
        opacity: 1;
    }

    /* Add these styles to your CSS file or within a <style> tag in your HTML */
    /* @keyframes scrollUp {
        0% {
            transform: translateY(30px);
            opacity: 0;
        }

        100% {
            transform: translateY(-20px);
            opacity: 1;
        }
    }

    @keyframes scrollDown {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .scroll-up {
        animation: scrollUp 0.5s forwards;
    }

    .scroll-down {
        animation: scrollDown 0.5s forwards;
    } */
    /* Add these styles to your CSS file or within a <style> tag in your HTML */
    @keyframes slideUp {
        0% {
            transform: translateY(90%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideDown {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .slide-up {
        animation: slideUp 0.5s forwards;
    }

    .slide-down {
        animation: slideDown 0.5s forwards;
    }

    #image-sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 1000;
        overflow: auto !important;
    }


    #serviceImage {
        width: 100%;
        border-radius: 20px;
    }

    .video-container {
        margin: 0 0 0 0;
        padding: 0 0 0 0;
    }

    .head-video {
        display: flex;
        justify-content: center;
        align-content: center;
        align-items: center
    }

    .btn-video {
        justify-content: center;
        align-content: center;
        align-items: center;
        position: absolute;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid #FFFFFF;
        background-color: transparent;
        transition: transform 0.5s ease;
    }

    .btn-video:hover {
        transform: scale(1.1);
    }

    .show-video {
        padding: 0.5em !important;
    }
</style>
