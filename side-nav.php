<?php 
include('includes/dbh.inc.php');

$currPage = basename($_SERVER['PHP_SELF'], '.php');

$sql = "SELECT
         (SELECT COUNT(client_id)  FROM clients  WHERE client_status  = 'active') as active_clients, 
         (SELECT COUNT(project_id) FROM projects WHERE project_status = 'active') as active_projects,
         (SELECT COUNT(task_id)    FROM tasks    WHERE task_status    = 'Doing')  as active_tasks,
         (SELECT COUNT(bug_id)     FROM bugs     WHERE bug_status     = 'open')   as active_bugs;" ;

$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

?>

<div id="side-nav">
    <div id="logo-container">
        <img src="images/airgency-logo.png" alt="airgency">
    </div>

    <div id="side-menu">
        <ul id="side-menu-tabs">
            <a href="/airgency">
                <li class="side-tab<?= ($currPage == 'index') ? ' active-tab' : '' ?>">
                    <img src="images/graph-icon.svg" alt="dashboard">Dashboard
                </li>
            </a>

            <a href="clients.php">
                <li class="side-tab<?= ($currPage == 'clients') ? ' active-tab' : '' ?>">
                    <img src="images/user-icon.svg" alt="dashboard">Clients

                    <?php if(!empty($row['active_clients'])) { ?>
                        <span class="tab-num"><?= $row['active_clients'] ?></span>
                    <?php } ?>

                </li>
            </a>

            <a href="projects/index.php">
                <li class="side-tab">
                    <img src="images/code-icon.svg" alt="dashboard">Projects

                    <?php if(!empty($row['active_projects'])) { ?>
                        <span class="tab-num"><?= $row['active_projects'] ?></span>
                    <?php } ?>
                    
                </li>
            </a>

            <a href="tasks/index.php">
                <li class="side-tab">
                    <img src="images/boards-icon.svg" alt="dashboard">Tasks

                    <?php if(!empty($row['active_tasks'])) { ?>
                        <span class="tab-num"><?= $row['active_tasks'] ?></span>
                    <?php } ?>

                </li>
            </a>

            <a href="bugs.php">
                <li class="side-tab<?= ($currPage == 'bugs') ? ' active-tab' : '' ?>">
                    <img src="images/bug-icon.svg" alt="dashboard">Bugs

                    <?php if(!empty($row['active_bugs'])) { ?>
                        <span class="tab-num"><?= $row['active_bugs'] ?></span>
                    <?php } ?>
                    
                </li>
            </a>

            <div class="divider"></div>

            <a href="#"><li class="side-tab"><img src="images/bloomer.gif" id="profile-pic" alt="dashboard">Bloomer Jones</li></a>
            <a href="#"><li class="side-tab"><img src="images/logout-icon.svg" alt="dashboard">Logout</li></a>
        </ul>
    </div>
</div>