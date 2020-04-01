<!-- Load and edit task -->
    <div class="tasks-list">
                <?php 
                // Loop tasks from database
                foreach($tasks as $task):
                $task_id = htmlspecialchars($task["task_id"]);
                $task_finished = htmlspecialchars($task["finished"]);
                $task_project_id = htmlspecialchars($task["project_id"]);
                $task_note = htmlspecialchars($task["task_note"]);
                $task_priority = htmlspecialchars($task["task_priority"]);
                $task_name = htmlspecialchars(($task['task_name']));
                $task_due_date = htmlspecialchars(($task['due_date']));    

                $filtered_projects = array_values(array_filter($projects, function($item) use ($task_project_id) {
                    return ($item["project_id"] == $task_project_id);
                }));
                $filtered_projects_result = "";
                if(isset($filtered_projects[0]["project_name"])){
                    $filtered_projects_result =  $filtered_projects[0]["project_name"];
                }
                
                // Change variables based on the task status
                $border_color = "";
                $task_new_value  = "";
                $hide = "";
                if($task_finished == "1"){
                    $border_color = "finished_border_color";
                    $hide = "hide";
                    $line_through= "line-through";
                    $task_new_value = 0; 
                }
                else{
                    $border_color = "unfinished_border_color";
                    $task_new_value = 1; 
                }

                
            ?>

            <div class="task <?php echo $border_color?>"> 
                    <div class="buttons-box">
                      <!-- Change Task`s status -->
                        <form method="POST" action="">
                            <input type="hidden" name="task_id" value="<?php echo $task_id?>">
                            <input type="hidden" name="status_code" value="<?php echo $task_new_value?>">
                            <button type="submit" class="icon-btn btn btn-secondary" name="change_status"><i class="fas fa-sync"></i></button>
                        </form>

                
                      <!--Note block-->
                      <form method="POST" class="<?php echo $hide?>" action="">
                            <button type="button" class="<?php echo "open-note-box task_$task_id btn btn-secondary icon-btn"?>"><i class="far fa-comment-alt"></i></button>
                            <div class="<?php echo "note-box task_$task_id"?>">
                            <div class="<?php echo "note-text task_$task_id"?>">
                            <textarea class="form-control textarea-note" name="note_text"><?php echo $task_note?></textarea>
                            </div>
                            <input type="hidden" name="task_id" value="<?php echo $task_id?>"/>
                            <button type="submit" class="<?php echo "save-note $task_id"?> icon-btn btn btn-outline-success" name="edit_note_button"><i class="far fa-edit"></i></button>
                            </div>
                        </form>
                    </div>    
                                    
                <form method="POST" action="">
                    <input type="text" name="new_task_name" class="form-control new_task_field_name <?php echo $line_through?>" value="<?php echo $task_name;?>"/>
                    <input type="hidden" name="task_id" value=<?php echo $task_id;?>/>
                    <br>
                    <div class="inline-input <?php echo $hide?>">
                        <div class="input-block">
                            <label for="edit_task_date">Due date</label>
                            <input type="date" id="edit_task_date" name="new_task_date" class="form-control new_task_field_name" value="<?php echo $task_due_date ;?>"/>
                        </div>
                        <div class="input-block">
                            <label for="edit_task_priority">Priority</label>
                            <select id="edit_task_priority" class="form-control" name="new_task_priority">
                            <?php
                            $priorities = array("Low","Medium","High");
                            foreach($priorities as $priority):
                                if($priority ===$task_priority){
                                    echo "<option name='new_task_priority' value='$priority' selected>$task_priority</option>";
                                }
                                else{
                                    echo "<option name='new_task_priority' value='$priority'>$priority</option>";
                                }
                            endforeach;
                                ?>   
                            </select><br>
                        </div>
                        <div class="input-block">
                            <label for="edit_task_project">Project</label>
                            <select id="edit_task_project" class="form-control new_task_field_name <?php echo $hide?>" name="project_id">
                            <?php
                            // Default option is uncategorized 
                            echo "<option name='project_id' value='null' selected>Uncategorized</option>";
                            foreach($projects as $project):
                            $project_id = $project["project_id"];
                            $project_name = $project["project_name"];
                                if($project['project_name'] ===$filtered_projects_result){
                                    echo "<option name='project_id' value='$project_id' selected>$filtered_projects_result</option>";
                                }
                                else{
                                    echo "<option name='project_name' value='$project_id'>$project_name</option>";
                                }
                            endforeach;
                                ?>
                            </select><br>
                        </div>
                    </div>

                    <div class="buttons-box">
                                <input type="submit" class="edit-task-button btn btn-outline-success <?php echo $hide?>" name="edit_task_button" value="Edit"/>
                            </form>
                    <!-- Delete Task -->
                    <form method="POST" class="delete-task-form" action="">
                        <input type="hidden" name="task_id" value="<?php echo $task_id?>">
                        <input type="submit" onclick="return confirmDelete()" class="delete-task-button btn btn-outline-danger" name="delete_task" value="Delete">
                    </form>
                    </div>  
                </div>
    <?php endforeach;?> 
</div>

    

