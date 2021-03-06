-- SWENG500 - Team 3
-- William DiStefano, Dawn Viscuso, Kevin Scheib, David Singer
--
-- File: UsersController.php
-- Description: This controller provides request handling for users data
-- Created: 2013-02-08
-- Modified: 2013-02-08 15:08
-- Modified By: William DiStefano

CREATE TABLE types (
    id INTEGER(8) NOT NULL AUTO_INCREMENT
    ,type_name VARCHAR(25) NOT NULL
    ,created DATETIME DEFAULT NULL
    ,modified DATETIME DEFAULT NULL
    ,PRIMARY KEY(id)
);

CREATE TABLE users (
    id INTEGER(8) NOT NULL AUTO_INCREMENT
    ,username VARCHAR(15) NOT NULL
    ,password VARCHAR(40) NOT NULL
    ,enabled TINYINT(1) DEFAULT '1'
    ,type_id INTEGER(8) DEFAULT NULL
    ,last_name VARCHAR(50) NOT NULL
    ,middle_name VARCHAR(50) DEFAULT NULL
    ,first_name VARCHAR(50) NOT NULL
    ,created DATETIME DEFAULT NULL
    ,modified DATETIME DEFAULT NULL
    ,FOREIGN KEY (type_id) REFERENCES types(id)
    ,PRIMARY KEY(id)
);

CREATE TABLE permissions (
    id INTEGER(8) NOT NULL AUTO_INCREMENT
    ,permission_name VARCHAR(100) NOT NULL
    ,created DATETIME DEFAULT NULL
    ,modified DATETIME DEFAULT NULL
    ,PRIMARY KEY(id)
);

CREATE TABLE types_permissions (
    id INTEGER(8) NOT NULL AUTO_INCREMENT
    ,type_id INTEGER(8) NOT NULL
    ,permission_id INTEGER(8) NOT NULL
    ,FOREIGN KEY (type_id) REFERENCES types(id)
    ,FOREIGN KEY (permission_id) REFERENCES permissions(id)
    ,PRIMARY KEY(id)
);

CREATE TABLE types_users (
    id INTEGER(8) NOT NULL AUTO_INCREMENT
    ,type_id INTEGER(8) NOT NULL
    ,user_id INTEGER(8) NOT NULL
    ,FOREIGN KEY (type_id) REFERENCES types(id)
    ,FOREIGN KEY (user_id) REFERENCES users(id)
    ,PRIMARY KEY(id)
);

CREATE TABLE lessons (
    id  INTEGER(8) NOT NULL AUTO_INCREMENT,
    course_id INTEGER(8) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    main_content TEXT NOT NULL,
    lesson_order INTEGER(2) NOT NULL,
    PRIMARY KEY(id)
); 

CREATE TABLE lesson_contents (
    id  INTEGER(8) NOT NULL AUTO_INCREMENT,
    lesson_id INTEGER(8) NOT NULL,
    filename VARCHAR(100) NOT NULL,
    filesize INTEGER(8) NOT NULL,
    content LONGBLOB NOT NULL,
    filetype VARCHAR(100) NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    PRIMARY KEY(id)
); 

CREATE TABLE courses (
    id INTEGER(8) NOT NULL AUTO_INCREMENT,
    course_number VARCHAR(6) NOT NULL,
    course_name VARCHAR(50) NOT NULL,
    prerequisite VARCHAR(6),
    lesson_completion INTEGER (8) NOT NULL,
    quiz_passing_score INTEGER (8) NOT NULL,
    instructor VARCHAR(50) NOT NULL,
    course_status VARCHAR(1) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO types (type_name, created, modified) VALUES ('Administrator', NOW(), NOW());
INSERT INTO types (type_name, created, modified) VALUES ('Instructor', NOW(), NOW());
INSERT INTO types (type_name, created, modified) VALUES ('Student', NOW(), NOW());
INSERT INTO permissions (permission_name, created, modified) VALUES ('*', NOW(), NOW());

INSERT INTO users (username, password, enabled, type_id, last_name, middle_name, first_name, created, modified)
    VALUES ('tester', PASSWORD('tester'), 1, 1, 'Tester', 'Tester', 'Tester', NOW(), NOW());
INSERT INTO types_users (type_id, user_id) VALUES (1, 1);
INSERT INTO types_permissions (type_id, permission_id) VALUES (1, 1);

INSERT INTO courses (course_number, course_name, prerequisite, lesson_completion, quiz_passing_score, instructor, course_status) VALUES ("SWE100", "Writing Software Requirements Specifications", "", 100, 80, "Singer", "U");

-- ------------------------------------------------
-- TO-DO: Add all permissions and types_permissions
-- ------------------------------------------------
