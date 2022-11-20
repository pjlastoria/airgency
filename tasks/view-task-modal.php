<div class="task-modal-bg modal-bg">
    <div class="view-task modal main-comp">

        <p id="task-description"></p>

        <form action="../includes/tasks.inc.php" method="post">
            <input type="hidden" name="status-update" id="task-id" value="">
                
            <fieldset id="subtask-field">
                <legend class="task-legend"></legend>
                <div class="subtask-view no-subtasks-msg">No Subtasks</div>
                
            </fieldset>

            <fieldset>
                <legend class="task-legend">Status</legend>
                <div id="task-status">
                    <input type="radio" id="status-1" name="task_status" value="To_Do">
                    <label for="status-1">To Do</label>

                    <input type="radio" id="status-2" name="task_status" value="Doing">
                    <label for="status-2">Doing</label>

                    <input type="radio" id="status-3" name="task_status" value="Done">
                    <label for="status-3">Done</label>

                    <input type="radio" id="status-4" name="task_status" value="Backlog">
                    <label for="status-4">Backlog</label>
                </div>
            </fieldset>

            <div class="actions">
                <button class="btn">Update</button>
                <button class="btn" id="edit-task-btn" formaction="edit.php" formmethod="GET">Edit</button>
                <button class="btn" type="button" id="delete-task-btn">Delete</button>
            </div>
        </form>

    </div>

    <div class="delete-task modal main-comp">
        <form action="delete.php" method="post">
            <input type="hidden" name="delete" id="delete" value="false">
            <p>Are you sure you want to delete this task and all its subtasks?</p>

            <div class="actions">
                <button class="btn" id="delete-from-db">Delete</button>
                <button class="btn" type="button" id="cancel-delete">Cancel</button>
            </div>
        </form>
    </div>
</div>