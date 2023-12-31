<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
            <?php foreach ($categories_list as  $category=> $value) : ?>
                <li class="promo__item promo__item--<?= htmlspecialchars($category)?>">
                    <a class="promo__link" href="pages/all-lots.html"><?= $value ?></a>
                </li>
            <?php endforeach; ?>
            </li>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php foreach ($announcements as $key => $value) : ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src=" <?=htmlspecialchars($value['picture']); ?>" width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?= $value['category'] ?></span>
                        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= htmlspecialchars($value['name']) ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost">цена <?= format_sum(htmlspecialchars($value['price'])); ?></span>
                            </div>
                            <?php $time_massiv =Timelimit(date_create( htmlspecialchars($value['expiration date']))) ?>
                            <div class="lot__timer timer <?php if ($time_massiv[0]<1): ?> timer--finishing<?php endif; ?>">
                                <?= "$time_massiv[0]: $time_massiv[1]";?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
