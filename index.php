<?php
// Check Session
require_once("src/auth/check_session.php");
// Initialize Database
require_once("config/db_connect.php");
// Query_functions
require_once("src/functions/query_functions.php");
// Routes
require_once("src/functions/routes.php");
?>

<!-- Header -->
<?php require_once("views/templates/header.php");?>
<div id="todo-app">

    <!-- Projects -->
    <div id="left-menu">
        <?php require_once("src/projects/add_projects.php");?>
        <?php require_once("src/projects/load_and_edit_projects.php");?>
    </div>

    <!-- Tasks -->
    <div id="content">
        <?php require_once("src/tasks/add_tasks.php");?>
        <?php require_once("src/tasks/load_and_edit_tasks.php");?>
    </div>
    
</div>
<!-- Footer -->
<?php require_once("views/templates/footer.php");?>
