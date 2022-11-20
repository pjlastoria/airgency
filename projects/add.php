<?php 
include('../dir-header.php');


?>

<div id="top-nav">
    <h2 id="main-header">Add New Project</h2>
    <a href="./"><button class="top-add-btn">Go Back</button></a>
</div>

<div id="main-area">
    <div class="main-comp main-form">
        <!--<h3 class="project-section-header">Create </h3>-->

        <div class="add-form non-modal">
            <form action="../includes/projects.inc.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="new" value="1">

                <div class="input-flex">
                    <div>
                        <label for="project_name">Title</label> <!-- required; could be name of a person or company  -->
                        <input type="text" name="project_name" required>
                    </div>
                    <div class="select-flex">
                        <label for="client_name">Client</label> <!-- required; could be name of a person or company  -->
                        <select name="client_name">
                            <option value="">Select Client</option>
                            <option value="Johnny Silverhand">Johnny Silverhand</option>
                            <option value="Tifa Lockheart">Tifa Lockheart</option>
                            <option value="Aurie Goldfinger">Aurie Goldfinger</option>
                        </select>
                    </div>
                </div>

                <label for="project_image">Project Image</label>
                <input type="file" name="project_image">

                <div class="input-flex">
                    <div>
                        <label for="start_date">Start Date</label> <!-- required; -->
                        <input type="date" name="start_date">
                    </div>
                    <div>
                        <label for="deadline">Deadline</label> <!-- required; -->
                        <input type="date" name="deadline">
                    </div>
                </div>

                <div class="input-flex">
                    <div>
                        <div><label for="amount_paid">Amount Paid</label><span class="amount-paid dollar-sign">$</span></div> <!-- required; -->
                        <input type="text" name="amount_paid">
                    </div>
                    <div>
                        <div><label for="amount_total">Amount Total</label><span class="amount-total dollar-sign">$</span></div> <!-- required; -->
                        <input type="text" name="amount_total">
                    </div>
                </div>

                <div class="divider"></div>
                <fieldset>
                    <legend>Status</legend>
                    <div>
                        <input type="radio" id="status-1" name="project_status" value="active" checked>
                        <label for="status-1">Active</label>

                        <input type="radio" id="status-2" name="project_status" value="pending">
                        <label for="status-2">Pending</label>

                        <input type="radio" id="status-1" name="project_status" value="complete">
                        <label for="status-1">Complete</label>
                    </div>
                </fieldset>
                
                <label for="project_desc">Description</label>
                <textarea id="project_desc" name="project_desc" rows="5" cols="33" required></textarea>

                <input type="submit" value="Add Project">
            </form>
        </div>
    </div>
</div>


    </div>
</body>
</html>