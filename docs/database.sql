CREATE TABLE projects(
	project_id INT,
    project_name VARCHAR(100),
    task_id INT,
    PRIMARY KEY(project_id)
)


ALTER TABLE tasks
ADD project_id INT
FOREIGN KEY(project_id) REFERENCES projects(project_id)
ON DELETE SET NULL;  


ALTER TABLE tasks
ADD priority INT;


CREATE TABLE task_comments(
 comment_id INT,
 task_id INT,
 comment TEXT(1000)
);