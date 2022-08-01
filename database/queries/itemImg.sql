-- список изображений конкретного продукта
SELECT i.url, i.alt
	FROM image AS i
		JOIN product_image AS pi ON i.image_id = pi.image_id
			WHERE pi.product_id = 1