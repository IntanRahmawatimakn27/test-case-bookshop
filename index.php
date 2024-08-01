<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan +62</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <header>
        <div class="nav container">
            <a href="#" class="logo">Perpustakaan <span>+62</span></a>
            <div class="navbar">
                <a href="#home" class="nav-link">Home</a>
                <a href="#catalog" class="nav-link">Categories</a>
                <a href="#authors" class="nav-link">Authors</a>
            </div>
            <a href="login.php" class="sign-up">Sign Up</a>
            <div class="menu-icon">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
        </div>
    </header>
    <section class="home" id="home">
        <h1 class="home-title">Welcome To Perpustakaan <span>+62</span></h1>
        <div class="home-content container swiper-container">
            <div class="swiper-wrapper" id="book-swiper-wrapper">
                <!-- Slides will be inserted here by JavaScript -->
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <section class="categories" id="catalog">
        <h2 class="section-title">Categories</h2>
        <div class="categories-content container">
            <!-- Categories will be inserted here by JavaScript -->
        </div>
    </section>
    <section class="authors" id="authors">
        <h2 class="section-title">Authors</h2>
        <div class="authors-content container">
            <!-- Authors will be inserted here by JavaScript -->
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Perpustakaan <span>+62</span>. All Rights Reserved.</p>
            <p>
                <a href="#home">Home</a> |
                <a href="#catalog">Categories</a> |
                <a href="#authors">Authors</a>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch books data from books-api.php
            fetch('http://localhost/bookshop/app/books/books-api.php')
                .then(response => response.json())
                .then(books => {
                    const swiperWrapper = document.getElementById('book-swiper-wrapper');
                    const authorsSet = new Set();
                    books.forEach(book => {
                        // Add slides for books
                        const slide = document.createElement('div');
                        slide.classList.add('swiper-slide');
                        slide.innerHTML = `
                            <div class="template-wrapper">
                                <img src="uploads/${book.image}" alt="${book.title}" class="home-img"/>
                                <p>${book.title}</p>
                            </div>
                        `;
                        swiperWrapper.appendChild(slide);

                        // Collect unique authors
                        if (book.author) {
                            authorsSet.add(book.author);
                        }
                    });

                    // Initialize Swiper after slides are added
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

                    // Insert authors into the DOM
                    const authorsContent = document.querySelector('.authors-content');
                    authorsSet.forEach(author => {
                        const authorElement = document.createElement('div');
                        authorElement.classList.add('author');
                        authorElement.innerHTML = `
                            <i class="ri-user-line author-icon"></i>
                            <h3>${author}</h3>
                        `;
                        authorsContent.appendChild(authorElement);
                    });
                })
                .catch(error => {
                    console.error('Error fetching book data:', error);
                    document.getElementById('book-swiper-wrapper').innerHTML = '<p>Error fetching data from books-api.php</p>';
                });

            // Fetch categories data from categories-api.php
            fetch('http://localhost/bookshop/app/categories/categories-api.php')
                .then(response => response.json())
                .then(categories => {
                    const categoriesContent = document.querySelector('.categories-content');
                    categories.forEach(category => {
                        const categoryElement = document.createElement('div');
                        categoryElement.classList.add('category');
                        categoryElement.innerHTML = `
                            <i class="ri-book-2-line category-icon"></i>
                            <h3>${category.name}</h3>
                        `;
                        categoriesContent.appendChild(categoryElement);
                    });
                })
                .catch(error => {
                    console.error('Error fetching category data:', error);
                    document.querySelector('.categories-content').innerHTML = '<p>Error fetching data from categories-api.php</p>';
                });
        });

        
    document.addEventListener('DOMContentLoaded', function() {
        const menuIcon = document.querySelector('.menu-icon');
        menuIcon.addEventListener('click', function() {
            menuIcon.classList.toggle('active');
        });
    });

    </script>
</body>
</html>
