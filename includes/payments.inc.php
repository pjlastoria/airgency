<?php

include('functions.inc.php');

function get_all_payments() {

    global $conn;
    
    $sql = "SELECT * FROM payments
            ORDER BY time_created desc;";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);
    return $rows;

}

function create_payment($amount, $status, $memo, $client_name, $incoming) {

    global $conn;
    
    $sql = "INSERT INTO payments (payment_amount, payment_status, payment_memo, client_name, incoming) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "dsssi", $amount, $status, $memo, $client_name, $incoming);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../?result=paymentadded");
    exit();

}

function update_payment_report($id, $amount, $memo, $status, $paid_by, $incoming) {

    global $conn;

    $sql = "UPDATE payments SET payment_amount = ?, payment_memo = ?, payment_status = ?, client_name = ?, incoming = ? WHERE payment_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "dsssii", $amount, $memo, $status, $paid_by, $incoming, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../?result=paymentreportupdated");
    exit();

}

function delete_payment_record($id) {
    global $conn;

    $sql = "DELETE FROM payments WHERE payment_id = ?"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("location: ../?result=paymentreportdeleted");
    exit();

}

if(isset($_POST['new']) && $_POST['new'] == 1) { //

    $amount = floatval($_POST['payment_amount']);
    $status = $_POST['payment_status'];
    $memo = htmlentities($_POST['payment_desc']);

    //DEFAULTS 
    $client_name = htmlentities($_POST['client_name']) ?: NULL ;
    $incoming = true;

    create_payment($amount, $status, $memo, $client_name, $incoming);

}

if(isset($_POST['edit']) && is_numeric($_POST['edit'])) { //

    echo '<pre>';
        var_dump($_POST);
    echo '</pre>';

    $id = $_POST['edit'];
    $amount = floatval($_POST['payment_amount']);
    $memo = htmlentities($_POST['payment_desc']);
    $status = $_POST['payment_status'];

    //DEFAULTS 
    $paid_by = $_POST['client_name'] ?: NULL ;
    $incoming = true;

    update_payment_report($id, $amount, $memo, $status, $paid_by, $incoming);

}


if(isset($_POST['delete']) && is_numeric($_POST['delete'])) { //

    $id = $_POST['delete'];

    delete_payment_record($id);

}