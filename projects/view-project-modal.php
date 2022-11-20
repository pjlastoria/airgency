<div class="project-modal-bg modal-bg">
    <div class="view-project modal main-comp">
        <h2 class="project-modal-title"></h2>

        <form id="project-modal-form" action="edit.php" method="get">
            <input id="project-id" type="hidden" name="id" value="">

            <div class="actions">
                <!--<button class="btn">Status Update</button>-->
                <button class="btn" type="submit" id="edit-task-btn">Edit</button>
                <button class="btn" type="button" id="delete-project-btn">Delete</button>
            </div>
        </form>
        
    </div>

    <div class="delete-task modal main-comp">
        <form action="delete.php" method="post">
            <input type="hidden" name="delete" id="delete" value="false">
            <p>Are you sure you want to delete this project?</p>

            <div class="actions">
                <button class="btn">Delete</button>
                <button class="btn" type="button" id="cancel-delete">Cancel</button>
            </div>
        </form>
    </div>
</div>