<?php
include('db.php'); // Подключение к базе данных

// Запрос для получения продуктов со скидкой
$query = "SELECT * FROM products WHERE discount_percent > 0"; 
$stmt = $pdo->query($query);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/promotions.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Акції</title>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header__container">
            <div class="contact-info">
                <a href="tel:0502991861" class="phone-number">+38(050)299-18-61 (Безкоштовна лінія)</a>
                <a href="tel:0998948016" class="phone-number">+38(099)894-80-16</a>
                <a href="tel:0660172534" class="phone-number">+38(066)017-25-34</a>
                <div class="auth">
                    <a href="../html/signIn.html" class="auth-link">Вхід/Регестрація</a>
                </div>
            </div>
            <nav class="navbar">
                <div class="navbar__logo">
                    <a href="../index.html">
                        <img src="https://basketmania.com.ua/image/cache/catalog/BascketMania_logo_slogan_horizontal_937x300-937x300.png"
                            alt="BasketMania Logo" class="navbar__logo-img" />
                    </a>
                </div>
                <div class="navbar__search-bar">
                    <input type="search" placeholder="Search..." class="navbar__search-input" />
                    <div class="navbar__search-buttons">
                        <button class="navbar__search-btn">
                            <img src="../images/search.png" alt="Search" />
                        </button>
                        <button class="navbar__wishlist-btn">
                            <img src="../images/heart.png" alt="Wishlist" />
                        </button>
                        <button class="navbar__cart-btn">
                            <img src="../images/shopping-cart.png" alt="Cart" />
                        </button>
                    </div>
                </div>
            </nav>
            <div class="catalog">
                <a href="/" class="catalog-link" style="background-color: #f15a24">Каталог товарів</a>
                <a href="#" class="catalog-link">Акції</a>
                <a href="../html/about-us.html" class="catalog-link">Про нас</a>
                <a href="../html/delivery.html" class="catalog-link">Доставка та оплата</a>
                <a href="../html/returns.html" class="catalog-link">Повернення та обмін</a>
                <a href="../html/trust-us.html" class="catalog-link">Нам довіряють</a>
                <a href="../html/contacts.html" class="catalog-link">Контакти</a>
            </div>
        </div>
    </header>
    
    <main class="promotions py-5">
        <div class="container">
            <h1 class="mb-4">Акції</h1>
            <hr class="mb-5">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="product-card">
                            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['title']; ?>" class="img-fluid">
                            <h3><?php echo $product['title']; ?></h3>
                            <p><?php echo $product['description']; ?></p>
                            <p>Цена: $<?php echo number_format($product['price'], 2); ?></p>
                            <p>Скидка: <?php echo $product['discount_percent']; ?>%</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>
