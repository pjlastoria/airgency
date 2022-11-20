<?php

include('functions.inc.php');

function create_project($name, $status, $desc, $excerpt, $category, $img_path) {
    global $conn;

    $sql = 'INSERT INTO projects (project_title, project_status, project_description, project_excerpt, project_category, project_img_path)
            VALUES (?, ?, ?, ?, ?, ?)';

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../projects/add.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $status, $desc, $excerpt, $category, $img_path);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($conn);
    header("location: ../projects?result=projectadded");
    exit();

}

function update_project($id, $name, $status, $desc, $excerpt, $category, $img_path) {

    global $conn;
    $sql = 'UPDATE projects SET project_title = ?, project_status = ?, project_description = ?, project_excerpt = ?, project_category = ?, project_img_path = ?
            WHERE project_id = ?';

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../projects?error=projectstmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ssssssi', $name, $status, $desc, $excerpt, $category, $img_path, $id);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($conn);
    header("location: ../projects?result=projectupdated");
    exit();

}

if(isset($_POST['new']) && $_POST['new'] == 1) { //

    $name = htmlentities($_POST['project_name']);
    $img_file_name = upload_project_img($_FILES['project_image']['name']);
    
    $status = $_POST['project_status'];
    $desc = htmlentities($_POST['project_desc']);
    $excerpt = (strlen($_POST['project_desc']) > 150) ? substr($_POST['project_desc'], 0, 150) : $_POST['project_desc'] ; //first 50 chars of description
    $clean_excerpt = htmlentities($excerpt);

    //DEFAULTS
    $img_path = $img_file_name ?: '../images/project-img-placeholder.jpg';
    $category = $_POST['project_category'] ?: 'General';

    create_project($name, $status, $desc, $clean_excerpt, $category, $img_path);

}

if(isset($_POST['edit']) && is_numeric($_POST['edit'])) { //

    $id = intval($_POST['edit']);
    $name = htmlentities($_POST['project_name']);
    $img_file_name = upload_project_img($_FILES['project_image']['name']);

    $status = $_POST['project_status'];
    $desc = htmlentities($_POST['project_desc']);
    $excerpt = (strlen($_POST['project_desc']) > 150) ? substr($_POST['project_desc'], 0, 150) : $_POST['project_desc'] ; //first 50 chars of description
    $clean_excerpt = htmlentities($excerpt);

    //DEFAULTS
    $img_path = $img_file_name ?: $_POST['default_image'];//NEEDS WORK
    $category = $_POST['project_category'] ?: 'General';

    update_project($id, $name, $status, $desc, $clean_excerpt, $category, $img_path);

}