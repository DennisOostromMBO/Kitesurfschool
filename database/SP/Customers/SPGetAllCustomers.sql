DELIMITER $$

CREATE PROCEDURE SPGetAllCustomers()
BEGIN
    SELECT 
        CONCAT(p.first_name, ' ', COALESCE(p.middle_name, ''), ' ', p.last_name) AS full_name,
        p.date_of_birth,
        pk.name AS package_name,
        CONCAT(c.street_name, ' ', c.house_number, ' ', COALESCE(c.addition, ''), ', ', c.postal_code, ', ', c.city) AS contact_details,
        c.mobile,
        c.email
    FROM customers cu
    INNER JOIN persons p ON cu.persons_id = p.id
    LEFT JOIN packages pk ON cu.package_id = pk.id
    LEFT JOIN contacts c ON cu.id = c.customer_id;
END$$

DELIMITER ;