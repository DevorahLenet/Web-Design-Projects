<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GiveGet</title>

<link rel="stylesheet" href="site.css">

</head>
<body>
    <?php
    require 'validation.php';

    if(isset($_POST['sign_up'])){
        $jobID = test_input($_POST['jobID']);
        ?>
        <div id="id02" class="modal" style="display:block;">
        <?php
        if(isset($_SESSION["user_id"])){
            require 'load_jobs.php';
            require 'save_xml.php';
        ?>
            
                
                <form class="modal-content animate" action="useraccount.php" method="post">

                    <div class="container">
                    <h2 class="modal_title">You've signed up for this job:</h2>

                    <div>
                        <?php
                        foreach ($jobs_for_display as $job_to_display)
                            {
                                if($jobID == $job_to_display->id){                                    
                                    ?>
                                    <div>
                                        <span class="regular_text"><?php echo $job_to_display->job_name ?></span> 
                                        <span class="job_info_header">(<?php echo $job_to_display->category ?>)</span><br/><br/>
                                        <span class="job_info_header">Where: </span> 
                                        <span><?php echo $job_to_display->location ?></span><br/>
                                        <span class="job_info_header">When: </span> 
                                        <span><?php echo $job_to_display->date ?></span><br/>
                                        <span class="job_info_header">Skills/Materials Needed: </span>
                                        <span><?php echo $job_to_display->skills_materials ?></span>

                                    </div>
                                    <?php
                                    $job_to_display->addData("VOLUNTEER_ID", $_SESSION["user_id"]);
                                    }
                            }
                            
                        save_xml($jobs_for_display, "jobs.xml", "overwrite");

                        ?>
                    </div>  

                    <h1 class="modal_title">Thank You!</h1>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                    <a href="jobs.php"><button type="button" class="modal_btn">OK</button></a>
                    
                    </div>
                </form>
        <?php
        }else{
            ?>
                <!-- this is similar to the regular sign in form. The action (and validation) are the same. -->
            
                <form id="signin_2" class="modal-content animate" action="useraccount.php" method="post">
                    
                    <div class="container">
                    <h3 class="modal_title"><i>You must be logged in to sign up for a job.</i></h3>
                        <h1 class="modal_title">Sign In</h1>
                    <label for="email"><b>Email</b></label><br/>
                    <input type="text" class="modal_input" placeholder="Enter Email Address" name="email"><br/>

                    <label for="password"><b>Password</b></label><br/>
                    <input type="password" class="modal_input" placeholder="Enter Password" name="password">
                        
                    <button class="modal_btn" type="submit" name="login">Login</button>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                    <a href="jobs.php"><button type="button" class="modal_btn">Cancel</button></a>                    
                    </div>

                </form>
        <?php
        }  
        ?> 
        </div> 
        <?php   
        }
        ?>
</body>
</html>
