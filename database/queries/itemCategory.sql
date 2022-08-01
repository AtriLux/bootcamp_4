-- список категорий конкретного продукта
SELECT c.category_id AS id, c.name
	FROM category AS c
		JOIN product_category AS pc ON c.category_id = pc.category_id
			WHERE pc.product_id = 1