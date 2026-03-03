<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Gallery</title>
</head>

<body>
<header>
        <nav>
            <div class="logo">
                Gallery Cafe
            </div>
            <ul>
            <li><a href="index2.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="reservation.php">Reservation</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="about2.php">About us</a></li>
            <li><a href="contact.php">Contact us</a></li>
            </ul>
        </nav>
    </header>

    <!-- Gallery Content -->
    <div class="container my-5">
        <h1 class="text-center"></h1>
        <div class="row">
            <?php
            $images = [
                'g1.jpg', 'g2.jpg', 'g3.jpg', 'g4.jpg', 'g5.jpg', 
                'g6.jpg', 'g7.jpg', 'g8.jpg', 'g9.jpg', 'g10.jpg'
            ];
            foreach ($images as $image) {
                echo '
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="card">
                        <img src="../img/' . $image . '" class="card-img-top" alt="' . $image . '">
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
