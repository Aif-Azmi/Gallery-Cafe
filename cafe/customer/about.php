<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about us</title>
    
    <link rel="stylesheet" href="css/style.css">
   
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

        .login-icon a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .login-icon a img {
            margin-right: 5px;
            width: 20px; /* Adjust size as needed */
            height: 20px; /* Adjust size as needed */
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

            .image-section, .content-section {
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
            <li><a href="index.php">Home</a></li>
            <li><a href="menubelo.php">Menu</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="about.php">aboutus</a></li>
            </ul>
            <div class="login-icon">
                <a href="signin.php"><img src="../img/user.png" alt="User Icon"> </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="image-section">
            <img src="../img/absix.jpg" alt="About Us Image">
        </div>
        <div class="content-section">
            <h1>About Us</h1>
            <p>Gallery Cafe is a special place where the worlds of art and coffee blend seamlessly in a vibrant and inviting environment.</p>
            <p>Our gallery displays a broad spectrum of artworks from both local and international artists, offering a stage for creative expression and cultural interaction. Every piece is carefully selected to inspire and engage our visitors.</p>
            <p>Immerse yourself in our changing exhibitions and take part in live performances, workshops, and community events. At Gallery Cafe, we are committed to building connections and celebrating creativity in all its forms.</p>
            <p>Driven by passion and purpose, Gallery Cafe is your premier destination for art, coffee, and community. Come join us and be part of a space where creativity blossoms and memories are made.</p>
        </div>
    </div>

    <script>
        function toggleCartPanel() {
            var cartPanel = document.getElementById('cart-panel');
            if (cartPanel.style.display === 'none' || cartPanel.style.display === '') {
                cartPanel.style.display = 'block';
            } else {
                cartPanel.style.display = 'none';
            }
        }

        function toggleUserPanel() {
            var userPanel = document.getElementById('user-panel');
            if (userPanel.style.display === 'none' || userPanel.style.display === '') {
                userPanel.style.display = 'block';
            } else {
                userPanel.style.display = 'none';
            }
        }
    </script>
    
    <footer>
        <p>&copy; 2024 Gallery Cafe. All rights reserved.</p>
    </footer>
</body>
</html>
