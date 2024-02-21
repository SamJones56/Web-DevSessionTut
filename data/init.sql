CREATE DATABASE sessionTutorial;
 use sessionTutorial;
CREATE TABLE users (
                           userId INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                           name VARCHAR(30) NOT NULL,
                           password VARCHAR(50) NOT NULL
);