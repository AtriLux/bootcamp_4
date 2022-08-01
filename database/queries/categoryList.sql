-- количество активных товаров в каждой категории
SELECT c.category_id, c.name, count(pc.product_id) as count
	FROM category as c
		JOIN product_category as pc ON c.category_id = pc.category_id
		JOIN product as p ON p.product_id = pc.product_id
			WHERE p.is_active = 1
				GROUP BY c.category_id
					ORDER BY count DESC