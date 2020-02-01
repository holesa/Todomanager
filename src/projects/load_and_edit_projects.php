<!-- Load projects -->
<div class="fixed-projects">
    <a class="all-projects" href="<?php echo "index.php?project=all"?>">All projects</a>
    <a class="uncategorized" href="<?php echo "index.php?project=null"?>">Uncategorized</a>
</div>
<div class="projects-list">
    <?php foreach($projects as $project):
    $project_id = htmlspecialchars($project["project_id"]);  
    $project_name = htmlspecialchars($project["project_name"]);  
?> 
<div class="project">
<a href="<?php echo "index.php?project=$project_id"?>">Load tasks <i class="fas fa-arrow-circle-right"></i></a>
<form method="POST" action="" class="edit-project <?php echo "project-$project_id"?>">
    <input type="hidden" name="project_id" value="<?php echo $project_id?>">
    <input type="text" name="project_name" value="<?php echo $project_name?>">
    <div class="buttons-box"> 
    <button type="submit" class="icon-btn btn btn-outline-success" name="edit_project"><i class="far fa-edit"></i></button>
</form>

<!-- Delete project-->
<form method="POST" action="">
    <input type="hidden" name="project_id" value="<?php echo $project_id?>">
    <button type="submit" class="icon-btn btn btn-outline-danger" class="bttn-simple bttn-sm bttn-danger" name="delete_project"><i class="far fa-trash-alt"></i></button>
</form>
</div>

</div>
<?php endforeach;?>
</div>
