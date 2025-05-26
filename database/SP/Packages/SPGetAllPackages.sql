DELIMITER $$

CREATE PROCEDURE SPGetAllPackages()
BEGIN
    SELECT 
        id,
        name,
        description,
        price,
        max_participants,
        duration_hours,
        sessions
    FROM packages;
END$$

DELIMITER ;
