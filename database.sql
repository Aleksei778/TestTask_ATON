-- Create Countries table
CREATE TABLE IF NOT EXISTS Countries (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    COUNTRY VARCHAR(100) NOT NULL
);

-- Create Cities table
CREATE TABLE IF NOT EXISTS Cities (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    CITY VARCHAR(100) NOT NULL,
    COUNTRY_ID INT NOT NULL,
    FOREIGN KEY (COUNTRY_ID) REFERENCES Countries(ID)
);

-- Create Users table
CREATE TABLE IF NOT EXISTS Users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    FIRST_NAME VARCHAR(100) NOT NULL,
    LAST_NAME VARCHAR(100) NOT NULL,
    CITY_ID INT NOT NULL,
    FOREIGN KEY (CITY_ID) REFERENCES Cities(ID)
);

-- Insert Countries data
INSERT INTO Countries (ID, COUNTRY) VALUES
(1, 'Germany'),
(2, 'Austria'),
(3, 'France');

-- Insert Cities data
INSERT INTO Cities (ID, CITY, COUNTRY_ID) VALUES
(1, 'Stuttgart', 1),
(2, 'Cologne', 1),
(3, 'Graz', 2),
(4, 'Angers', 3),
(5, 'Poitiers', 3),
(6, 'La Rochelle', 3),
(7, 'Toulouse', 3),
(8, 'Innsbruck', 2),
(9, 'Hamburg', 1);

-- Insert Users data
INSERT INTO Users (ID, FIRST_NAME, LAST_NAME, CITY_ID) VALUES
(1, 'Cristian', 'Clovie', 6),
(2, 'Yan', 'Sommer', 7),
(3, 'Ivar', 'Meller', 1),
(4, 'Ludwig', 'Perl', 7),
(5, 'Gans', 'Rogge', 1),
(6, 'Ulrih', 'Till', 2),
(7, 'Stepan', 'Segal', 8),
(8, 'Milosh', 'Pay', 5),
(9, 'Matie', 'Rohau', 5),
(10, 'Jan', 'Fogel', 4),
(11, 'Phillip', 'Lips', 9),
(12, 'Sebastian', 'Sommer', 7),
(13, 'Karl', 'Merc', 8),
(14, 'Gans', 'Horn', 3);