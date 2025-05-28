DELIMITER $$

CREATE PROCEDURE SPGetAllInstructorPackages()
BEGIN
    SELECT 
        up.id as user_package_id,
        p.name as package_name,
        p.description,
        p.price,
        l.name as location_name,
        up.start_date,
        t.display_name as timeslot,
        CONCAT(per.first_name, ' ', COALESCE(per.middle_name, ''), ' ', per.last_name) as student_name,
        u.email as student_email
    FROM packages p
    INNER JOIN user_packages up ON p.id = up.package_id
    INNER JOIN users u ON up.user_id = u.id
    INNER JOIN persons per ON u.person_id = per.id
    INNER JOIN locations l ON up.location_id = l.id
    INNER JOIN timeslots t ON up.timeslot_id = t.id
    ORDER BY up.start_date;
END$$

DELIMITER ;
