<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Реєстраційна форма</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="d-flex align-items-center justify-content-center block-size" >
        <div class="text-center text">
            <h2>Реєстраційна форма</h2>
            <form>
                <div class="form-group">
                    <label for="firstName">Ім'я:</label>
                    <input type="text" class="form-control" id="firstName" placeholder="Введіть ім'я" name="firstName">
                    <small class="error text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="lastName">Прізвище:</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Введіть прізвище" name="lastName">
                    <small class="error text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Введіть email" name="email">
                    <small class="error text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" class="form-control" id="password" placeholder="Введіть пароль" name="password">
                    <small class="error text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Повторення пароля:</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Повторіть пароль" name="confirmPassword">
                    <small class="error text-danger"></small>
                </div>
                <button type="submit" class="btn btn-secondary mt-3" id="send" name="send">Відправити</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    </body>
</html>
