-- 5b. получение категорий с количеством товаров (только >= 6)
SELECT c.category_id, c.name, count(pc.product_id) as count
	FROM category as c
		JOIN product_category as pc ON c.category_id = pc.category_id
			GROUP BY c.category_id, c.name
				HAVING count >= 6
					ORDER BY count DESC