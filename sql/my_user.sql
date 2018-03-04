-- user tables
CREATE TABLE website_user 
(
    user_id INTEGER NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(20),
    user_password CHAR(255),
    user_mail VARCHAR(32),
    registration_time CHAR(34),
    activation BOOLEAN,

    PRIMARY KEY(user_id)
);

-- add users to verify that you can log in
-- INSERT INTO my_user VALUES (1, 'lock-up', '');

-- add column
ALTER TABLE my_user ADD (/*user_name VARCHAR(20) DEFAULT null AFTER 'user_id',*/ user_mail VARCHAR(32), registeration_time CHAR(34), activation BOOLEAN);