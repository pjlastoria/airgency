<?php

include('functions.inc.php');

function get_all_clients() {

    global $conn;
    
    $sql = "Select * from clients ORDER BY time_created desc;";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);
    return $rows;

}

function create_client($name, $email, $status, $type, $referral) {

    global $conn;
    
    $sql = "INSERT INTO clients (client_name, client_email, client_status, client_type, client_referral) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../clients?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $status, $type, $referral);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../clients?result=clientadded");
    exit();

}

function update_client_account($id, $name, $email, $status, $type, $referral) {

    global $conn;

    $sql = "UPDATE clients SET client_name = ?, client_email = ?, client_status = ?, client_type = ?, client_referral = ? WHERE client_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../clients?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $status, $type, $referral, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../clients?result=clientaccountupdated");
    exit();

}

function delete_client_account($id) {
    global $conn;

    $sql = "DELETE FROM clients WHERE client_id = ?"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../clients?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../clients?result=clientaccountdeleted");
    exit();

}

if(isset($_POST['new']) && $_POST['new'] == 1) { //

    $name = htmlentities($_POST['client_name']);
    $email = htmlentities($_POST['client_email']);
    $status = $_POST['client_status'];

    //DEFAULTS 
    $referral = htmlentities($_POST['client_referral']) ?: NULL ;
    $type = $_POST['client_type'] ?: NULL ;

    create_client($name, $email, $status, $type, $referral);

}

if(isset($_POST['edit']) && is_numeric($_POST['edit'])) { //

    echo '<pre>';
        var_dump($_POST);
    echo '</pre>';

    $id = $_POST['edit'];
    $name   = htmlentities($_POST['client_name']);
    $email  = htmlentities($_POST['client_email']);
    $status =              $_POST['client_status'];

    //DEFAULTS 
    $type =     $_POST['client_type']     ?: 'Solo';
    $referral = $_POST['client_referral'] ?: NULL;

    update_client_account($id, $name, $email, $status, $type, $referral);

}


if(isset($_POST['delete']) && is_numeric($_POST['delete'])) { //

    $id = $_POST['delete'];
    echo $id;

    delete_client_account($id);

}