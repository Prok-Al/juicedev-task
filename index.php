<?php
//пароли и другие конфиденциальные значения
$db_user = "YOUR_DB_USERNAME";
$db_password = "YOUR_DB_PASSWORD";

//подключение к БД
define("LINK", mysqli_connect("localhost", $db_user, $db_password));
if (LINK == false){
    echo "Error: can't connect with database";
    exit;
}
mysqli_select_db(LINK,"juicedev");

//проверка куки
if (isset($_COOKIE["id"]) AND isset($_COOKIE["hash"])){
    //сверяем хэши и при необходимости переадресовываем на авторизацию
    $user = mysqli_fetch_object(mysqli_query(LINK, "SELECT * FROM `users` WHERE id = '{$_COOKIE["id"]}'"));
    if (($user -> hash ?? false) !== $_COOKIE["hash"]){
        header("Location: login/");
        exit;
    }
}
else {
    header("Location: login/");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/png">
    <title>Главная - JuiceDev</title>
</head>
<body style="background: rgba(67,255,205,0.59)">
    <style>
        @font-face {
            font-family: "VK Sans";
            src: url("/juicedev/VK Sans Medium.ttf") format("truetype");
        }
        .main {
            font-family: "VK Sans", serif;
            margin: 110px auto;
            padding: 50px;
            text-align: center;
            border-radius: 25px;
            background: #FFFFFF;
            width: 95%;
            max-width: 600px;
        }
        @media (max-width: 767px) {
            .main {
                max-width: 95%;
            }
        }
        .title {
            font-size: 30px;
            text-align: center;
            padding-top: 20px;
            margin-bottom: 20px;
        }
        .btn {
            margin: auto;
            padding: 5px;
            max-width: 30%;
            cursor: pointer;
            border-radius: 25px;
            font-size: 18px;
            font-family: "VK Sans", sans-serif;
            width: 100%!important;
            text-decoration: none;
            background: #0d6efd;
            border-width: 0;
            color: #FFFFFF;
        }
        a {
            text-decoration: none !important;
            border: none !important;
        }
    </style>
    <div class="main">
        <div class="title">
            Приветствуем на главной странице, <b><?php echo $user -> login; ?></b>!
        </div>
        <a href="logout.php" style="margin-bottom: 20px">
            <button class="btn" href="logout.php">
                <div style="display: flex; align-items: center; padding: 5px;">
                    <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#FFFFFF" fill-rule="evenodd" clip-rule="evenodd" d="M10.3572 3L13 3C13.5523 3 14 3.44772 14 4C14 4.55229 13.5523 5 13 5H10.4C9.26339 5 8.47108 5.00078 7.85424 5.05118C7.24907 5.10062 6.90138 5.19279 6.63803 5.32698C6.07354 5.6146 5.6146 6.07354 5.32698 6.63803C5.19279 6.90138 5.10062 7.24907 5.05118 7.85424C5.00078 8.47108 5 9.26339 5 10.4V17.6C5 18.7366 5.00078 19.5289 5.05118 20.1458C5.10062 20.7509 5.19279 21.0986 5.32698 21.362C5.6146 21.9265 6.07354 22.3854 6.63803 22.673C6.90138 22.8072 7.24907 22.8994 7.85424 22.9488C8.47108 22.9992 9.26339 23 10.4 23H13C13.5523 23 14 23.4477 14 24C14 24.5523 13.5523 25 13 25H10.3572C9.27339 25 8.39925 25 7.69138 24.9422C6.96253 24.8826 6.32234 24.7568 5.73005 24.455C4.78924 23.9757 4.02433 23.2108 3.54497 22.27C3.24318 21.6777 3.11737 21.0375 3.05782 20.3086C2.99998 19.6007 2.99999 18.7266 3 17.6428V10.3572C2.99999 9.27341 2.99998 8.39926 3.05782 7.69138C3.11737 6.96253 3.24318 6.32234 3.54497 5.73005C4.02433 4.78924 4.78924 4.02433 5.73005 3.54497C6.32234 3.24318 6.96253 3.11737 7.69138 3.05782C8.39926 2.99998 9.27341 2.99999 10.3572 3ZM19.2929 9.29289C19.6834 8.90237 20.3166 8.90237 20.7071 9.29289L24.7071 13.2929C24.8946 13.4804 25 13.7348 25 14C25 14.2652 24.8946 14.5196 24.7071 14.7071L20.7071 18.7071C20.3166 19.0976 19.6834 19.0976 19.2929 18.7071C18.9024 18.3166 18.9024 17.6834 19.2929 17.2929L21.5858 15H12C11.4477 15 11 14.5523 11 14C11 13.4477 11.4477 13 12 13H21.5858L19.2929 10.7071C18.9024 10.3166 18.9024 9.68342 19.2929 9.29289Z"/>
                    </svg>
                    <div style="margin: auto">
                        Выйти
                    </div>
                </div>
            </button>
        </a>
    </div>
</body>