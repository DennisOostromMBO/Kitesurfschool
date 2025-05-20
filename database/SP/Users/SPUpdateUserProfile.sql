DROP PROCEDURE IF EXISTS SPUpdateUserProfile;

CREATE PROCEDURE SPUpdateUserProfile(
    IN userId INT,
    IN firstName VARCHAR(255),
    IN middleName VARCHAR(255),
    IN lastName VARCHAR(255),
    IN dateOfBirth DATE,
    IN streetName VARCHAR(255),
    IN houseNumber VARCHAR(10),
    IN addition VARCHAR(10),
    IN postalCode VARCHAR(10),
    IN city VARCHAR(255),
    IN mobile VARCHAR(15),
    IN emailAddress VARCHAR(255)
)
BEGIN
    DECLARE personId INT;
    
    SELECT person_id INTO personId FROM users WHERE id = userId;
    
    UPDATE persons 
    SET first_name = firstName,
        middle_name = middleName,
        last_name = lastName,
        date_of_birth = dateOfBirth
    WHERE id = personId;
    
    UPDATE contacts 
    SET street_name = streetName,
        house_number = houseNumber,
        addition = addition,
        postal_code = postalCode,
        city = city,
        mobile = mobile,
        email = emailAddress
    WHERE person_id = personId;
    
    UPDATE users 
    SET email = emailAddress
    WHERE id = userId;
END
