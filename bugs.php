<?php 
include('header.php');
include('modals/bugs-add.php');
include('modals/bugs-edit.php');
include('modals/bugs-delete.php');
include('includes/bugs.inc.php');

$bug_reports = get_all_bug_reports();

function bug_report_template($report_data) {

    foreach($report_data as $report){

        $bug_report = html_entity_decode($report['bug_details']);//keep out of data attr because of quotes
        $report_excerpt = strlen($bug_report ) > 30 ? substr($bug_report, 0, 30) . '...' : $bug_report ;
        $date_created = date('M j, Y', strtotime($report['time_created']));
        $category = ucwords($report['bug_category']);
   
        $bug_template = <<<EOT
            <ul class="bug data-wrapper" data-id="{$report['bug_id']}" data-description="{$report['bug_details']}">
                <li class="bug-id">#{$report['bug_id']}</li>
                <li class="bug-details">{$report_excerpt}</li>
                <li class="bug-date">{$date_created}</li>
                <li class="bug-urgency">{$report['bug_urgency']}</li>
                <li class="bug-reporter">{$report['bug_reporter']}</li>
                <li class="bug-project">Airgency</li>
                <li class="bug-category">{$category}</li>
                <li class="bug-status fixed">{$report['bug_status']}</li>
            </ul>
        EOT;

        echo $bug_template;
    }

}

?>

<div class="modal-bg hide"></div>
<div id="top-nav">
    <h2 id="main-header">Bugs</h2>
    <button class="top-add-btn">Report New Bug</button>
</div>

<div id="main-area">
    <div class="flex">
        <div class="bug-stat main-comp open-bugs active">
            <p class="bug-stat-amount">22</p>
            <p class="bug-stat-status">Open</p>
        </div>
        <div class="bug-stat main-comp closed-bugs">
            <p class="bug-stat-amount">8</p>
            <p class="bug-stat-status">Closed</p>
        </div>
        <div class="bug-stat main-comp overdue-bugs">
            <p class="bug-stat-amount">5</p>
            <p class="bug-stat-status">Overdue</p>
        </div>
        <div class="bug-stat main-comp due-soon-bugs">
            <p class="bug-stat-amount">16</p>
            <p class="bug-stat-status">Due Soon</p>
        </div>
        <div class="bug-stat main-comp due-later-bugs">
            <p class="bug-stat-amount">7</p>
            <p class="bug-stat-status">Due Later</p>
        </div>
    </div>

    <div class="margin-gap full">
        <div class="main-comp">
            <div class="data-table-header">
                <h3>All Bugs</h3>
                <button>Filter</button>
            </div>
            <div id="bugs-wrapper">
                <ul class="bug data-col-names">
                    <li class="bug-id">ID</li>
                    <li class="bug-details">Details</li>
                    <li class="bug-date">Created</li>
                    <li class="bug-urgency">Urgency</li>
                    <li class="bug-reporter">Reported By</li>
                    <li class="bug-project">Project</li>
                    <li class="bug-category">Category</li>
                    <li class="bug-status">Status</li>
                </ul>
                
                <?= bug_report_template($bug_reports); ?>

            </div>
        </div>
    </div>
</div>

<script src="js/bugs.js"></script>
<script src="modals/modal.js"></script>
<?php 
include('footer.php');
?>