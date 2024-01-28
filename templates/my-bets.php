<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Мои ставки</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">


  <main>
    <section class="rates container">
      <h2>Мои ставки</h2>
      <table class="rates__list">
          <?php foreach ($myratef as $key => $value) : ?>
        <tr class="rates__item">
          <td class="rates__info">
            <div class="rates__img">
              <img src="/uploads/<?=htmlspecialchars($value['picture']); ?>" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title"><a href="lot.html">2014 Rossignol District Snowboard</a></h3>
          </td>
          <td class="rates__category">
              <?= $value['title'] ?>
          </td>
          <td class="rates__timer">
              <?php   $res = getTimeAgomy($value['expiration_date'])?>
            <div class="timer timer--finishing"> ч.<?= "$res[0] : $res[1]"; ?>
            </div>

          </td>
          <td class="rates__price">
              <?= $value['betprice'] ?>
          </td>
          <td class="rates__time">
              <?= $value['bet_date'] ?>
          </td>
        </tr>
          <?php endforeach; ?>
          <!-- Ваш HTML-комментарий здесь
        <tr class="rates__item">
          <td class="rates__info">
            <div class="rates__img">
              <img src="../img/rate2.jpg" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title"><a href="lot.html">DC Ply Mens 2016/2017 Snowboard</a></h3>
          </td>
          <td class="rates__category">
            Доски и лыжи
          </td>
          <td class="rates__timer">
            <div class="timer timer--finishing">07:13:34</div>
          </td>
          <td class="rates__price">
            10 999 р
          </td>
          <td class="rates__time">
            20 минут назад
          </td>
        </tr>
        <tr class="rates__item rates__item--win">
          <td class="rates__info">
            <div class="rates__img">
              <img src="../img/rate3.jpg" width="54" height="40" alt="Крепления">
            </div>
            <div>
              <h3 class="rates__title"><a href="lot.html">Крепления Union Contact Pro 2015 года размер L/XL</a></h3>
              <p>Телефон +7 900 667-84-48, Скайп: Vlas92. Звонить с 14 до 20</p>
            </div>
          </td>
          <td class="rates__category">
            Крепления
          </td>
          <td class="rates__timer">
            <div class="timer timer--win">Ставка выиграла</div>
          </td>
          <td class="rates__price">
            10 999 р
          </td>
          <td class="rates__time">
            Час назад
          </td>
        </tr>
        <tr class="rates__item">
          <td class="rates__info">
            <div class="rates__img">
              <img src="../img/rate4.jpg" width="54" height="40" alt="Ботинки">
            </div>
            <h3 class="rates__title"><a href="lot.html">Ботинки для сноуборда DC Mutiny Charocal</a></h3>
          </td>
          <td class="rates__category">
            Ботинки
          </td>
          <td class="rates__timer">
            <div class="timer">07:13:34</div>
          </td>
          <td class="rates__price">
            10 999 р
          </td>
          <td class="rates__time">
            Вчера, в 21:30
          </td>
        </tr>
        <tr class="rates__item rates__item--end">
          <td class="rates__info">
            <div class="rates__img">
              <img src="../img/rate5.jpg" width="54" height="40" alt="Куртка">
            </div>
            <h3 class="rates__title"><a href="lot.html">Куртка для сноуборда DC Mutiny Charocal</a></h3>
          </td>
          <td class="rates__category">
            Одежда
          </td>
          <td class="rates__timer">
            <div class="timer timer--end">Торги окончены</div>
          </td>
          <td class="rates__price">
            10 999 р
          </td>
          <td class="rates__time">
            Вчера, в 21:30
          </td>
        </tr>

          -->
      </table>
    </section>
  </main>

</div>

<footer class="main-footer">

</footer>

</body>
</html>
