
    <div class="add modal main-comp add hide">
        <h4 class="modal-title">Create New Payment Record</h4>
        <div class="add-form">
            <form action="includes/payments.inc.php" method="post">
                <input type="hidden" name="new" value="1">

                <div><label for="payment_amount">Amount</label><span class="dollar-sign">$</span></div>
                <input type="text" name="payment_amount" required>

                <label for="client_name">Client</label> <!-- required; could be name of a person or company  -->
                <select name="client_name">
                    <option value="">Select Client</option>
                    <option value="Johnny Silverhand">Johnny Silverhand</option>
                    <option value="Tifa Lockheart">Tifa Lockheart</option>
                    <option value="Aurie Goldfinger">Aurie Goldfinger</option>
                </select>
                
                <label for="payment_desc">Description</label>
                <input type="text" name="payment_desc">

                <fieldset>
                    <legend>Payment Status</legend>
                    <div>
                        <input type="radio" id="status-1" name="payment_status" value="paid">
                        <label for="status-1">Paid</label>

                        <input type="radio" id="status-2" name="payment_status" value="pending" checked>
                        <label for="status-2">Pending</label>
                    </div>
                </fieldset>
                <div class="divider"></div>

                <input type="submit" value="Add Payment">
            </form>
        </div>
    </div>
