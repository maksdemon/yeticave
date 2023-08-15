


INSERT INTO users SET  user_email = 'vasya@mail.ru',  user_password = 'secret';
INSERT INTO users SET  user_email = 'vlad@mail.ru',  user_password = 'secretvlad';


INSERT INTO
    goods(title, price)
VALUES
    ("Вилка", 25),
    ("Столовая ложка", 35),
    ("Чайная ложка", 30)

INSERT INTO
    users (user_email, user_name,user_password)
VALUES
    ('vlad@mail.ru', 'vlad','secretvlad'),
    ('vlad5@ma.ru', 'vlad7','secretvhhlad');
INSERT INTO
    categories (symbol_code, title)
VALUES

    ('boards', 'Доски и лыжи'),
    ('attachment', 'Крепления'),
    ('boots', 'Ботинки'),
    ('clothing', 'Одежда'),
    ('tools' ,'Инструменты'),
    ('other', 'Разное');

INSERT INTO
    goods(name, category,price,picture,expiration_date,user_id)
VALUES
    ('2014 Rossignol District Snowboard', 'boards', 10999, 'img/lot-1.jpg', '2023-08-14',2),
    ('DC Ply Mens 2016/2017 Snowboard', 'boards',  159999, 'img/lot-2.jpg', '2023-08-17',3),
    ('Крепления Union Contact Pro 2015 года размер L/XL', 'attachment', 8000, 'img/lot-3.jpg','2023-08-12',4),
('Ботинки для сноуборда DC Mutiny Charocal', 'boots',   10999, 'img/lot-4.jpg','2023-05-15',5),
    ('Куртка для сноуборда DC Mutiny Charocal','clothing',7500,'img/lot-5.jpg','2023-09-15',5),
('Маска Oakley Canopy','other',5400,'img/lot-6.jpg','2023-10-15',3);
