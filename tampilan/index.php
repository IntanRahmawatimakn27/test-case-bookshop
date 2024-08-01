<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <title>Perpustakaan +62</title>
</head>
<body>
    <!-- Header -->
    <header>
        <!-- navbar -->
        <div class="nav container">
            <!-- logo -->
            <a href="#" class="logo">Perpustakaan +62</a>
            <!-- nav links -->
            <div class="navbar">
                <a href="#home" class="nav-link">Home</a>
                <a href="#catalog" class="nav-link">Catalog</a>
                <a href="#services" class="nav-link">Services</a>
                <a href="#about" class="nav-link">About</a>
            </div>
            <!-- Sign Up Button -->
            <a href="login.php" class="sign-up">Sign Up</a>
            <!-- Menu Icon -->
            <div class="menu-icon">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </div>
    </header>
    <!-- Home -->
    <section class="home" id="home">
        <h1 class="home-title">Welcome to Perpustakaan +62</h1>
        <div class="home-content container swiper-container">
            <div class="swiper-wrapper">
                <?php
                $books = [
                    [
                        'title' => '1984',
                        'image' => 'images/book1.jpg'
                    ],
                    [
                        'title' => 'Don Quixote',
                        'image' => 'images/book5.jpg'
                    ],
                    [
                        'title' => 'Fahrenheit 451',
                        'image' => 'images/book6.jpg'
                    ],
                    [
                        'title' => 'The Hobbit',
                        'image' => 'images/book11.jpg'
                    ],
                    [
                        'title' => 'Alices Adventures ',
                        'image' => 'images/book2.jpg'
                    ],
                    [
                        'title' => 'Brave New World',
                        'image' => 'images/book3.jpg'
                    ],
                    [
                        'title' => 'Crime and Punishment',
                        'image' => 'images/book4.jpg'
                    ],
                    [
                        'title' => 'Great Expectations',
                        'image' => 'images/book7.jpg'
                    ],
                    [
                        'title' => 'The Great Gatsby',
                        'image' => 'images/book8.jpg'
                    ],
                    [
                        'title' => 'Jane Eyre',
                        'image' => 'images/book9.jpg'
                    ],
                    [
                        'title' => 'Laskar Pelangi',
                        'image' => 'images/book10.jpg'
                    ],
                    [
                        'title' => 'Harry Potter',
                        'image' => 'images/book12.jpg'
                    ]
                ];
                ?>
                <?php foreach ($books as $book) : ?>
                    <div class="swiper-slide">
                        <div class="template-wrapper">
                            <img src="<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>" class="home-img" />
                            <p><?php echo $book['title']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Perpustakaan +62. All Rights Reserved.</p>
            <p>
                <a href="#home">Home</a> |
                <a href="#catalog">Catalog</a> |
                <a href="#services">Services</a> |
                <a href="#about">About</a>
            </p>
        </div>
    </footer>

    <!-- Include Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            }
        });
    </script>
</body>
</html>
