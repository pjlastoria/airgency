<?php

include('functions.inc.php');

function get_all_bug_reports() {

    global $conn;
    
    $sql = "Select * from bugs ORDER BY time_created desc;";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);
    return $rows;

}

function create_bug_report($description, $status, $category, $reporter, $urgency) {

    global $conn;
    
    $sql = "INSERT INTO bugs (bug_details, bug_status, bug_category, bug_reporter, bug_urgency) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../bugs?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $description, $status, $category, $reporter, $urgency);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../bugs?result=bugreportadded");
    exit();

}

function update_bug_report($id, $description, $status, $category, $reporter, $urgency) {

    global $conn;

    $sql = "UPDATE bugs SET bug_details = ?, bug_status = ?, bug_category = ?, bug_reporter = ?, bug_urgency = ? WHERE bug_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../bugs?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssi", $description, $status, $category, $reporter, $urgency, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../bugs?result=bugreportupdated");
    exit();

}

function delete_bug_report($id) {
    global $conn;

    $sql = "DELETE FROM bugs WHERE bug_id = ?"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../bugs?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../bugs?result=bugreportdeleted");
    exit();

}

if(isset($_POST['new']) && $_POST['new'] == 1) { //

    $description = htmlentities($_POST['bug_desc']);
    $status = $_POST['bug_status'];
    $category = $_POST['bug_category'];
    $reporter = $_POST['bug_reporter'];

    //DEFAULTS 
    $urgency = $_POST['bug_urgency'] ?: 'Not Urgent' ;

    create_bug_report($description, $status, $category, $reporter, $urgency);

}

if(isset($_POST['edit']) && is_numeric($_POST['edit'])) { //

    $id = $_POST['edit'];
    $description = htmlentities($_POST['bug_desc']);
    $status = $_POST['bug_status'];
    $category = $_POST['bug_category'];
    $reporter = $_POST['bug_reporter'];

    //DEFAULTS 
    $urgency = $_POST['bug_urgency'] ?: 'Not Urgent' ;

    update_bug_report($id, $description, $status, $category, $reporter, $urgency);


}

if(isset($_POST['delete']) && is_numeric($_POST['delete'])) { //

    $id = $_POST['delete'];

    delete_bug_report($id);

}