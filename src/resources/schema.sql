DROP TABLE IF EXISTS task;

DROP TABLE IF EXISTS employee;


CREATE TABLE task
(
    task_id     INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255),
    assigned_to INT,
    compleated  BOOLEAN
);

CREATE TABLE employee
(
    employee_id INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name  VARCHAR(255) NOT NULL,
    last_name   VARCHAR(255) NOT NULL,
    email       VARCHAR(255) NOT NULL,
    position    VARCHAR(255) NOT NULL,
    picture     VARCHAR(255)
);