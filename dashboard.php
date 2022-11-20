<div class="modal-bg hide"></div>
<div id="top-nav">
    <h2 id="main-header">Dashboard</h2>
    <button class="top-add-btn">Add Payment</button>
</div>
<div id="main-area">
    <div class="flex">
        <div class="fixed-width">
            <div class="full-height">
                <div class="main-stats">
                    <div class="stat active" id="revenue" title="Revenue">
                        <ul class="stat-inner">
                            <li class="stat-title"><img src="images/code-icon.svg" alt="dashboard">Revenue</li>
                            <li class="stat-amount">No Data</li>
                            <li class="stat-diff">No Data</li>
                        </ul>
                    </div>
                    <div class="stat" id="total-orders" title="Total Orders">
                        <ul class="stat-inner">
                            <li class="stat-title"><img src="images/boards-icon.svg" alt="dashboard">Total Orders</li>
                            <li class="stat-amount">No Data</li>
                            <li class="stat-diff">No Data</li>
                        </ul>
                    </div>
                    <div class="stat" id="order-average" title="Order Average">
                        <ul class="stat-inner">
                            <li class="stat-title"><img src="images/graph-icon.svg" alt="dashboard">Average per Order</li>
                            <li class="stat-amount">No Data</li>
                            <li class="stat-diff">No Data</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="full">
            <div class="main-comp">
                <?php include('line-graph.php'); ?>
            </div>
        </div>
    </div>
    <div class="margin-gap full">
        <div class="main-comp">
            <?php include('payments.php'); ?>
        </div>
    </div>
</div>

<script src="js/payments.js"></script>
<script src="modals/modal.js"></script>
<script src="js/line-graph.js"></script>