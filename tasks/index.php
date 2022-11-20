<?php 
include('../dir-header.php');
include('../modals/tasks-quick-add.php');
include('view-task-modal.php');

$tasks = get_all_tasks();

$to_dos =   task_filter('To_Do');
$doings =   task_filter('Doing');
$dones =    task_filter('Done');
$backlogs = task_filter('Backlog');

function task_filter($val) { 
    global $tasks;

    return array_filter($tasks, function($task) use($val){// 'use' apparently can be used in lambdas to extend scope to outside vars 
        return $task['task_status'] === $val;             // since by default functions in php don't have outer scope like in JS
    });
    
}

function task_template($task_data) {

    foreach( $task_data as $data) {

        $task = htmlspecialchars($data['task_description'], ENT_QUOTES);
        $excerpt = (strlen($data['task_excerpt']) > 50) ? $data['task_excerpt'] . '...' : $data['task_excerpt'];
        $subtask_count = isset($data['subtasks']) ? get_subtask_text($data['subtasks']) : 'No Subtasks' ;
        $subtask_json = isset($data['subtasks']) ? htmlentities(stripslashes(json_encode($data['subtasks']))) : $subtask_count ;

        $task = <<<EOT
                <div class="main-comp task-wrapper" data-id="{$data['task_id']}" data-task="{$task}" data-tag="{$data['task_tag']}" data-due="{$data['task_due']}" 
                                                    data-created="{$data['time_created']}" data-updated="{$data['last_updated']}" data-subtaskjson="{$subtask_json}">
                    <p class="task">{$excerpt}</p>
                    <p class="sub-task">{$subtask_count}</p>
                    <img class="task-worker" src="../images/anon.svg" alt="client">
                </div>
            EOT;

        echo $task;
    }


}

function get_subtask_text($subtasks) {
    if(count($subtasks) === 1) {
        return '1 Subtask';
    }
    return count($subtasks) . ' Subtasks';
}

?>

<div id="top-nav">
    <h2 id="main-header">All Tasks</h2>
    <div>
        <button id="quick-add-btn" class="top-add-btn">Quick Add</button>
        <a href="add"><button class="top-add-btn">Add New Task</button></a>
    </div>
</div>

<div id="main-area">
    <div class="flex task">
        <div class="col-4" data-status="To_Do">
            <div class="task-col-header"><div class="circle light-blue"></div>To Do (<?= count($to_dos) ?>)</div>

            <?php task_template($to_dos); ?>

        </div>
        <div class="col-4" data-status="Doing">
            <div class="task-col-header"><div class="circle light-purple"></div>Doing (<?= count($doings) ?>)</div>

            <?php task_template($doings);  ?>

        </div>
        <div class="col-4" data-status="Done">
            <div class="task-col-header"><div class="circle green"></div>Done (<?= count($dones) ?>)</div>

            <?php task_template($dones);  ?>

        </div>
        <div class="col-4" data-status="Backlog">
            <div class="task-col-header"><div class="circle light-blue"></div>Backlog (<?= count($backlogs) ?>)</div>

            <?php task_template($backlogs);  ?>

        </div>
    </div>
</div>


    <script src="view-task.js"></script>
</body>
</html>