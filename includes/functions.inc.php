<?php

include("dbh.inc.php");

function get_projects() {
    global $conn;

    $sql = 'SELECT * FROM projects';

    if(!$result = mysqli_query($conn, $sql)) {
        header("location: ../projects?error=queryfailed");
        exit();
    }
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);

    return $rows;

}

function get_project($id) {
    global $conn;

    $sql = 'SELECT * FROM projects WHERE project_id = ?';

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../projects/add.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    return mysqli_fetch_assoc($result);

}

function create_task($task_desc, $task_excerpt, $task_status, $task_tag, $task_due) {//$description, $excerpt, $status, $tag, $subtask_list, $due_date

    global $conn;
    
    $sql = "INSERT INTO tasks (task_description, task_excerpt, task_status, task_tag, task_due) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../tasks/add.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $task_desc, $task_excerpt, $task_status, $task_tag, $task_due);
    mysqli_stmt_execute($stmt);
    $last_id = mysqli_stmt_insert_id($stmt);

    return array($conn, $last_id);

}

function get_all_tasks() {

    global $conn;
    $task_data = array();
    
    $sql =  "SELECT * FROM tasks;";
    $sql .= "SELECT * FROM subtasks";
    //needs error handler
    if($result = mysqli_multi_query($conn, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_assoc($result)) {//if you want to have ids be the keys you must use fetch assoc rather than fetch_all and mysqli_assoc as param
                    isset($row['subtask_id'])   ? //
                    $task_data[$row['task_id']]['subtasks'][$row['subtask_id']] = $row : 
                    $task_data[$row['task_id']] = $row;
                    
                }
                mysqli_free_result($result);
            }
            // if there are more result-sets, the print a divider
            //if (mysqli_more_results($conn)) { }
            //Prepare next result set
        } while (mysqli_next_result($conn));
    }
    return $task_data;

    mysqli_close($conn);

}

function get_task($id) {

    global $conn;
    
    $sql =  "SELECT * FROM tasks WHERE task_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../tasks?error=taskstmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return [$result, $conn];
    mysqli_stmt_close($stmt);
}

function get_subtasks($conn, $id) {

    $sql =  "SELECT * FROM subtasks WHERE task_id = ?;";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../tasks?error=taskstmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);

     mysqli_stmt_close($stmt);
}

function task_status_update($task_id, $task_status) {

    global $conn;
    $sql = 'UPDATE tasks SET task_status = ? WHERE task_id = ?';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../tasks?error=taskstmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'si', $task_status, $task_id);
    mysqli_stmt_execute($stmt);

    return $conn;

}

function subtask_status_update($conn, $id, $status) {
        
    global $conn;

    $sql = 'UPDATE subtasks SET done = ? WHERE subtask_id = ?';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../tasks?error=taskstmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ii', $status, $id);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
}

function create_subtask($conn, $task_id, $subtasks, $count) {

    for($i = 0, $values = '', $types = ''; $i < $count; $i++) {
        $values .= ($i === 0) ? '(?, ?)' : ', (?, ?)' ;
        $types .= 'si';
    }

    $subtask_data_arr = make_subtask_array($subtasks, $task_id);

    $sql = "INSERT INTO subtasks (subtask_text, task_id) VALUES " . $values . ";";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../tasks/add.php?error=subtaskstmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, $types, ...$subtask_data_arr);
    mysqli_stmt_execute($stmt);
    

    mysqli_stmt_close($stmt);
}

function make_subtask_array($subtasks, $task_id) {
    $subtask_data = array();

    foreach($subtasks as $subtask) {
        $sanitized_subtask = htmlentities($subtask);
        array_push($subtask_data, $sanitized_subtask);
        array_push($subtask_data, $task_id);
    }
    return $subtask_data;
}

function upload_project_img($img_name) {
    
    if (($img_name != "")){
        // Where the file is going to be stored
            $target_dir = "../images/";
            $file = $_FILES['project_image']['name'];
            $path = pathinfo($file);
    
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['project_image']['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;//this is what will be saved in DB
    
        // Check if file already exists
        if (file_exists($path_filename_ext)) {

            header("location: ../projects?error=imgexists");
            exit();

        } else {

            move_uploaded_file($temp_name,$path_filename_ext);
            return $path_filename_ext;

        }
    }

}