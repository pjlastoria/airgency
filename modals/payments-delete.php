
<div class="delete modal main-comp hide">

    <form action="includes/payments.inc.php" method="post">
        <input type="hidden" name="delete" id="delete" value="false">
        <p>Are you sure you want to delete this payment record?</p>

        <div class="actions">
            <button class="btn" id="delete-from-db">Delete</button>
            <button class="btn" type="button" id="cancel-delete">Cancel</button>
        </div>
    </form>

</div>
