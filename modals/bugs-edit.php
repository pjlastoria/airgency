<div class="modal main-comp edit hide">
        <h4 class="modal-title">Edit Bug Report</h4>
        <div class="add-form">
            <form action="includes/bugs.inc.php" method="post">
                <input type="hidden" name="edit" id="bug-id" value="">

                <label for="bug_desc">Description</label>
                <textarea id="bug-desc" name="bug_desc" rows="5" cols="33" required></textarea>

                <label for="project_name">Project</label> <!-- required; could be name of a person or company  -->
                <select name="project_name">
                    <option value="">Select Project</option>
                    <option value="Handpick Harvest">Handpick Harvest</option>
                    <option value="Bionic Parts eStore">Bionic Parts eStore</option>
                    <option value="7th Heaven Bar">7th Heaven Bar</option>
                </select>

                <fieldset>
                    <legend>Category</legend><!-- bug type undefined (UN), functionality (FN), user interface (UI), Performance (PF), Security (SC) -->
                    <div id="bug-category">
                        <input type="radio" id="type-1" name="bug_category" value="functionality">
                        <label for="type-1">Functionality</label>

                        <input type="radio" id="type-2" name="bug_category" value="user interface">
                        <label for="type-2">User Interface</label>

                        <input type="radio" id="type-3" name="bug_category" value="performance">
                        <label for="type-3">Performance</label>

                        <input type="radio" id="type-4" name="bug_category" value="security">
                        <label for="type-3">Security</label>
                    </div>
                </fieldset>
                <div class="divider"></div>
                <fieldset>
                    <legend>Status</legend>
                    <div id="bug-status">
                        <input type="radio" id="status-1" name="bug_status" value="open">
                        <label for="status-1">Open</label>

                        <input type="radio" id="status-1" name="bug_status" value="closed">
                        <label for="status-1">Closed</label>

                        <input type="radio" id="status-2" name="bug_status" value="pending">
                        <label for="status-2">Pending</label>
                    </div>
                </fieldset>
                
                <label for="bug_reporter">Reported By</label> <!-- NULL, could be a network like upwork, linkedin, or a past client -->
                <select name="bug_reporter">
                    <option value="Admin">Admin</option>
                    <option value="Client">Client</option>
                </select>

                <div class="actions">
                    <button class="btn">Update</button>
                    <button class="btn" type="button" id="delete-btn">Delete</button>
                </div>
            </form>
        </div>
</div>
