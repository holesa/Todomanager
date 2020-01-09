<?php

// Variables for the form validation
$errors=array("name"=> "");

// Initialize Database
include("config/db_connect.php");

// Include all methods
include("methods/methods.php");


// Load all the tasks on the page
$sql_load_tasks = "SELECT * FROM tasks";
$query_tasks = mysqli_query($connection, $sql_load_tasks);
$tasks = mysqli_fetch_all($query_tasks, MYSQLI_ASSOC);
mysqli_free_result($query_tasks);


// Load all the projects on the page
$sql_load_projects = "SELECT * FROM projects";
$result_projects = mysqli_query($connection, $sql_load_projects);
$projects= mysqli_fetch_all($result_projects, MYSQLI_ASSOC);
mysqli_free_result($result_projects);

// Load all comments to the tasks
$sql_load_comments = "SELECT * FROM task_comments";
$result_comments = mysqli_query($connection, $sql_load_comments);
$comments= mysqli_fetch_all($result_comments, MYSQLI_ASSOC);
mysqli_free_result($result_comments);


// --- TODO Methods --- 

// Add Task
if(isset($_POST["new_task_button"])){
    add_task();
}

// Edit Task
if(isset($_POST["edit_task_button"])){
    edit_task();
}

// Delete Task
if(isset($_GET["delete"])){
    delete_task();
}

// Finish Task
if(isset($_GET["finished"])){
    finish_task();
}

// Add Project
if(isset($_POST["project_submit"])){
    add_project();
}

// Edit Coment
if(isset($_POST["edit_comment_button"])){
    edit_comment(); 
}
 
?>

<!--HTML section-->

<!-- Header -->
<?php include("../global/templates/header.php");?>
<!-- BODY -->

<div id="todo-app">
<div id="left-menu">
<button id="open-form-btn">Add project</button>

<form id="project-form" method="POST" action="">
<input type="text" name="project_name">
<button type="submit" name="project_submit">Submit project</button>
</form>
<button id="close-form-btn" name="project_submit">Close</button>

<div id="project-list">
<!-- Load projects -->
<?php foreach($projects as $project):?>
<div class="projects"><?php echo $project["project_name"]?></div>
<?php endforeach;?>
</div>
</div>

<div id="content">
<form name="taskForm" method="POST" action="" id="task-form">
Add Task: <input type="text" id="taskName" name="task_name">
<div class="error" id="nameError"><?php echo $errors["name"];?></div>
Due date: <input type="date" name="due_date" ><br>
Set priority : <input type="number" name="task_priority"><br>
Select project :
<select name="project_id">
<?php foreach($projects as $project):?>
    <option value="<?php echo $project['project_id']?>"><?php echo $project["project_name"]?></option>
<?php endforeach;?>
</select><br>
Add comment : <textarea name="task_comment"></textarea>
<input type="submit" name="new_task_button" value="Submit">
</form>     
<ul>

<?php
foreach($tasks as $task):
$task_id=$task["id"];
$task_finished = $task["finished"];
$project_id = $task["project_id"];


$filtered_projects = array_values(array_filter($projects, function($item) use ($project_id) {
    return ($item["project_id"] == $project_id);
  }));
  $filtered_projects_result = "";
  if(isset($filtered_projects[0]["project_name"])){
    $filtered_projects_result =  $filtered_projects[0]["project_name"];
  }

$filtered_comments = array_values(array_filter($comments, function($item) use ($task_id) {
  return ($item["task_id"] == $task_id);
}));

$filtered_comments_result = "";
  if(isset($filtered_comments[0]["comment"])){
    $filtered_comments_result =  $filtered_comments[0]["comment"];
  }  


?>

<div class="tasks">
<li>
<form method="POST" action="">
<input type="text" name="new_task_name" class="new_task_field_name" value="<?php echo htmlspecialchars(($task['task_name']));?>"/>
<input type="hidden" name="task_id" value=<?php echo $task_id;?>  />
<br>
<input type="date" name="new_task_date" class="new_task_field_date" value="<?php echo htmlspecialchars(($task['due_date']));?>"/>
<br><input type="number" name="new_task_priority" class="new_task_field_date" value="<?php echo htmlspecialchars(($task['task_priority']));?>"/>
<br><input type="project" name="new_task_project" class="new_task_field_date" value="
<?php echo $filtered_projects_result?>"/>
<br>
<input type="submit" name="edit_task_button" value="Edit"/>
</form>

<!--Comment block-->
<form method="POST" action="">
<a class="<?php echo "open-comment-box $task_id"?>">Comments</a>
<div class="<?php echo "comment-box $task_id"?>">
<div class="<?php echo "comment-text $task_id"?>">
<textarea name="comment-text"><?php echo "$filtered_comments_result"?></textarea>
</div>
<a class="<?php echo "close-comment-box $task_id"?>">Close Box</a>
<input type="hidden" name="task_id" value="<?php echo $task_id?>"/>
<input class="<?php echo "save-comment $task_id"?>" name="edit_comment_button" value="Save comment"/>
</div>
</form>




<?php 
if($task_finished == 0 ){echo "<div class='unfinished'><b>Unfinished</b></div>";}
else{echo "<div class='finished'><b>Finished</b></div>";}?><br>  
</li>

<a href="index.php?delete=<?php echo $task["id"]?>">Delete</a>
<?php if($task_finished == 0){
echo "<a href='index.php?finished=$task_id&status=0'>Finish</a>";
}
else{
echo "<a href='index.php?finished=$task_id&status=1'>Unfinish</a>";
}
?>
</div>
<?php
endforeach;
?>
<ul>
</div>
</div>

<?php include("../global/templates/footer.php");?>
