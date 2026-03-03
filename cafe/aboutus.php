<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Gallery Cafe</title>

    <!-- Linking Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style1.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body class="dark-theme">
    <header>
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand me-auto" href="#">
                    <img src="icon.png" alt="Logo" width="160" height="110">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2 active" href="#">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2 active" href="#">Accommodation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2 active" href="aboutus.php">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-2 active" href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="signin.php" class="login-button">
                    <i id="user-icon" class="fas fa-user"></i> <!-- Font Awesome user icon -->
                </a>
            </div>
        </nav>
    </header>

    <!-- About Us Content -->
    <div class="container my-5 pt-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1>About Us</h1>
                <p>Welcome to Gallery Cafe! We are a unique cafe where art meets coffee. Our cafe is a space where you can enjoy delicious food and drinks while being surrounded by beautiful artworks created by local artists. Whether you're here for a quick coffee break or a leisurely meal, we strive to provide a welcoming and inspiring environment.</p>
                
               
            </div>
        </div>
    </div>

    <!-- Footer -->
  

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
