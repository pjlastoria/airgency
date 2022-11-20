<?php

include('functions.inc.php');

//Rather than saving subtask list as a json col in the tasks table i decided to try saving them as their own table 
//as a child to the tasks table then select all on view

if(isset($_POST['new']) && $_POST['new'] == 1) { //

    $task_desc = htmlentities($_POST['task_desc']);
    $task_excerpt = substr($task_desc, 0, 50); //first 50 chars of description
    $task_status = $_POST['task_status'];

    //DEFAULTS 
    $task_due = $_POST['task_due'] ?: NULL ;
    $task_tag = $_POST['task_tag'] ?: 'General' ;

    $arr = create_task($task_desc, $task_excerpt, $task_status, $task_tag, $task_due);
    $conn = $arr[0]; $task_id = $arr[1];

    if(isset($_POST['subtask'])) {//$_POST['subtask'] is an array because each input on the html form is subtask[]

        $subtask_count = count($_POST['subtask']);
        create_subtask($conn, $task_id, $_POST['subtask'], $subtask_count);

    }

    header("location: ../tasks?result=taskadded");
    exit();

}

if(isset($_POST['status-update']) && !empty($_POST['status-update'])) { //

    $task_id = $_POST['status-update'];
    $task_status = $_POST['task_status'];

    $conn = task_status_update($task_id, $task_status);

    //var_dump($_POST);
    if(isset($_POST['subtask'])) {//$_POST['checkbox'] is an array because each input has [] in the name attr

        $subtasks = $_POST['subtask'];
        $completed_subtasks = $_POST['checked_subtasks'] ?: ['empty'];
        
        foreach($subtasks as $ind => $subtask) {
            $completed = 0;
            if(in_array($subtask, $completed_subtasks)) {
                $completed = 1;
            }
            
            subtask_status_update($conn, $subtask, $completed);
        }

    }

    mysqli_stmt_close($stmt);


    header("location: ../tasks?result=taskupdated");
    exit();

}

if(isset($_POST['edit']) && is_numeric($_POST['edit'])) { //

    echo '<pre>';
        var_dump($_POST);
    echo '</pre>';

    function task_update($task_id, $task_desc, $excerpt, $task_status, $due_date) {

        global $conn;
        $sql = 'UPDATE tasks SET task_description = ?, task_excerpt = ?, task_status = ?, task_due = ? WHERE task_id = ?';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../tasks?error=taskstmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, 'ssssi', $task_desc, $excerpt, $task_status, $due_date, $task_id);
        mysqli_stmt_execute($stmt);
    
        return $conn;
    
    }
    
    function subtask_update($conn, $id, $task_text) {
    
        $sql = 'UPDATE subtasks SET subtask_text = ? WHERE subtask_id = ?';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../tasks?error=taskstmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, 'si', $task_text, $id);
        mysqli_stmt_execute($stmt);
        
    }

    function create_subtask_from_edit($conn, $parent_id, $subtask_text) {

        $sql = "INSERT INTO subtasks (subtask_text, task_id) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../tasks?error=taskstmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, 'si', $subtask_text, $parent_id);
        mysqli_stmt_execute($stmt);

    }

    $task_id = $_POST['edit'];
    $task = $_POST['task_desc'];
    $excerpt = substr($task, 0, 50);
    $task_status = $_POST['task_status'];
    $due_date = $_POST['task_due'];

    $conn = task_update($task_id, $task, $excerpt, $task_status, $due_date);

    if(isset($_POST['subtask'])) {//$_POST['subtask'] and $_POST['subtask'] are array because each input has [] in the name attr
        $subtasks = $_POST['subtask'];//all subtasks, could be new or old

        if(isset($_POST['subtask-id'])) {//if there are old subtasks to update

            $subtask_ids = $_POST['subtask-id'];//id array of old subtasks that will update even if not changed, maybe later write program on the client that checks if unqiue
            
            foreach($subtask_ids as $ind => $id) {
                subtask_update($conn, $id, $subtasks[$ind]);
                unset($subtasks[$ind]);
            }

        }

        //later i may create one subtask update function that can be used for updating subtasks both from add.php and edit.php
        //the dilemma is between looping through the subtask array and firing a sql stmt for each one 
        //or looping through to add params and then executing one sql stmt for all subtasks
        //at least i have practice doing both

        foreach($subtasks as $subtask) {
            create_subtask_from_edit($conn, $task_id, $subtask);
        }

    }

    mysqli_close($conn);


    header("location: ../tasks?result=taskupdated");
    exit();

}