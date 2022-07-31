SELECT c.category_id, c.name, count(pc.product_id) as count
	FROM category as c
		LEFT JOIN product_category as pc ON c.category_id = pc.category_id
				GROUP BY c.category_id, c.name
					ORDER BY count DESC