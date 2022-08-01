-- данные для списка товаров в каждой категории
-- (только активные твоары, первые 12 шт)
SELECT p.product_id, p.name, c.name AS category, i.url, i.alt
	FROM product p
		JOIN product_category pc ON pc.product_id = p.product_id
		JOIN category c ON c.category_id = p.main_category
		JOIN image i ON i.image_id = p.main_image
			WHERE pc.category_id = 1 AND p.is_active = 1
				ORDER BY p.name
					LIMIT 12 OFFSET 0