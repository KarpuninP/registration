<?php
// Перевірка чи все є
//var_dump($_POST);

// Перевіряємо, чи була натиснута кнопка "send"
if (isset($_POST)) {
    // Очищуємо отримані дані від зайвих символів
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $confirmPassword = test_input($_POST["confirmPassword"]);
    $errors = [];

    // Проводимо валідацію: перевіряємо, чи всі поля заповнені
    if (!$firstName || !$lastName || !$email || !$password || !$confirmPassword) {
        $errors["empty"] = 'Не всі поля заповнені - ' . date("Y-m-d H:i:s");
    }

    // Проводимо валідацію: перевіряємо, чи корректний формат електронної пошти
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["$email"] = 'Формат Email не вірний - ' . date("Y-m-d H:i:s");
    }

    // Проводимо валідацію: перевіряємо, чи співпадають паролі
    if($password !== $confirmPassword) {
        $errors["$confirmPassword"] = 'Паролі не співпадають - ' . date("Y-m-d H:i:s");
    }

    // Хешуємо пароль
    $passwordHash = password_hash($confirmPassword, PASSWORD_DEFAULT);

    if(!$errors) {
        // Читаємо файл, де зберігається база, у форматі тексту
        $data = file_get_contents('db.txt');
        // Перетворюємо текст у масив PHP
        $db = json_decode($data, 1);
        // Якщо файл був порожній, він поверне null, тому встановлюємо $db як порожній масив
        if ($db == null) {
            $db = [];
        }

        // Шукаємо користувача з такою електронною поштою в базі даних
        foreach ($db as $user) {
            if ($user["email"] === $email) {
                echo "Користувач з такою електронною поштою вже існує";
                // Записуємо у лог-файл інформацію про реєстрацію нового користувача
                file_put_contents('errors.log', 'Користувач ' . $firstName . ' з електронною адресою ' . $email . ' вже існує ' . date("Y-m-d H:i:s") . "\n", FILE_APPEND);
                exit();
            }
        }

        // Якщо користувача з такою електронною поштою не існує, додаємо нового користувача з наступним ID
        if (empty($db) || !isset(end($db)['id'])) {
            $id = 1;
        } else {
            $id = end($db)['id'] + 1;
        }

        // Додаємо новий елемент в кінець масиву
        $db[] = [
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'passwordHash' => $passwordHash
        ];

        // Перетворюємо масив у текст
        $str = json_encode($db);
        // Записуємо текст у файл
        file_put_contents('db.txt', $str);

        // Записуємо у лог-файл інформацію про реєстрацію нового користувача
        file_put_contents('errors.log', 'Користувач ' . $firstName . ' з електронною адресою ' . $email . ' зареєструвався ' . date("Y-m-d H:i:s") . "\n", FILE_APPEND);

        // Відсилаємо повідомлення про успішну реєстрацію
        echo "success";
        exit();
    } else {
        // Якщо є помилки, записуємо їх у лог-файл
        foreach($errors as $error) {
            file_put_contents('errors.log', $error . "\n", FILE_APPEND);
        }
        exit();
    }
}

// Функція для очищення вхідних даних
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


