DELIMITER $$

CREATE PROCEDURE SPGetAllInstructors()
BEGIN
    SELECT 
        i.id,
        CONCAT(p.first_name, ' ', COALESCE(p.middle_name, ''), ' ', p.last_name) AS full_name,
        c.email,
        c.mobile
    FROM instructors i
    INNER JOIN persons p ON i.person_id = p.id
    LEFT JOIN contacts c ON i.contact_id = c.id;
END$$

DELIMITER ;
