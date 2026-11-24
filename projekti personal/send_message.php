<?php
include 'config.php';

$message = "";

if (isset($_POST['send'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['message'];

    if ($name && $email && $text) {

        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $text]);

        $message = "Message sent successfully!";

    } else {
        $message = "Please fill in all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mesazhi u dërgua | Lazdrohu N'Fermë</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background: #304c35;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .success-page {
            width: 100%;
            max-width: 850px;
            background: #f7f5ed;
            border-radius: 18px;
            padding: 75px 60px;
            text-align: center;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .success-page::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: #ffbd31;
        }

        .brand {
            color: #9b895e;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 5px;
            margin-bottom: 35px;
        }

        .success-icon {
            width: 110px;
            height: 110px;
            margin: 0 auto 30px;
            border-radius: 50%;
            background: #e5eddf;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .success-icon i {
            color: #496b45;
            font-size: 48px;
        }

        h1 {
            color: #304c35;
            font-size: 38px;
            margin-bottom: 20px;
        }

        .description {
            max-width: 550px;
            margin: 0 auto;
            color: #666;
            font-size: 17px;
            line-height: 1.8;
        }

        .divider {
            width: 75px;
            height: 3px;
            background: #ffbd31;
            margin: 30px auto;
        }

        .info-box {
            background: #eeeee5;
            border-radius: 10px;
            padding: 25px;
            margin: 30px auto;
            max-width: 550px;
        }

        .info-box i {
            color: #496b45;
            font-size: 22px;
            margin-bottom: 12px;
        }

        .info-box p {
            color: #555;
            font-size: 14px;
            line-height: 1.7;
        }

        .button-area {
            margin-top: 40px;
        }

        .button-text {
            color: #888;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .success-button {
            display: inline-block;
            padding: 18px 35px;
            background: #304c35;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .success-button:hover {
            background: #ffbd31;
            color: #222;
            transform: translateY(-3px);
        }

        .success-button i {
            margin-right: 10px;
        }

        .footer-text {
            margin-top: 45px;
            color: #aaa;
            font-size: 11px;
            letter-spacing: 2px;
        }

        @media (max-width: 600px) {

            body {
                padding: 15px;
            }

            .success-page {
                padding: 55px 22px;
            }

            h1 {
                font-size: 27px;
            }

            .description {
                font-size: 15px;
            }

            .success-button {
                padding: 16px 20px;
                font-size: 11px;
            }
        }

    </style>
</head>

<body>

    <main class="success-page">

        <div class="brand">
            LAZDROHU N'FËRMË
        </div>

        <div class="success-icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <h1>MESAZHI U DËRGUA!</h1>

        <p class="description">
            Faleminderit që gjetët kohë të na kontaktoni.
            Mesazhi juaj është pranuar me sukses dhe
            do të shqyrtohet nga ekipi ynë.
        </p>

        <div class="divider"></div>

        <div class="info-box">
            <i class="fa-regular fa-envelope"></i>

            <p>
                KONTAKTI JUAJ KA RËNDËSI PËR NE.
                <br>
                Do të kthehemi tek ju sa më shpejt!
            </p>
        </div>

        <div class="button-area">

            <p class="button-text">
                Dëshironi të vazhdoni të shfletoni faqen tonë?
            </p>

            <a href="contact.html" class="success-button">
                <i class="fa-solid fa-arrow-left"></i>
                KTHEHU TE KONTAKTI
            </a>

        </div>

        <div class="footer-text">
            © 2026 LAZDROHU N'FËRMË
        </div>

    </main>

</body>
</html>