<?php
 // Non prepared statements
 if(!isset($_GET["project"])){
    $tasks= load_tasks(null);
    }

 function load_tasks($query){
     global $connection;
     $user_id = mysqli_real_escape_string($connection, $_SESSION["id"]);
     $sql_load_tasks = $query == null ? "SELECT * FROM tasks WHERE user_id='$user_id' ORDER BY finished, due_date, task_priority;" : $query;
     $query_tasks = mysqli_query($connection, $sql_load_tasks);
     $tasks = mysqli_fetch_all($query_tasks, MYSQLI_ASSOC);
     mysqli_free_result($query_tasks);
     return $tasks;
 }
 
 $projects = load_projects();
 
 function load_projects(){
     global $connection;
     $user_id = mysqli_real_escape_string($connection, $_SESSION["id"]);
     $sql_load_projects = "SELECT * FROM projects WHERE user_id='$user_id'";
     $result_projects = mysqli_query($connection, $sql_load_projects);
     $projects= mysqli_fetch_all($result_projects, MYSQLI_ASSOC);
     mysqli_free_result($result_projects);
     return $projects;
     }  

// Prepared statements
function load_tasks_ps($query,$project){
    global $connection;
    if (!($stmt = $connection->prepare($query))) {
        echo "Prepare failed: (" . $connection->errno . ") " . $connection->error;
    } else {
        $stmt-> bind_param("i", $project);
        $stmt-> execute();
        $stmt -> store_result();
        $stmt -> bind_result($id,$user_id,$task_name,$due_date,$finished,$project_id,$task_priority,$task_note);
        $tasks = array();
        $i=0;
        while($stmt->fetch())
        {
            $tasks[$i]["id"] = $id;
            $tasks[$i]["task_name"] = $task_name; 
            $tasks[$i]["due_date"] = $due_date;
            $tasks[$i]["finished"] = $finished;
            $tasks[$i]["project_id"] = $project_id;
            $tasks[$i]["task_priority"] = $task_priority;
            $tasks[$i]["task_note"] = $task_note;
        $i++;
        }
    }
     return $tasks;
}       

    function query_ps($query,$data_types,$variables){
        global $connection;
        if(!($stmt = $connection->prepare($query))) {
            echo "Prepare failed: (" . $connection->errno . ") " . $connection->error;
        }   
        elseif(!($stmt->bind_param($data_types,...$variables))){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        elseif(!$stmt->execute()){
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        else{
         header("Location:" .$_SERVER["REQUEST_URI"]);
        }
    } 
?>