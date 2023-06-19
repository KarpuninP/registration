// Перевірка чи работає
//alert('hi');

$(document).ready(function(){
    // Подія натиснення кнопки відправки форми
    $("button[type='submit']").click(function(event){
        event.preventDefault(); // Запобігаємо відправку форми за замовчуванням

        // Отримуємо значення з полів форми
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();

        // Очищуємо повідомлення про помилки
        $(".error").text("");

        // Перевіряємо валідність полів
        if(firstName == "") {
            // Якщо ім'я порожнє, виводимо повідомлення про помилку
            $("#firstName").next(".error").text("Будь ласка, введіть ім'я.");
            return false;
        }

        if(lastName == "") {
            // Якщо прізвище порожнє, виводимо повідомлення про помилку
            $("#lastName").next(".error").text("Будь ласка, введіть прізвище.");
            return false;
        }

        // Регулярний вираз для перевірки валідності електронної адреси
        var re = /\S+@\S+\.\S+/;
        if(email == "" || !re.test(email)) {
            // Якщо email порожній або не відповідає регулярному виразу, виводимо повідомлення про помилку
            $("#email").next(".error").text("Будь ласка, введіть вірну адресу електронної пошти.");
            return false;
        }

        if (password == "") {
            // Якщо пароль порожній, виводимо повідомлення про помилку
            $("#password").next(".error").text("Будь ласка, введіть пароль.");
            return false;
        } else if (password.length <= 8) {
            // Якщо пароль містить менше або рівно 8 символів, виводимо повідомлення про помилку
            $("#password").next(".error").text("Пароль должен содержать более 8 символов.");
            return false;
        }

        if(confirmPassword == "" || password != confirmPassword) {
            // Якщо підтвердження паролю порожнє або не співпадає з паролем, виводимо повідомлення про помилку
            $("#confirmPassword").next(".error").text("Паролі не співпадають.");
            return false;
        }

        // Відправляємо AJAX запит до серверу
        $.ajax({
            url: 'formHandler.php', // URL, куди відправляється запит
            type: 'post', // Метод відправки запиту
            data: {firstName: firstName, lastName: lastName, email: email, password: password, confirmPassword: confirmPassword}, // Дані, що відправляються
            success: function(response) {
                // Якщо запит успішний
                if(response == "success") {
                    console.log(response)
                    // Приховуємо форму і виводимо повідомлення про успішну реєстрацію
                    $(".text").hide();
                    $(".block-size").append("<div class='alert alert-success mt-3'>Ви успішно зареєстровані! </div>");
                } else {
                    // Якщо користувач з такою електронною адресою вже існує, виводимо повідомлення про помилку
                    $("#email").next(".error").text("Користувач з такою електронною поштою вже існує");
                }
            },
            error: function (response) {
                // Якщо сталася помилка при відправці запиту, виводимо повідомлення про помилку
                $(".block-size").append("<div class='alert alert-danger mt-3'>Сталася помилка, будь ласка, спробуйте через декілька годин.</div>");
            },
        });
    });
});