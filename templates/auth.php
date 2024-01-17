<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>
<div class="page-wrapper">
    <form class="form container <?= !empty($errors) ? 'form--invalid' : '*' ?>" action="/reg.php" method="post" autocomplete="off"> <!-- form
    --invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item "> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= htmlspecialchars($email) ?>">
        <span class="<?= !empty($errors['email']) ? 'form__item--invalid' : 'form__error' ?>"><?= $errors['email'] ?></span>
      </div>
      <div class="form__item">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль">
        <span class="<?= !empty($errors['password']) ? 'form__item--invalid' : 'form__error' ?>"><?= $errors['password'] ?></span>
      </div>
      <div class="form__item">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= htmlspecialchars($name1) ?>">
        <span class="<?= !empty($errors['name']) ? 'form__item--invalid' : 'form__error' ?>">Введите имя</span>
      </div>
      <div class="form__item">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?= htmlspecialchars($message)  ?></textarea>
        <span class="<?= !empty($errors['message']) ? 'form__item--invalid' : 'form__error' ?>">Напишите как с вами связаться</span>
      </div>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="#">Уже есть аккаунт</a>
    </form>
  </main>

</div>

<footer class="main-footer">


</footer>

</body>
</html>
