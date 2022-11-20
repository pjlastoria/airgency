<?php 

include('../dir-header.php');

if(isset($_GET['status-update'])) {

    $id = $_GET['status-update'];
    $task_sql_data = get_task($id);
    $task_data = mysqli_fetch_assoc($task_sql_data[0]);
    $mysql_conn = $task_sql_data[1];

    $description = $task_data['task_description'];
    $status =      $task_data['task_status'];

    $subtask_data = get_subtasks($mysql_conn, $id);


    //echo '<pre>';
    //var_dump($_GET['status-update']);
    //echo '</pre>';

} else {
    header('Location: ./');
}


?>

<div id="top-nav">
    <h2 id="main-header">Edit Task <?= $id ?></h2>
    <a href="./index.php"><button class="top-add-btn">Go Back</button></a>
</div>

<div id="main-area">

    <div class="main-comp main-form">
        <!--<h3 class="project-section-header">Create </h3>-->

        <div class="add-form non-modal">
            <form action="../includes/tasks.inc.php" method="post">
                <input type="hidden" name="edit" id="task-id" value="<?= $id ?>">

                <label for="task_desc">Description</label>
                <textarea id="task_desc" name="task_desc" rows="4" cols="33" required><?= $description ?></textarea>

                <div class="input-flex">
                    <div class="select-flex">
                        <label for="task_tag">Tag (Optional)</label> <!-- not required; could be for a tag or not  -->
                        <select name="task_tag">
                            <option value="">Select Tag</option>
                            <option value="Bob's Gaming">Ecommerce</option>
                            <option value="7th Heaven Bar">Database</option>
                        </select>
                    </div>
                    <div class="select-flex">
                        <label for="project_name">Project (Optional)</label> <!-- not required; could be for a project or not  -->
                        <select name="project_name">
                            <option value="">Select Project</option>
                            <option value="Bob's Gaming">Bob's Gaming</option>
                            <option value="7th Heaven Bar">7th Heaven Bar</option>
                            <option value="Kash 4 Gold">Kash 4 Gold</option>
                        </select>
                    </div>
                </div>

                <div class="input-flex">
                    <div class="select-flex">
                        <label for="bug_id">Bug (Optional)</label> <!-- not required; could be for a project or not  -->
                        <select name="bug_id">
                            <option value="">Select Bug</option>
                            <option value="HN345">Fix paypal checkout flow...</option>
                            <option value="HN345">Fix paypal checkout flow...</option>
                            <option value="HN345">Fix paypal checkout flow...</option>
                        </select>
                    </div>

                    <div>
                        <label for="task_due">Due Date</label> <!-- required; -->
                        <input type="date" name="task_due" value="<?= date('Y-m-d',strtotime($due_date)) ?>">
                    </div>
                </div>
                    
                <label for="subtask">Subtasks</label> <!-- required; could be name of a person or company  -->
                <div id="subtask-list">
                    <?php   
                        if( is_array($subtask_data) ) { 
                            foreach ($subtask_data as $subtask) { 
                    ?>

                            <div class="subtask">
                                <input type="hidden" name="subtask-id[]" value="<?= $subtask['subtask_id'] ?>">
                                <input type="text" name="subtask[]" value="<?= $subtask['subtask_text'] ?>"><img src="../images/minus-sign.svg" alt="delete">
                            </div>

                    <?php       
                            }
                        } 
                    ?>
                </div>
                <input id="add-subtask-btn" type="submit" value="Add Subtask">

                <div class="divider"></div>
                <fieldset>
                    <legend>Status</legend>
                    <div>
                        <input type="radio" id="status-1" name="task_status" value="To_Do"   <?= ($status == 'To_Do') ? 'checked' : ''; ?>>
                        <label for="status-1">To Do</label>

                        <input type="radio" id="status-2" name="task_status" value="Doing"   <?= ($status == 'Doing') ? 'checked' : ''; ?>>
                        <label for="status-2">Doing</label>

                        <input type="radio" id="status-3" name="task_status" value="Done"    <?= ($status == 'Done') ? 'checked' : ''; ?>>
                        <label for="status-3">Done</label>

                        <input type="radio" id="status-4" name="task_status" value="Backlog" <?= ($status == 'Backlog') ? 'checked' : ''; ?>>
                        <label for="status-4">Backlog</label>
                    </div>
                </fieldset>

                <input type="submit" value="Update Task">
            </form>
        </div>
    </div>
</div>


</div>
<script src="add-task.js"></script>
</body>
</html>