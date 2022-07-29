insert into category(name, description) 
	values  ('Бытовая техника', 'Все для быта!'),
			('Цифровая техника', 'Все для цифры!'), 
			('Б/у техника', 'Всегда дешевле рыночной стоимости!'),
            ('Хлам', 'Бесплатно отдадим в хорошие руки.');
insert into image(url, alt)
	values  ('img/product/1.png', 'Фото стиральной машины'), 
			('img/product/1_2.png', 'Фото стиральной машины сбоку'),
            ('img/product/1_3.png', 'Фото стиральной машины в интерьере'),
			('img/product/2.png', 'Фото газовой плиты'),
            ('img/product/3.png', 'Фото электроплиты'),
            ('img/product/4.png', 'Фото духового шкафа'),
            ('img/product/5.png', 'Фото холодильника'),
            ('img/product/6.png', 'Фото кофемашины'),
            ('img/product/6_2.png', 'Фото кофемашины сзади');
insert into product(name, price, price_sale, price_promocode, main_category, main_image, description, is_active) 
	values  ('Стиральная машина X1', 8599, 7599, 6599, (select category_id from category where name = 'Б/у техника'), (select image_id from image where url = 'img/product/1.png'), 'Отстирает и пятна, и принт на футболке.', true),
			('Стиральная машина X2', 10599, 8599, 7599, (select category_id from category where name = 'Бытовая техника'), (select image_id from image where url = 'img/product/1.png'), 'Аннигилирует вещи в 2 раза быстрее.', true),
            ('Газовая плита OLD', 1599, NULL, NULL, (select category_id from category where name = 'Б/у техника'), (select image_id from image where url = 'img/product/2.png'), 'Осторожно! Чрезмерное употребление газа вредно для здоровья!', true),
            ('Электроплита YOUNG', 15099, 13099, 12099, (select category_id from category where name = 'Бытовая техника'), (select image_id from image where url = 'img/product/3.png'), 'Новое поколение - новый способы обжечься', true),
            ('Духовой шкаф ЖАРА', 8799, 8499, 8099, (select category_id from category where name = 'Бытовая техника'), (select image_id from image where url = 'img/product/4.png'), 'Жарит не по-детски', true),
            ('Духовой шкаф DuShNy', 4599, 4559, NULL, (select category_id from category where name = 'Бытовая техника'), (select image_id from image where url = 'img/product/4.png'), 'Тот еще душнила', false),
            ('Холодильник Yes, Frost', 15999, 13999, 10999, (select category_id from category where name = 'Бытовая техника'), (select image_id from image where url = 'img/product/5.png'), 'Как с No Frost, только хуже', true),
            ('Кофемашина Nirvana', 2499, 2399, 2299, (select category_id from category where name = 'Бытовая техника'), (select image_id from image where url = 'img/product/6.png'), 'Кофеин как новый наркотик', true),
            ('Кофемашина R2D2', 3499, 2899, 2599, (select category_id from category where name = 'Бытовая техника'), (select image_id from image where url = 'img/product/6_2.png'), 'Пип-пиу-пам-пум', true);
-- нет товаров в категории хлам
-- часть товаров относится и к бытовой технике, и к б/у технике
insert into product_category
	values  ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Стиральная машина X1')),
			((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Стиральная машина X2')),
            ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Газовая плита OLD')),
            ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Электроплита YOUNG')),
            ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Духовой шкаф ЖАРА')),
            ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Духовой шкаф DuShNy')),
            ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Холодильник Yes, Frost')),
            ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Кофемашина Nirvana')),
            ((select category_id from category where name = 'Бытовая техника'), (select product_id from product where name = 'Кофемашина R2D2')),
            ((select category_id from category where name = 'Б/у техника'), (select product_id from product where name = 'Стиральная машина X1')),
            ((select category_id from category where name = 'Б/у техника'), (select product_id from product where name = 'Газовая плита OLD')), 
            ((select category_id from category where name = 'Б/у техника'), (select product_id from product where name = 'Духовой шкаф DuShNy')), 
            ((select category_id from category where name = 'Б/у техника'), (select product_id from product where name = 'Холодильник Yes, Frost'));
-- некоторые изображения использованы повторно (стиральные машины, духовые шкафы, кофемашины)
-- некоторые изображение являются главными у одного товара и дополнительными у другого (кофемашины)
insert into product_image
	values  ((select image_id from image where url = 'img/product/1.png'), (select product_id from product where name = 'Стиральная машина X1')),
			((select image_id from image where url = 'img/product/1.png'), (select product_id from product where name = 'Стиральная машина X2')),
            ((select image_id from image where url = 'img/product/2.png'), (select product_id from product where name = 'Газовая плита OLD')),
            ((select image_id from image where url = 'img/product/3.png'), (select product_id from product where name = 'Электроплита YOUNG')),
            ((select image_id from image where url = 'img/product/4.png'), (select product_id from product where name = 'Духовой шкаф ЖАРА')),
            ((select image_id from image where url = 'img/product/4.png'), (select product_id from product where name = 'Духовой шкаф DuShNy')),
            ((select image_id from image where url = 'img/product/5.png'), (select product_id from product where name = 'Холодильник Yes, Frost')),
            ((select image_id from image where url = 'img/product/6.png'), (select product_id from product where name = 'Кофемашина Nirvana')),
            ((select image_id from image where url = 'img/product/6_2.png'), (select product_id from product where name = 'Кофемашина R2D2')),
            ((select image_id from image where url = 'img/product/1_2.png'), (select product_id from product where name = 'Стиральная машина X1')),
			((select image_id from image where url = 'img/product/1_3.png'), (select product_id from product where name = 'Стиральная машина X1')), 
            ((select image_id from image where url = 'img/product/6_2.png'), (select product_id from product where name = 'Кофемашина Nirvana')),
            ((select image_id from image where url = 'img/product/6.png'), (select product_id from product where name = 'Кофемашина R2D2'));