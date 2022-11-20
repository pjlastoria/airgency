<?php 
include('header.php');
include('modals/clients-add.php');
include('modals/clients-edit.php');
include('modals/clients-delete.php');
include('includes/clients.inc.php');

$clients = get_all_clients();

function client_template($clients) {

    foreach($clients as $client){

        $date_created = date('M j, Y', strtotime($client['time_created']));
   
        $client_template = <<<EOT
            <ul class="client data-wrapper" data-id="{$client['client_id']}">
                <li class="client-name">{$client['client_name']}</li>
                <li class="client-email">{$client['client_email']}</li>
                <li class="client-date">{$date_created}</li>
                <li class="client-total">&#36;0</li>
                <li class="client-referral">{$client['client_referral']}</li>
                <li class="client-type">{$client['client_type']}</li>
                <li class="client-status {$client['client_status']}">{$client['client_status']}</li>
            </ul>
        EOT;

        echo $client_template;
    }

}

?>

<div class="modal-bg hide"></div>
<div id="top-nav">
    <h2 id="top-header">Clients</h2>
    <button class="top-add-btn">Add Client</button>
</div>
<div id="main-area">
    <div id="client-stat-wrapper" class="flex">
        <div class="client-stat main-comp">
            <ul class="client-stat-inner">
                <li class="client-stat-title">New this Week</li>
                <li class="client-stat-amount new-clients">4</li>
                <li class="client-stat-imgs">
                    <img src="images/profile_pic.jpg" alt="pJayson">
                    <img src="images/anon.svg" alt="Johnny">
                    <img src="images/anon.svg" alt="Devin">
                    <img src="images/anon.svg" alt="George">
                </li>
            </ul>
        </div>
        <div class="client-stat main-comp">
            <ul class="client-stat-inner">
                <li class="client-stat-title">Repeat</li>
                <li class="client-stat-amount">5</li>
                <li class="client-stat-diff">+20%</li>
            </ul>
        </div>
        <div class="client-stat main-comp">
            <ul class="client-stat-inner">
                <li class="client-stat-title">Subscribed</li>
                <li class="client-stat-amount">32</li>
                <li class="client-stat-diff">+20%</li>
            </ul>
        </div>
        <div class="client-stat main-comp">
            <ul class="client-stat-inner">
                <li class="client-stat-title">Total</li>
                <li class="client-stat-amount">42</li>
                <li class="client-stat-diff">+20%</li>
            </ul>
        </div>
    </div>

    <div class="margin-gap full">
        <div class="main-comp">
            <div class="data-table-header">
                <h3>All Clients</h3>
                <button>Filter</button>
            </div>
            <div id="clients-wrapper">
                <ul class="client data-col-names">
                    <li class="client-name">Name</li>
                    <li class="client-email">Email</li>
                    <li class="client-date">Signed Up</li>
                    <li class="client-total">Total Spent</li>
                    <li class="client-referral">Referred By</li>
                    <li class="client-type">Type</li>
                    <li class="client-status">Status</li>
                </ul>
                
                <?= client_template($clients); ?>

            </div>
        </div>
    </div>

</div>

<script src="js/clients.js"></script>
<script src="modals/modal.js"></script>
<?php 
include('footer.php');
?>