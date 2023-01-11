<?php 
session_start();

?>

            <div id="job_frame">
                <form id="on_job_form" action="processjobsignup.php" method="post">
                    
                <input type="hidden" name="jobID" value="<?php echo $job_to_display->id ?>"/>
                <input type="submit" name="sign_up" value="Sign Up"/>
                </form>   

                <span id="job_title"><?php echo $job_to_display->job_name ?></span> 
                <span class="job_info_header">(<?php echo $job_to_display->category ?>)</span><br/><br/>
                <span class="job_info_header">Where: </span> 
                <span><?php echo $job_to_display->location ?></span><br/>
                <span class="job_info_header">When: </span> 
                <span><?php echo $job_to_display->date ?></span><br/>
                <span class="job_info_header">Skills/Materials Needed: </span>
                <span><?php echo $job_to_display->skills_materials ?></span>

            </div>
            <div id="requestor_frame">
                <span class="regular_text_sml">Who Asked: <span class="regular_text_sml"><?php echo $requesting_user->name ?></span></span>

                <!-- Now we display the user's contact method based on what they preferred be made public -->
                <?php 
                    if($requesting_user->contact_preference == "email"){
                        ?>
                        <p>Email: <span class="regular_text_sml"><?php echo $requesting_user->email ?></span></p>
                    <?php
                    }elseif($requesting_user->contact_preference == "phone"){
                        ?>
                        <p>Phone Number: <span class="regular_text_sml"><?php echo $requesting_user->phone ?></span></p>
                    <?php
                    }elseif($requesting_user->contact_preference == "phone and email"){
                        ?>
                        <p>Email: <span class="regular_text_sml"><?php echo $requesting_user->email ?></span></p>
                        <p>Phone Number: <span class="regular_text_sml"><?php echo $requesting_user->phone ?></span></p>
                    <?php
                    }
                ?>

                <p>Location: <span class="regular_text_sml"><?php echo $requesting_user->city ?>, 
                                <?php echo $requesting_user->state ?> (<?php echo $requesting_user->country ?>)</span></p>
                <p class="regular_text_sml">About Me: <?php echo $requesting_user->bio ?></p>

            </div>


        
