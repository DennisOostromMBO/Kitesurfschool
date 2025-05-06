DELIMITER $$

CREATE PROCEDURE SPDeleteCustomer(IN customerId INT)
BEGIN
    DELETE FROM customers WHERE id = customerId;
END$$

DELIMITER ;
