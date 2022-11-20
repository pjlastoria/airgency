<div class="modal-bg">
    <div class="modal main-comp">
        <h4 class="modal-title">Create New Task</h4>
        <div class="add-form">
            <form action="../includes/tasks.inc.php" method="post">
                <input type="hidden" name="new" value="1" />
                <label for="task_desc">Description</label>
                <textarea id="task_desc" name="task_desc" rows="4" cols="33"></textarea>

                <div class="divider"></div>
                <fieldset>
                    <legend>Status</legend>
                    <div>
                        <input type="radio" id="status-1" name="task_status" value="To_Do" checked>
                        <label for="status-1">To Do</label>

                        <input type="radio" id="status-2" name="task_status" value="Doing">
                        <label for="status-2">Doing</label>

                        <input type="radio" id="status-3" name="task_status" value="Done">
                        <label for="status-3">Done</label>

                        <input type="radio" id="status-4" name="task_status" value="Backlog">
                        <label for="status-4">Backlog</label>
                    </div>
                </fieldset>

                <input type="submit" value="Add Task">
            </form>
        </div>
    </div>
</div>