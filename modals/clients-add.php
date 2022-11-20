
    <div class="modal main-comp add hide">
        <h4 class="modal-title">Create New Client Account</h4>
        <div class="add-form">
            <form action="includes/clients.inc.php" method="post">
                <input type="hidden" name="new" value="1">

                <label for="client_name">Name</label> <!-- required; could be name of a person or company  -->
                <input type="text" name="client_name" required>

                <label for="client_email">Email</label> <!-- required; -->
                <input type="text" name="client_email" required>

                <fieldset>
                    <legend>Business Type</legend>
                    <div>
                        <input type="radio" id="type-1" name="client_type" value="solo" checked>
                        <label for="type-1">Solo</label>

                        <input type="radio" id="type-2" name="client_type" value="agency">
                        <label for="type-2">Web Agency</label>

                        <input type="radio" id="type-3" name="client_type" value="company">
                        <label for="type-3">Company</label>
                    </div>
                </fieldset>
                <div class="divider"></div>
                <fieldset>
                    <legend>Status</legend>
                    <div>
                        <input type="radio" id="status-1" name="client_status" value="active" checked>
                        <label for="status-1">Active</label>

                        <input type="radio" id="status-2" name="client_status" value="pending">
                        <label for="status-2">Pending</label>

                        <input type="radio" id="status-1" name="client_status" value="inactive">
                        <label for="status-1">Inactive</label>
                    </div>
                </fieldset>
                
                <label for="client_referral">Referred By</label> <!-- NULL, could be a network like upwork, linkedin, or a past client -->
                <input type="text" name="client_referral">

                <input type="submit" value="Add Client">
            </form>
        </div>
    </div>
