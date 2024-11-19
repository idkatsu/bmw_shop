<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная - Магазин BMW</title>
    <style>
  html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    text-align: center;
}

header {
    background-color: #333;
    color: white;
    padding: 10px 0;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

nav {
    display: flex;
    justify-content: center;
    background-color: #444;
}

nav a {
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    text-align: center;
    transition: background-color 0.3s;
}

nav a:hover {
    background-color: #555;
}

footer {
    background-color: #333;
    color: white;
    padding: 10px 0;
    margin-top: auto; 
    position: relative; 
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
}

main {
    flex-grow: 1; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; 
    padding: 20px;
}

h2 {
    margin-top: 10px;
}

.slideshow-container {
    position: relative;
    max-width: 400px;
    margin-bottom: 20px; 
}

.slides {
    display: none; 
    width: 100%; 
    height: 250px; 
    object-fit: cover; 
}

.auth-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.auth-form input {
    margin-bottom: 10px;
    padding: 8px; 
    width: 180px;
}

.register-button, .login-button {
    margin-top: 10px; 
    padding: 8px 15px;
    background-color: #4CAF50;
    color: white; 
    border: none; 
    border-radius: 5px; 
    cursor: pointer; 
}

.register-button:hover, .login-button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>

<header>
    <h1>Магазин BMW</h1>
    <nav>
        <a href="index.php">Главная</a>
        <a href="shop2.php">Магазин</a>
    </nav>
</header>

<main>
    <div class="slideshow-container">
        <img class="slides" src="https://avatars.mds.yandex.net/get-entity_search/371130/844586136/S600xU_2x" alt="BMW Image 1">
        <img class="slides" src="https://avatars.mds.yandex.net/get-entity_search/2403345/953191994/S600xU_2x" alt="BMW Image 2">
    </div>

    <h2>Добро пожаловать в наш магазин!</h2>
    <p>Мы предлагаем широкий ассортимент продукции BMW.</p>
    
    <p>Форма авторизации:</p>
    <form class="auth-form" action="login.php" method="POST">
        <input type="text" name="username" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit" class="login-button">Войти</button> 
    </form>
    
    <a href="register.php">
        <button class="register-button">Зарегистрироваться</button> 
    </a>
</main>

<footer>
    <p>&copy; 2024 Влад Кузнецов</p>
</footer>

<script>
    let slideIndex = 0;
    showSlides(); 

    function showSlides() {
        let slides = document.getElementsByClassName("slides");
        
    
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }

        slideIndex++; 
        if (slideIndex > slides.length) {slideIndex = 1}

        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 3000);
    }
</script>

</body>
</html>
