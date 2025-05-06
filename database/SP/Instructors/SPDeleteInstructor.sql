DELIMITER $$

CREATE PROCEDURE SPDeleteInstructor(IN instructorId INT)
BEGIN
    DELETE FROM instructors WHERE id = instructorId;
END$$

DELIMITER ;
