<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Результаты поиска</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">

  <main>

    <div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span>Union</span>»</h2>
        <ul class="lots__list">
            <?php foreach ($announcements_list as $key => $value) : ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src=" /uploads/<?=htmlspecialchars($value['picture']); ?>" width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?= $value['category'] ?></span>

                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $value['id'] ?>"><?= $value['lot_name'] ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost">цена <?= format_sum(htmlspecialchars($value['price'])); ?></span>
                            </div>
                            <?php $time_massiv =Timelimit(date_create( htmlspecialchars($value['expiration_date']))) ?>
                            <div class="lot__timer timer <?php if ($time_massiv[0]<1): ?> timer--finishing<?php endif; ?>">
                                <?= "$time_massiv[0]: $time_massiv[1]";?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>

        </ul>
      </section>
      <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
      </ul>
    </div>
  </main>

</div>



</body>
</html>
