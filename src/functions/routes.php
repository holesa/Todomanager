<?php
// Variables
$user_id = mysqli_real_escape_string($connection, $_SESSION["id"]);
if(isset($_POST["task_name"])){
    $task_name = mysqli_real_escape_string($connection, $_POST["task_name"]);
}    
if(isset($_POST["task_note"])){
    $task_note = mysqli_real_escape_string($connection, $_POST["task_note"]);
}
if(isset($_POST["task_date"])){
    $task_date = mysqli_real_escape_string($connection, $_POST["task_date"]);
}
if(isset($_POST["task_priority"])){
    $task_priority = mysqli_real_escape_string($connection, $_POST["task_priority"]);
}  
if(isset($_POST["new_task_name"])){
    $new_name = mysqli_real_escape_string($connection, $_POST["new_task_name"]);
}
if(isset($_POST["new_task_priority"])){
    $new_priority = mysqli_real_escape_string($connection, $_POST["new_task_priority"]); 
} 
if(isset($_POST["new_task_date"])){
    $new_date = mysqli_real_escape_string($connection, $_POST["new_task_date"]);
}
if(isset($_POST["project_id"])){
    $project_id = mysqli_real_escape_string($connection, $_POST["project_id"]);
}
if(isset($_GET["project"])){
    $project = mysqli_real_escape_string($connection, $_GET["project"]);
}
if(isset($_POST["task_id"])){
    $task_id = mysqli_real_escape_string($connection, $_POST["task_id"]);
}
if(isset($_POST["status_code"])){
    $task_status = mysqli_real_escape_string($connection, $_POST["status_code"]);
}
if(isset($_POST["project_name"])){
    $project_name = mysqli_real_escape_string($connection, $_POST["project_name"]);  
}        
if(isset($_POST["note_text"])){
    $new_note = mysqli_real_escape_string($connection, $_POST["note_text"]);
}


// Load project`s tasks
if(isset($_GET["project"])){
        switch($project){
            case "all":
                $query = "SELECT * FROM tasks WHERE user_id='$user_id' ORDER BY finished, due_date, task_priority;";
                 $tasks = load_tasks($query);
            break;
            case "null":
                $query = "SELECT * FROM tasks WHERE project_id IS NULL AND user_id='$user_id' ORDER BY finished, due_date, task_priority;";  
                $tasks = load_tasks($query);
            break;
            default:
                $query = "SELECT * FROM tasks WHERE project_id=? AND user_id='$user_id' ORDER BY finished, due_date, task_priority;";    
                $tasks = load_tasks_ps($query,$project);
            }
} 

// Edit the task`s note
if(isset($_POST["edit_note_button"])){
        $query = "UPDATE tasks SET task_note=? WHERE task_id=? AND user_id='$user_id'";
        $variables = array($new_note,$task_id);
        $data_types = "si";
        query_ps($query,$data_types,$variables);
    }

// Add Task
if(isset($_POST["new_task_button"])){           
        if($project_id === "null"){
            $query = "INSERT INTO tasks (user_id, task_name, due_date, finished, task_priority, project_id, task_note) 
            VALUES ('$user_id',?, ?, 0, ?, DEFAULT, ?)";
            $variables = array($task_name,$task_date,$task_priority,$task_note);
            $data_types = "ssss";
            query_ps($query,$data_types,$variables); 
         }
         else{
             $query = "INSERT INTO tasks (user_id, task_name, due_date, finished, task_priority, project_id, task_note) 
             VALUES ('$user_id',?, ?, 0, ?, ?,?)";
             $variables = array($task_name,$task_date,$task_priority,$project_id,$task_note);
             $data_types = "sssis";
             query_ps($query,$data_types,$variables);
         }
}

// Edit Task
if(isset($_POST["edit_task_button"])){
        if($project_id === "null"){
           $query = "UPDATE tasks SET task_name=?, due_date=?, task_priority=?,project_id=DEFAULT  
           WHERE task_id=? AND user_id='$user_id'";
           $variables = array($new_name,$new_date,$new_priority,$task_id);
           $data_types = "sssi";
           query_ps($query,$data_types,$variables); 
        }
        else{
            $query = "UPDATE tasks SET task_name=?, due_date=?, task_priority=?, project_id=? 
            WHERE task_id=? AND user_id='$user_id'";
            $variables = array($new_name,$new_date,$new_priority,$project_id,$task_id);
            $data_types = "sssii";
            query_ps($query,$data_types,$variables);
        }
}

// Delete Task
if(isset($_POST["delete_task"])){  
        $query = "DELETE FROM tasks WHERE task_id=? AND user_id='$user_id'";
        $variables = array($task_id);
        $data_types = "i";
        query_ps($query,$data_types,$variables);

}

// Change status of the task
if(isset($_POST["change_status"])){
        $query = "UPDATE tasks SET finished=? WHERE task_id=? AND user_id='$user_id'";
        $variables = array($task_status,$task_id);
        $data_types = "ii";
        query_ps($query,$data_types,$variables);
}

// Add Project
if(isset($_POST["project_submit"])){
        $query = "INSERT INTO projects (user_id, project_name) VALUES (?,?)";
        $variables = array($user_id,$project_name);
        $data_types = "is";
        query_ps($query,$data_types,$variables);
}

// Delete project
if(isset($_POST["delete_project"])){
        $query = "DELETE FROM projects WHERE project_id=? AND user_id='$user_id'";
        $variables = array($project_id);
        $data_types = "i";
        query_ps($query,$data_types,$variables);
}
// Edit project
if(isset($_POST["edit_project"])){
        $query = "UPDATE projects SET project_name=? WHERE project_id=? AND user_id='$user_id'";
        $variables = array($project_name,$project_id);
        $data_types = "si";
        query_ps($query,$data_types,$variables);
}

// Logout
if(isset($_POST['logout'])) {
	unset($_SESSION['access_token']);
	session_destroy();
	header('Location: views/login/login.php');
	exit();
	}
?>