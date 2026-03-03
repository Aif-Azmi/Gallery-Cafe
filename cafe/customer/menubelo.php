<?php
session_start(); // Start the session

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
    <link rel="stylesheet" href="../css/menu.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">
            Gallery Cafe
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="menubelo.php">Menu</a></li>
            <li><a href="gallerybelo.php">Gallery</a></li>
            <li><a href="team.html">Team</a></li>
        </ul>
    </nav>
</header>
    
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
                <option value="Coffee">Coffee</option> <!-- Corrected value -->
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
                            </h3>
                            <span class="span title-2">LKR <?php echo $row['price']; ?></span>
                        </div>
                        <p class="card-text label-1"><?php echo $row['description']; ?></p>
                        <!-- Add to Cart and Order Now form -->
                        <form onsubmit="return handleAddToCart(<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>, <?php echo $row['id']; ?>)">
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                        <form onsubmit="return handleOrderNow(<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>, <?php echo $row['id']; ?>)">
                            <button type="submit" class="btn btn-primary">Order Now</button>
                        </form>
                    </div>
                </li>
            <?php } ?>
        </ul>

    </div>
</section>

<script>
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

    function handleAddToCart(isLoggedIn, productId) {
        if (!isLoggedIn) {
            alert('Please log in to add items to the cart.');
            window.location.href = 'signin.php';
            return false;
        }
        // If logged in, submit the form (this will be done automatically)
        return true;
    }

    function handleOrderNow(isLoggedIn, productId) {
        if (!isLoggedIn) {
            alert('Please log in to place an order.');
            window.location.href = 'signin.php';
            return false;
        }
        // If logged in, submit the form (this will be done automatically)
        return true;
    }
</script>

<footer>
    <p>&copy; 2024 Gallery Cafe. All rights reserved.</p>
</footer>
</body>
</html>
