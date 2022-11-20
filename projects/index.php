<?php 
include('../dir-header.php');
include('view-project-modal.php');

$projects = get_projects();

$active_projects =   project_filter('active');
$pending_projects =  project_filter('pending');
$complete_projects = project_filter('complete');

function project_filter($val) { 
    global $projects;

    return array_filter($projects, function($project) use($val){// 'use' apparently can be used in lambdas to extend scope to outside vars 
        return $project['project_status'] === $val;             // since by default functions in php don't have outer scope like in JS
    });
    
}

function project_template($data) {

    foreach($data as $row) {

        $excerpt = substr($row['project_excerpt'], 0, 100) . '...';
        
        $project = <<<EOT
            <div class="project-card" id="{$row['project_id']}" data-description="{$row['project_description']}">
                <img src="{$row['project_img_path']}" alt="{{$row['project_title']}}">
                <h4 class="project-title">{$row['project_title']}</h4>
                <ul class="project-info">
                    <li class="project-client">Bob Johnson</li>
                    <li class="project-deadline">October 14th</li>
                    <li class="project-price">$2,500</li>
                    <li class="project-team">
                        <img src="../images/profile_pic.jpg" alt="pJayson">
                        <img src="../images/anon.svg" alt="Johnny">
                        <img src="../images/anon.svg" alt="Devin">
                    </li>
                </ul>
                <p class="project-description">
                    {$excerpt}
                </p>
            </div>
        EOT;

        echo $project;

    }


}

?>

<div id="top-nav">
    <h2 id="main-header">All Projects</h2>
    <a href="add.php"><button class="top-add-btn">Add New Project</button></a>
</div>

<div id="main-area">

    <?php if(count($projects) == 0) { ?>

        <div class="main-comp project-section">
            <p id="no-projects-msg">No Projects Found</p>
            <a href="add.php"><button class="top-add-btn">Click Here to Add</button></a>
        </div>

    <?php } else { 

                if(count($active_projects) > 0) { 
    ?>

                    <div class="main-comp project-section">
                        <h3 class="project-section-header">Active</h3>
                        <div class="project-grid">

                            <?php project_template($active_projects); ?>

                        </div>
                    </div>
    
    <?php 
                } 
                if(count($pending_projects) > 0) { 
    ?>

                    <div class="main-comp project-section">
                        <h3 class="project-section-header">Pending</h3>
                        <div class="project-grid">

                            <?php project_template($pending_projects); ?>

                        </div>
                    </div>

    <?php       
                } 
                if(count($complete_projects) > 0) { 
    ?>

                    <div class="main-comp project-section">
                        <h3 class="project-section-header">Completed</h3>
                        <div class="project-grid">

                            <?php project_template($complete_projects); ?>

                        </div>
                    </div>

    <?php       
                }
            } 
    ?>

</div>


    </div>
    <script src="projects.js"></script>
</body>
</html>