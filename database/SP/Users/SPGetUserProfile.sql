DELIMITER $$

CREATE PROCEDURE SPGetUserProfile(IN userId INT)
BEGIN
    SELECT 
        p.first_name,
        p.middle_name,
        p.last_name,
        p.date_of_birth,
        c.street_name,
        c.house_number,
        c.addition,
        c.postal_code,
        c.city,
        c.mobile,
        c.email
    FROM users u
    INNER JOIN persons p ON u.person_id = p.id
    LEFT JOIN contacts c ON p.id = c.person_id
    WHERE u.id = userId;
END$$

DELIMITER ;
