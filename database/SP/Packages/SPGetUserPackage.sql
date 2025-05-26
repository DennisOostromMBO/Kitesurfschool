DELIMITER $$

CREATE PROCEDURE SPGetUserPackage(IN p_user_id INT)
BEGIN
    SELECT 
        p.name,
        p.description,
        p.price
    FROM packages p
    INNER JOIN user_packages up ON p.id = up.package_id
    WHERE up.user_id = p_user_id
    ORDER BY up.created_at DESC
    LIMIT 1;
END$$

DELIMITER ;
