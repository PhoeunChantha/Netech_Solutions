<style>
    .profile-card {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
        width: 90%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .profile-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-left: 20px;
    }

    .profile-item {
        display: flex;
        align-items: center;
        margin-bottom: 26px;
        font-size: 16px;
        font-weight: 600;
        color: #777 ;
    }
    .unactive {
        color: #777 ;
    }

    .profile-item:hover {
        color: #1077B8;
    }

    .profile-item i {
        font-size: 24px;
        margin-right: 10px;
    }

    .profile-item  span {
        font-size: 16px;

    }

    /* .profile-item.active {
        color: #1077B8;
    } */

    .profile-menu a.active {
        color: #1077B8 ;
        font-weight: bold;
    }

    /* profile details */
    .profile-card-detail {
        background-color: #fff;
        border-radius: 10px;
        padding: 40px;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-title {
        margin-bottom: 20px;
        text-align: left;
    }

    .profile-pic-container {
        text-align: center;
        margin-bottom: 30px;
        position: relative;
    }

    .profile-pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .upload-icon {
        width: 35px;
        height: 33px;
        position: absolute;
        /* bottom: 0; */
        top: 71px;
        right: 44%;
        background-color: #007bff;
        color: white;
        border-radius: 48%;
        padding: 7px;
        font-size: 14px;
        cursor: pointer;
    }

    h3 {
        margin-top: 10px;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .profile-form>.form-row>.form-group {
        width: 48%;
    }

    .profile-form>.form-row>.form-group label {
        /* display: block;
        margin-bottom: 5px;
        font-weight: bold; */
        font-weight: 600;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 16px;
    }

    .phone-input {
        display: flex;
        align-items: center;
    }

    .flag {
        width: 30px;
        margin-right: 8px;
    }

    .password-input {
        position: relative;
    }

    .password-input i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
    }

    .submit-btn {
        background-color: #9C1C33;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        /* width: 100%; */
        /* margin-top: 20px; */
    }

    .submit-btn:hover {
        background-color: #990000;
    }

    .form-control:focus {
        outline: 0;
        box-shadow: 0 0 0 .5px #1077B8;
    }

    /* order history */
    .order-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
    }

    h3 {
        margin-bottom: 20px;
    }

    .order-card {
        background-color: #F5F5F5;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        /* justify-content: space-between; */
    }

    .order-logo {
        width: 60px;
        height: 60px;
        margin-right: 15px;
    }

    .order-details p {
        margin: 0;
        font-size: 14px;
        color: #333;
    }

    .order-price {
        text-align: right;
    }

    .order-price .price {
        font-size: 18px;
        color: #007bff;
        margin-bottom: 5px;
    }

    .badge {
        padding: 8px 12px;
        font-size: 12px;
        border-radius: 20px;
    }

    .badge-primary {
        background-color: #007bff;
    }

    .badge-warning {
        background-color: #ffcc00;
    }

    .badge-success {
        background-color: #28a745;
    }
</style>
