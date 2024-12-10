

DROP DATABASE IF EXISTS baranggaySystem;
CREATE DATABASE baranggaySystem;
USE baranggaySystem;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    verified BOOLEAN DEFAULT FALSE,
    code VARCHAR(100) DEFAULT NULL,
    firstName VARCHAR(50) DEFAULT NULL,
    middleName VARCHAR(50) DEFAULT NULL,
    lastName VARCHAR(50) DEFAULT NULL,
    email VARCHAR(50) DEFAULT NULL UNIQUE,
    password VARCHAR(255) DEFAULT NULL,
    date DATE DEFAULT (CURRENT_DATE)
);

CREATE TABLE service (
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    userName VARCHAR(100),
    status VARCHAR(50) DEFAULT "Pending",
    name VARCHAR(50),
    type VARCHAR(50),
    information JSON,
    serviceType INT,

    alreadyFeedback BOOLEAN DEFAULT FALSE,
    feedback VARCHAR(255),
    rating VARCHAR(255),

    track VARCHAR(250) DEFAULT "The order is still pending.",
    dateAccepted DATE DEFAULT NULL,
    dateCompleted DATE DEFAULT NULL,
    createdAt DATE DEFAULT (CURRENT_DATE)
);

INSERT INTO users (verified, firstName, middleName, lastName, email, password, code) VALUES
(TRUE, 'admin', 'admin', 'admin', 'admin', 'admin', ''),
(FALSE, 'test1', 'middle1', 'Test1', 'test1@example.com', '$2y$10$qvkBAAPra6VFouM2DWMsZOZc6I3nwv7emCn4EdKutGtMGOdszUsHu', ''),
(TRUE, 'jd', 'pega', 'JDM', 'jdmaster888@gmail.com', '$2y$10$qvkBAAPra6VFouM2DWMsZOZc6I3nwv7emCn4EdKutGtMGOdszUsHu', ''),
(TRUE, 'test2', 'middle2', 'Test2', 'test2@example.com', '$2y$10$qvkBAAPra6VFouM2DWMsZOZc6I3nwv7emCn4EdKutGtMGOdszUsHu', ''),
(TRUE, 'John', 'A.', 'Doe', 'john.doe@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Jane', 'B.', 'Smith', 'jane.smith@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Michael', 'C.', 'Brown', 'michael.brown@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Emily', 'D.', 'Johnson', 'emily.johnson@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'David', 'E.', 'Williams', 'david.williams@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Olivia', 'F.', 'Jones', 'olivia.jones@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'James', 'G.', 'Garcia', 'james.garcia@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Sophia', 'H.', 'Martinez', 'sophia.martinez@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Chris', 'I.', 'Lee', 'chris.lee@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Ella', 'J.', 'Harris', 'ella.harris@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Daniel', 'K.', 'Clark', 'daniel.clark@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Grace', 'L.', 'Rodriguez', 'grace.rodriguez@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Alex', 'M.', 'Lewis', 'alex.lewis@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Lily', 'N.', 'Walker', 'lily.walker@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Ethan', 'O.', 'Hall', 'ethan.hall@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Mia', 'P.', 'Allen', 'mia.allen@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Liam', 'Q.', 'Young', 'liam.young@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Ava', 'R.', 'King', 'ava.king@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Noah', 'S.', 'Wright', 'noah.wright@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(FALSE, 'Isabella', 'T.', 'Scott', 'isabella.scott@example.com', '$2y$10$eW5HMCW6GEXqlLnQwWQxKeJcDEOTbzVPeN2.n5.Gjeyav9EYC0cyK', ''),
(TRUE, 'Jayson', 'Nazareno', 'UTOT', 'jayson@gmail.com', '$2y$10$qvkBAAPra6VFouM2DWMsZOZc6I3nwv7emCn4EdKutGtMGOdszUsHu', '');
-- USE baranggaySystem;

-- SELECT * FROM users WHERE verified = FALSE AND code = '';