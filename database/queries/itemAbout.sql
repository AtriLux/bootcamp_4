-- получение данных о конкретном продукте
SELECT p.name, p.description, p.price, p.price_sale, p.price_promocode
	FROM product AS p
		WHERE p.product_id = 1