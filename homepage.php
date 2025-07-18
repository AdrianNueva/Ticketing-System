<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo-deped.png" type="image/png">
    <title> ICTSRF - DIVISION OF GENERAL TRIAS CITY</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/matatag.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            text-align: center;
            width: 80%;
            max-width: 600px;
            margin: auto;
        }
        header {
            margin-bottom: 60px;
        }
        footer p{
            margin-top: 90px;
            font-size: 15px;
            font-weight: bold;
        }
        .logo {
            width: 180px;
            margin-top: 10px;
            height: auto;
        }
        h1 {
            font-size: 30px;
            color: #000;
        }
        .buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
            font-size: 50px;
        }
        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 500px;
            height: 60px;
            margin: 20px auto;
            padding: 15px 0;
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .blue {
            background-color: #104481;
        }
        .green {
            background-color: #206F3C;
        }
        footer {
            margin-top: 20px;
            color: #333;
        }
        .footer-logos {
            margin-top: -50px;
        }
        .footer-logo {
            width: 200px;
            height: auto;
            margin: 0 10px;
        }
        @media (max-width: 768px) {
            .button {
                width: 100%;
                font-size: 16px;
            }
            .logo {
                width: 200px;
                height: auto;
            }
            h1 {
                font-size: 22px;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <img src="images/logo-deped.png" alt="Division of General Trias City Logo" class="logo">
            <h1>DIVISION OF GENERAL TRIAS CITY</h1>
        </header>
        <div class="buttons">
            
            <a href="login.php" class="button blue">
                <i class="fas fa-users" aria-hidden="true" style="color: #ffffff; font-size: 32px; margin-right: 10px;"></i>
               ADMIN
            </a>

            <a href="index.php" class="button green">
                <i class="fas fa-clipboard-list" aria-hidden="true" style="color: #ffffff; font-size: 32px; margin-right: 10px;"></i>
                ICT SERVICE REQUEST FORM
            </a>
        </div>
        <footer>
            <p>Let's Join Forces: Sa GenTri, Edukasyon ay Sulit mula sa Serbisyong may Malasakit<br>#GalingGenTriGalingGenTri</p>
            <div class="footer-logos">
                <img src="images/logos.png" alt="DepEd Logo" class="footer-logo">
            </div>
        </footer>
    </div>
</body>

</html>
