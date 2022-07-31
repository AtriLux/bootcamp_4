SELECT * 
	FROM (SELECT c.category_id, c.name, count(pc.product_id) as count
			FROM category as c
				JOIN product_category as pc ON c.category_id = pc.category_id
					GROUP BY c.category_id, c.name) AS cc
		WHERE cc.count >= 2
			ORDER BY cc.count DESC