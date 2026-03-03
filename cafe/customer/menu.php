<?php
session_start(); // Start session to persist login state

// Include the database connection file
@include 'C:\xampp\htdocs\cafe\connect.php';

// Fetch Products
$query = "SELECT * FROM product";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicious Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/menu.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="css/style.css">

    <style>
       /* Additional CSS styles */
.user-panel, .cart-panel {
    display: none;
    position: absolute;
    top: 50px;
    right: 10px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 10px;
    border-radius: 5px;
    z-index: 1000;
}

.user-icon, .cart-icon {
    position: relative;
    cursor: pointer;
    margin-left: 10px;
}

.icon-container {
    display: flex;
    align-items: center;
}

.icon-container img {
    width: 24px;
    height: 24px;
}

.btn-modern, .btn-primary, .btn-danger {
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

.btn-modern:hover, .btn-primary:hover, .btn-danger:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
}

.menu-card {
    background-color: #ffffff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    width: 100%;
}

.menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.hidden {
    display: none;
}

.stars {
    color: #FFD700;
    display: flex;
    align-items: center;
    margin-top: 5px;
}

.stars i {
    font-size: 16px;
    margin-right: 2px;
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
        <div class="icon-container">
            <div class="cart-icon" onclick="toggleCartPanel()">
                <img src="../img/cart.png" alt="Cart Icon">
                <div class="cart-panel" id="cart-panel">
                    <p>Your Cart Items</p>
                    <a href="cart.php">View Cart</a>
                </div>
            </div>
            <div class="login-icon">
                <?php if (isset($_SESSION['name'])) { ?>
                    <div class="user-icon" onclick="toggleUserPanel()">
                        <img src="../img/user.png" alt="User Icon">
                    </div>
                    <div class="user-panel" id="user-panel">
                        <p>Welcome, <?php echo $_SESSION['name']; ?></p>
                        <a href="profile.php" class="btn btn-primary">Profile</a>
                        <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                <?php } else { ?>
                    <a href="signin.php">
                        <img src="../img/user.png" alt="Login Icon">
                        Login
                    </a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>

<!-- Slideshow container -->
<div class="slideshow-container">
    <div class="mySlides fade">
        <img src="../img/bunbanner.jpg" alt="Bun Banner">
    </div>
    <div class="mySlides fade">
        <img src="../img/burgerbanner.jpg" alt="Burger Banner">
    </div>
    <div class="mySlides fade">
        <img src="../img/juicebanner.jpg" alt="Juice Banner">
    </div>
</div>

<section class="section menu" aria-label="menu-label" id="menu">
    <div class="container">
        <h1 class="headline-1 section-title text-center">Menu</h1>

        <!-- Category Filter -->
        <div class="category-filter">
            <select class="category-select" id="cuisine-select" onchange="filterMenu()">
                <option value="all">All</option>
                <option value="Sri Lankan">Sri Lankan</option>
                <option value="Indian">Indian</option>
                <option value="European">European</option>
                <option value="Japanese">Japanese</option>
            </select>

            <select class="category-select" id="food-type-select" onchange="filterMenu()">
                <option value="all">All</option>
                <option value="Food">Food</option>
                <option value="Drink">Drink</option>
            </select>
        </div>

        <!-- Menu Items -->
        <ul class="grid-list" id="menu-items">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <li class="menu-item" data-category="<?php echo $row['category']; ?>" data-type="<?php echo $row['type']; ?>">
                    <div class="menu-card hover:card">
                        <figure class="card-banner img-holder">
                            <img src="../uploaded_img/<?php echo $row['image']; ?>" loading="lazy" alt="<?php echo $row['name']; ?>" class="img-cover">
                        </figure>
                        <div class="title-wrapper">
                            <h3 class="title-3">
                                <a href="#" class="card-title"><?php echo $row['name']; ?></a>
                                <!-- Random Star Rating -->
                                <div class="stars">
                                    <?php
                                    $rating = rand(1, 5);
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($i < $rating) {
                                            echo '<i class="fas fa-star"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                            </h3>
                            <span class="span title-2">LKR <?php echo $row['price']; ?></span>
                        </div>
                        <p class="card-text label-1"><?php echo $row['description']; ?></p>
                        <!-- More Details Button -->
                        <a class="btn-modern" onclick="toggleMoreOptions(this)">More Details</a>
                        <div class="more-options hidden">
                            <!-- Quantity input -->
                            <form action="add_to_cart.php" method="post" class="add-to-cart-form">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <label for="quantity">Quantity:</label>
                                <div class="quantity-container">
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?php echo $row['quantity']; ?>">
                                    <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
                                </div>
                            </form>
                            <form action="payment.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="order_now" class="btn btn-primary">Order Now</button>
                            </form>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
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

        if (!userIcon.contains(event.target) && !userPanel.contains(event.target)) {
            userPanel.style.display = 'none';
        }
        if (!cartIcon.contains(event.target) && !cartPanel.contains(event.target)) {
            cartPanel.style.display = 'none';
        }
    });

    function filterMenu() {
        const cuisine = document.getElementById('cuisine-select').value;
        const foodType = document.getElementById('food-type-select').value;
        const items = document.querySelectorAll('.menu-item');

        items.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            const itemType = item.getAttribute('data-type');

            if ((cuisine === 'all' || itemCategory === cuisine) && (foodType === 'all' || itemType === foodType)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function toggleMoreOptions(button) {
        const moreOptions = button.nextElementSibling;
        moreOptions.classList.toggle('hidden');
    }

    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let slides = document.querySelectorAll('.mySlides');
        slides.forEach(slide => {
            slide.style.display = 'none';
        });
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = 'block';
        setTimeout(showSlides, 5000);
    }
</script>


</body>
</html>
