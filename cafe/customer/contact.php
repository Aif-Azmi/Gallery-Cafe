<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about us</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="contact.css">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    header {
        background-color: #fff;
        color: #333;
        padding: 10px 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    header nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    .nav-links li a {
        color: #333;
        text-decoration: none;
        font-weight: bold;
    }

    .login-button {
        display: inline-block;
        width: 25px;
        /* Adjust the size as needed */
        height: 25px;
        /* Adjust the size as needed */
        background-image: url('../img/user.png');
        background-size: cover;
        background-position: center;
        border-radius: 50%;
        text-indent: -9999px;
        /* Hide text */
        vertical-align: middle;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        max-width: 1200px;
        margin: auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .image-section {
        flex: 1;
        padding: 20px;
    }

    .image-section img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .content-section {
        flex: 2;
        padding: 20px;
    }

    .content-section h1 {
        font-size: 36px;
        margin-bottom: 20px;
    }

    .content-section p {
        line-height: 1.6;
        margin-bottom: 20px;
        color: #555;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .image-section,
        .content-section {
            flex: 1 1 100%;
        }
    }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                Gallery Cafe
            </div>
            <ul class="nav-links">
                <li><a href="index2.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reservation.php">Reservation</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="about2.php">About us</a></li>
                <li><a href="contact.php">Contact us</a></li>
            </ul>
            <a href="signin.php" class="login-button"></a>
        </nav>
    </header>
    <div class="container">
        <div class="contact-box">
            <div class="left">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63371.8151251542!2d79.8562055!3d6.92183865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1719221612869!5m2!1sen!2slk"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="right">
                <h2>Contact Us</h2>
                <input type="text" class="field" placeholder="Enter Your Name">
                <input type="text" class="field" placeholder="Enter Your Email">
                <input type="text" class="field" placeholder="Enter Your Phone">
                <textarea placeholder="Message" class="field"></textarea>
                <button class="btn">Send</button>
            </div>
        </div>
    </div>
</body>

</html>