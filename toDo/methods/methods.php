<?php

function add_task(){
    global $connection; 
    global $errors;
    $task_name =$_POST["task_name"];
    $task_date = $_POST["due_date"];
    $task_comment = $_POST["task_comment"];
    $comment_date = $_POST["task_comment"];
    $task_priority = $_POST["task_priority"];
    $project_id = $_POST["project_id"];  
    
    if($task_name !== ""){
        $sql_add_task = "INSERT INTO tasks (task_name, due_date, finished,  task_priority, project_id) 
        VALUES ('$task_name', '$task_date', 0, '$task_priority', '$project_id')";
        if(mysqli_query($connection, $sql_add_task) && $task_comment !=="" ){
            // Get recently created task ID 
            $task_id=mysqli_insert_id($connection);
            $sql_add_comment = "INSERT INTO task_comments (task_id, comment) VALUES ('$task_id', '$task_comment')";
            if(mysqli_query($connection, $sql_add_comment)){
            header("Location: index.php");
            }
                else{
                    echo "query error: " . mysqli_error($connection);   
                } 
            }    
        else{
            echo "query error: " . mysqli_error($connection);
        }
        header("Location: index.php");    
    }
    else{
        $errors["name"] = "Task name cannot be empty";
    }
}


function edit_task(){
    global $connection; 
    $new_name =mysqli_real_escape_string($connection, $_POST["new_task_name"]); 
    $new_date = mysqli_real_escape_string($connection,$_POST["new_task_date"]); 
    $task_id = mysqli_real_escape_string($connection,$_POST["task_id"]);  
    $sql_edit_task = "UPDATE tasks SET task_name='$new_name', due_date='$new_date' WHERE id='$task_id'";
    if(mysqli_query($connection, $sql_edit_task)){
        header("Location: index.php");
    }
        else{
            echo "query error: " . mysqli_error($connection);
        }
 }

 
 function delete_task(){
    global $connection;
    $task_id=mysqli_real_escape_string($connection, $_GET["delete"]);    
    $sql_delete_task = "DELETE FROM tasks WHERE id='$task_id'";
    if(mysqli_query($connection, $sql_delete_task)){
        header("Location: index.php");
    }
        else{
            echo "query error: " . mysqli_error($connection);
        }
 }

function finish_task(){
    global $connection;
    $task_id = mysqli_real_escape_string($connection, $_GET["finished"]);
    $finished_status = $_GET["status"] == 0 ? 1 : 0;
    $sql_finished_task = "UPDATE tasks SET finished='$finished_status' WHERE id='$task_id'";
    if(mysqli_query($connection, $sql_finished_task)){
        header("Location: index.php");       
 }
        else{
            echo "query error: " . mysqli_error($connection);
        }
}

function add_project(){
    global $connection;
    $project_name = mysqli_real_escape_string($connection, $_POST["project_name"]);
    $sql_add_project = "INSERT INTO projects (project_name) VALUES ('$project_name')";
    if(mysqli_query($connection, $sql_add_project)){
        header("Location: index.php");
        mysqli_close($connection);
    }
        else{
            echo "query eroro: " . mysqli_error($connection);
        }
}

function edit_comment(){
    global $connection;
    $task_id = $_POST["task_id"];
    $new_comment = mysqli_real_escape_string($connection, $_POST["task_comment"]);
    $sql_edit_comment = "UPDATE comments SET comment='$new_comment' WHERE task_id='$task_id'";

}


?>