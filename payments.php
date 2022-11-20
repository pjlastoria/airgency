<?php 
include('modals/payments-add.php'); 
include('modals/payments-edit.php'); 
include('modals/payments-delete.php');
include('includes/payments.inc.php');

$payments = get_all_payments();

function payment_template($payments) {

    foreach($payments as $payment){

        $date_created = date('M j, Y', strtotime($payment['time_created']));
        $status = ucfirst($payment['payment_status']);//css class so the correct color gets rendered
   
        $payment_template = <<<EOT
            <ul class="payment data-wrapper" data-id="{$payment['payment_id']}" data-amount="{$payment['payment_amount']}" data-type="{$payment['incoming']}">
                <li class="payment-id">#{$payment['payment_id']}</li>
                <li class="payment-date">{$date_created}</li>
                <li class="payment-deadline">Deadline</li>
                <li class="payment-client">Johnny B Good</li>
                <li class="payment-amount">&#36;{$payment['payment_amount']}</li>
                <li class="payment-desc">{$payment['payment_memo']}</li>
                <li class="payment-status {$payment['payment_status']}">{$status}</li>
            </ul>
        EOT;

        echo $payment_template;
    }

}

?>

<div class="data-table-header">
    <h3>Payments</h3>
    <button>Filter</button>
</div>
<div id="payments-wrapper">
    <ul class="payment data-col-names">
        <li class="payment-id">ID</li>
        <li class="payment-date">Date</li>
        <li class="payment-deadline">Deadline</li>
        <li class="payment-client">Client</li>
        <li class="payment-amount">Amount</li>
        <li class="payment-desc">Description</li>
        <li class="payment-status">Status</li>
    </ul>

    <?= payment_template($payments); ?>

</div>
