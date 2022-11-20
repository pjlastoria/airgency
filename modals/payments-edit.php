    <div class="modal main-comp edit hide">
        <h4 class="modal-title">Edit Payment Record</h4>
        <div class="add-form">
            <form action="includes/payments.inc.php" method="post">
                <input type="hidden" name="edit" id="payment-id" value="">

                <div><label for="payment_amount">Amount</label><span class="dollar-sign">$</span></div>
                <input type="text" id="payment-amount" name="payment_amount" required>

                <label for="client_name">Client</label> <!-- required; could be name of a person or company  -->
                <select name="client_name">
                    <option value="">Select Client</option>
                    <option value="Johnny Silverhand">Johnny Silverhand</option>
                    <option value="Tifa Lockheart">Tifa Lockheart</option>
                    <option value="Aurie Goldfinger">Aurie Goldfinger</option>
                </select>
                
                <label for="payment_desc">Description</label> <!-- NULL, could be a network like upwork, linkedin, or a past client -->
                <input type="text" id="payment-desc" name="payment_desc">

                <fieldset>
                    <legend>Payment Status</legend>
                    <div id="payment-status">
                        <input type="radio" id="status-1" name="payment_status" value="paid">
                        <label for="status-1">Paid</label>

                        <input type="radio" id="status-2" name="payment_status" value="pending" checked>
                        <label for="status-2">Pending</label>
                    </div>
                </fieldset>
                <div class="divider"></div>

                <div class="actions">
                    <button class="btn">Update</button>
                    <button class="btn" type="button" id="delete-btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
