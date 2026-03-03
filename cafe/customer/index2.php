<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Cafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .user-panel, .cart-panel {
            display: none;
            position: absolute;
            top: 50px;
            right: 10px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000; /* Ensure the panel is on top */
        }

        .user-icon, .cart-icon {
            position: relative;
            cursor: pointer;
            margin-left: 10px;
        }

        .user-icon img, .cart-icon img {
            width: 24px; /* Set smaller width */
            height: 24px; /* Set smaller height */
        }

        .user-icon a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: black;
        }

        .user-icon a img {
            margin-right: 5px; /* Add space between the image and text */
        }
        
        .cart-panel {
            top: 80px; /* Adjust top position for the cart panel */
        }
        
        .btn-modern {
            background-color: #6c757d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-modern:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        .more-options {
            display: none;
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

            <div class="user-icon" onclick="toggleUserPanel()">
                <?php session_start(); ?>
                <?php if(isset($_SESSION['name'])) { ?>
                    <img src="../img/user.png" alt="User Icon">
                    <div class="user-panel" id="user-panel">
                        <p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
                        <a href="update_profile.php">Profile</a>
                        <a href="settings.php">Manage Settings</a>
                        <a href="signin.php">Logout</a>
                    </div>
                <?php } else { ?>
                    <a href="signin.php">
                        <img src="../img/user.png" alt="Login Icon">
                    </a>
                <?php } ?>
            </div>

            <div class="cart-icon" onclick="toggleCartPanel()">
                <img src="../img/cart.png" alt="Cart Icon">
                <div class="cart-panel" id="cart-panel">
                    <p>Your Cart Items</p>
                    <a href="cart.php">View Cart</a>
                </div>
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
        <h1>Quick <span>Service</span>Unforgettable Taste</h1>
        <p> in the heart of Colombo, The Gallery Café is more than just a dining destination; it's an
                    experience. Founded with a passion for culinary excellence and a commitment to outstanding service,
                    we strive to create a memorable experience for every guest who walks through our doors.</p>
                    <p>Whether you’re in the mood for a classic favorite or an adventurous new dish, our chefs are dedicated
                    to providing a dining experience that delights the senses.</p>






</p>
            <a href="reservation.php" class="btn">Book Table</a>
        </div>
        <div class="hero-image">
            <img src="../img/burger.jpg" alt="Delicious Burger">
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Gallery Cafe. All rights reserved.</p>
    </footer>

    <script>
        function toggleUserPanel() {
            const userPanel = document.getElementById('user-panel');
            userPanel.style.display = userPanel.style.display === 'block' ? 'none' : 'block';
        }

        function toggleCartPanel() {
            const cartPanel = document.getElementById('cart-panel');
            cartPanel.style.display = cartPanel.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(event) {
            const userPanel = document.getElementById('user-panel');
            const cartPanel = document.getElementById('cart-panel');
            const userIcon = document.querySelector('.user-icon');
            const cartIcon = document.querySelector('.cart-icon');
            if (userPanel && !userIcon.contains(event.target) && !userPanel.contains(event.target)) {
                userPanel.style.display = 'none';
            }
            if (cartPanel && !cartIcon.contains(event.target) && !cartPanel.contains(event.target)) {
                cartPanel.style.display = 'none';
            }
        });
    </script>
</body>
</html>
