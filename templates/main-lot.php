<h2><?= $lot["title"]; ?></h2>
<div class="lot-item__content">
    <div class="lot-item__left">
        <div class="lot-item__image">
            <img src="../uploads/<?= $lot["picture"]; ?>" width="730" height="548" alt="Сноуборд">
        </div>
        <p class="lot-item__category">Категория: <span><?= $lot["name_category"]; ?></span></p>
        <p class="lot-item__description"><?= $lot["title"]; ?></p>
    </div>
    <div class="lot-item__right">
        <?php if ($is_auth): // Если пользователь авторизован ?>
        <div class="lot-item__state ">
            <?php $res = get_time_left($lot["expiration_date"]) ?>
            <div class="lot-item__timer timer <?php if ($res[0] < 1): ?>timer--finishing<?php endif; ?>">
                <?= "$res[0] : $res[1]"; ?>
            </div>
            <div class="lot-item__cost-state">
                <div class="lot-item__rate">
                    <span class="lot-item__amount">Текущая цена</span>
                    <span class="lot-item__cost"><?= format_sum($lot["price"]); ?></span>
                </div>
                <div class="lot-item__min-cost">
                    Мин. ставка <span>12 000 р</span>
                </div>
            </div>
            <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
                <p class="lot-item__form-item form__item form__item--invalid">
                    <label for="cost">Ваша ставка</label>
                    <input id="cost" type="text" name="cost" placeholder="12 000">
                    <span class="form__error">Введите наименование лота</span>
                </p>
                <button type="submit" class="button">Сделать ставку</button>
            </form>
        </div>
        <?php else: // Если пользователь не авторизован ?>
            <!-- Здесь можете добавить код, который будет отображаться, когда пользователь не авторизован -->
            <p>Для того чтобы сделать ставку, авторизуйтесь.</p>
        <?php endif; ?>
        <div class="history">
            <h3>История ставок (<span>10</span>)</h3>
            <table class="history__list">
                <tr class="history__item">
                    <td class="history__name">Иван</td>
                    <td class="history__price">10 999 р</td>
                    <td class="history__time">5 минут назад</td>
                </tr>
                <?php foreach ($betsrate as $category=>$value): ?>
                    <tr class="history__item">
                        <td class="history__name"><?= $value["user_name"]; ?></td>
                        <td class="history__price"><?= $value["price"]; ?></td>
                        <?php $ago= getTimeAgo($value["bet_date"]); ?>
                        <td class="history__time"><?=  $ago; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
