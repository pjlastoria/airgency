<?php

include('../includes/functions.inc.php');

if(isset($_POST['delete']) && is_numeric($_POST['delete'])) {
    
    $id = $_POST['delete'];
    $query = "DELETE FROM tasks WHERE task_id = $id"; 
    $result = mysqli_query($conn, $query) or die ( mysqli_error($conn));
    header("Location: ../tasks?result=taskdeleted"); 

}