CREATE TABLE Users (
    id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Tasks (
    id int PRIMARY KEY AUTO_INCREMENT NOT NUll,
    user_id int NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    statut ENUM ('To do', 'In progress...', 'Done') NOT NULL,
    date_creation date NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);