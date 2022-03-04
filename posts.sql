USE web_programming;

CREATE TABLE IF NOT EXISTS Users
(
    id       INT          NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS Post
(
    id        INT          NOT NULL AUTO_INCREMENT,
    title     VARCHAR(255) NOT NULL,
    content   TEXT         NOT NULL,
    author_id INT          NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (author_id) REFERENCES Users (id)
);


