<!-- Add task -->
<div class="add-task-box">
    <button class="add-task-open add-task btn btn-primary fas fa-plus"> Add task</button>
    <i class="add-task-close add-task fas fa-times"></i>   
</div>

<div class="add-task">   
    <form name="taskForm" method="POST" action="" id="task-form">
        <label for="taskName">Task name</label> 
        <input type="text" required class="form-control add_task_field" id="taskName" name="task_name">
        <label for="due_date">Due date</label> 
        <input type="date" class="form-control add_task_field" id="due_date" name="task_date" ><br>
        <label for="task_priority">Set priority</label> 
        <select class="form-control add_task_field" name="task_priority">
            <option>Low</option>
            <option selected>Medium</option>
            <option>High</option>
        </select>    
        <label for="set_project">Select project</label> 
            <select class="form-control add_task_field" id="set_project" name="project_id">
            <option value="null">Uncategorized</option>
            <?php foreach($projects as $project):?>
                <option value="<?php echo $project['project_id']?>"><?php echo htmlspecialchars($project["project_name"])?></option>
            <?php endforeach;?>
        </select><br>
        <label for="task_note">Add note</label> 
        <textarea class="form-control add_task_field margin-bottom" id="task_note" name="task_note"></textarea>
        <input type="submit" class="btn btn-success" name="new_task_button" value="Submit">
        <input type="button" class="add-task-close add-task" value="Close">
    </form>
</div>        

