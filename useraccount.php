<?php
    require 'header.php';
    require 'navigation.php';
    require 'validation.php';
    require 'load_users.php';

    if(isset($_SESSION["user_id"])){
        $email = $_SESSION["user_email"];
        $password = $_SESSION["user_pwd"];


        $found_account = 0;

        foreach ($users_for_display as $current_user){
            //if the email and password match $current_user's email and pwd, 
            if ($email == $current_user->email && $password == $current_user->password){
                $signed_in_user = $current_user;
                $found_account = 1;

                ?>
                
                <div id="account_container">
                    <div id="side_nav"> <!--side navigation bar, allows user to choose between profile and jobs list-->    
                        <div id="btn_profile" class="profile_button" onclick="displayProfile()">Profile</div>
                        <div id="btn_jobs" class="profile_button" onclick="displayJobsList()">My Jobs</div>
                        <div id="btn_request" class="profile_button" onclick="displayRequestPage()">Create Request</div>
                        <div id="btn_logout" class="profile_button" onclick="displaySignOut()">Sign Out</div>
                        <p id="request_form_error" class="error"></p>
                        <p id="request_form_success" class="regular_text_sml"></p>
                    </div>

                    <!-- this is profile_container. it displays the user's profile info. -->
                    <div id="profile_container">
                    <?php
                        require 'user_display.php';
                    ?>
                    </div>
                    

                    <div id="jobs_container"> <!--displays user's jobs list and job history list-->
                        <h1 class="profile_title">My Jobs</h1>
                    </div>

                    <div id="request_page">
                        <h1 class="profile_title">Create Request</h1><br/>
                        
                        <form action="useraccount.php" method="post">
                            <label for="name_of_job">Job Name: <input type="text" id="name_of_job" name="job_name"/></label><br/><br/>
                            <!-- <label for="job_category">Category:<input type="text" id="job_category" name="category"/></label><br/> -->
                            <label for="job_category">Job Category: <select name="category">
                                                            <option value="all">All</option>
                                                            <option value="errands">Errands</option>
                                                            <option value="rides">Rides</option>
                                                            <option value="childcare">Childcare</option>
                                                            <option value="household help">Household Help</option>
                                                            <option value="tutoring">Tutoring</option>
                                                            <option value="visit">Visiting</option>
                                                            <option value="carrying">Heavy Loads</option>
                                                            <option value="event help">Event Prep</option>
                                                            <option value="elder-care">Elder Care</option>
                                                            <option value="food">Food Prep</option>
                                                        </select></label><br/><br/>
                            <label for="job_location">Location: <input type="text" id="job_location" name="location"/></label><br/><br/>
                            <label for="job_date">Date: <input type="text" id="job_date" name="date"/></label><br/><br/>
                            <!--need to split into mdy or otherwise make formattable-->
                            <label for="skills_materials">Skills and/or Materials Needed: <input type="text" id="job_skills_materials" name="skills_materials"/></label><br/><br/>
                            <input type="hidden" name="volunteer_id" value="0"/>
                            <input type="hidden" name="finished" value="0"/>
                            <input type="submit" name="create_request" value="submit"/>
                        </form>
                    </div>

                    <div id="sign_out_page"> <!--displays sign out page-->
                        <h1 class="profile_title">Sign Out</h1>
                        <form action="signout.php" method="get">
                            <p class="regular_text_sml">Exit Account?</p>
                            <input type="submit" class="regular_text_sml" name="exit_account" value="Yes"/>
                        </form>

                    </div>

                </div>
                <?php
                    require 'jobclass.php';
                    require 'save_xml.php';

                    if(isset($_POST['create_request'])){

                        //get the values inputted into the form
                        $job_name = test_input($_POST['job_name']);
                        $category = test_input($_POST['category']);
                        $location = test_input($_POST['location']);
                        $date = test_input($_POST['date']);
                        $skills_materials = test_input($_POST['skills_materials']);
                        $volunteer_id = test_input($_POST['volunteer_id']);
                        $finished = test_input($_POST['finished']); 

                        if(validate_request_inputs($job_name, $category, $location, $date, $skills_materials)){
                            $counter = rand();
                            $job_to_save = new Job($counter);
                        
                            //add the values inputted as properties of the Job object
                            $job_to_save->addData('JOB_NAME', $job_name);
                            $job_to_save->addData('CATEGORY', $category);
                            $job_to_save->addData('LOCATION', $location);
                            $job_to_save->addData('DATE', $date);
                            $job_to_save->addData('SKILLS_MATERIALS', $skills_materials);
                            $job_to_save->addData('VOLUNTEER_ID', $volunteer_id);
                            $job_to_save->addData('FINISHED', $finished);
                            $job_to_save->addData('REQUESTOR_ID', $_SESSION["user_id"]);

                            $job_array = array($job_to_save);

                            save_xml($job_array, "jobs.xml", "append");
                            echo("job saved");
                        }

                        //create a new Job object with a unique ID (need to change code to make counter truly unique)
                    }

            }
            
        }
        
        if ($found_account == 0){
                ?>
                <div class="process_account_container">
                    <br/><br/>
                    <p class="regular_text_sml">An account associated with the email and/or password you entered could not be found</p>
                    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Try Again</button>
                    <?php 
                        require 'signinup.php'; 
                    ?>
                </div>
             
            <?php
        }

    }else{//session is not set
        if(isset($_POST['login'])){    
            $email = validate_signin_email($_POST['email']);
            $password = validate_signin_pwd($_POST['password']);
                        
            $found_account = 0;
    
            foreach ($users_for_display as $current_user){
                //if the email and password match $current_user's email and pwd, 
                if ($email == $current_user->email && $password == $current_user->password){
                    $signed_in_user = $current_user;
                    $found_account = 1;
                    
                    //set the session variables so the site knows the user is signed in and which user it is
                    $_SESSION["signed_in"] = true;
                    $_SESSION["user_id"] = $signed_in_user->id; 
                    $_SESSION["user_email"] = $signed_in_user->email;
                    $_SESSION["user_pwd"] = $signed_in_user->password;
                    ?>
                    
                    <div id="account_container">
                        <div id="side_nav"> <!--side navigation bar, allows user to choose between profile and jobs list-->    
                            <div id="btn_profile" class="profile_button" onclick="displayProfile()">Profile</div>
                            <div id="btn_jobs" class="profile_button" onclick="displayJobsList()">My Jobs</div>
                            <div id="btn_request" class="profile_button" onclick="displayRequestPage()">Create Request</div>
                            <div id="btn_logout" class="profile_button" onclick="displaySignOut()">Sign Out</div>
                        </div>
    
                        <!-- this is profile_container. it displays the user's profile info. -->
                        <div id="profile_container">
                        <?php
                            require 'user_display.php';
                        ?>
                        </div>
                        
    
                        <div id="jobs_container"> <!--displays user's jobs list and job history list-->
                            <h1 class="profile_title">My Jobs</h1>
                        </div>
    
                        <div id="request_page">
                        <h1 class="profile_title">Create Request</h1><br/>
                        <form action="useraccount.php" method="post">
                            <label for="name_of_job">Job Name: <input type="text" id="name_of_job" name="job_name"/></label><br/><br/>
                            <!-- <label for="job_category">Category:<input type="text" id="job_category" name="category"/></label><br/> -->
                            <label for="job_category">Job Category: <select name="category">
                                                            <option value="all">All</option>
                                                            <option value="errands">Errands</option>
                                                            <option value="rides">Rides</option>
                                                            <option value="childcare">Childcare</option>
                                                            <option value="household help">Household Help</option>
                                                            <option value="tutoring">Tutoring</option>
                                                            <option value="visit">Visiting</option>
                                                            <option value="carrying">Heavy Loads</option>
                                                            <option value="event help">Event Prep</option>
                                                            <option value="elder-care">Elder Care</option>
                                                            <option value="food">Food Prep</option>
                                                        </select></label><br/><br/>
                            <label for="job_location">Location: <input type="text" id="job_location" name="location"/></label><br/><br/>
                            <label for="job_date">Date: <input type="text" id="job_date" name="date"/></label><br/><br/>
                            <!--need to split into mdy or otherwise make formattable-->
                            <label for="skills_materials">Skills and/or Materials Needed: <input type="text" id="job_skills_materials" name="skills_materials"/></label><br/><br/>
                            <input type="hidden" name="volunteer_id" value="0"/>
                            <input type="hidden" name="finished" value="0"/>
                            <input type="submit" name="create_request" value="submit"/>
                        </form>
                    </div>
    
                        <div id="sign_out_page"> <!--displays sign out page-->
                            <h1 class="profile_title">Sign Out</h1>
                            <form action="signout.php" method="get">
                                <p class="regular_text_sml">Exit Account?</p>
                                <input type="submit" class="regular_text_sml" name="exit_account" value="Yes"/>
                            </form>
    
                        </div>
    
                    </div>
                    <?php
                        require 'jobclass.php';
                        require 'save_xml.php';
    
                        if(isset($_POST['create_request'])){

                            //get the values inputted into the form
                            $job_name = test_input($_POST['job_name']);
                            $category = test_input($_POST['category']);
                            $location = test_input($_POST['location']);
                            $date = test_input($_POST['date']);
                            $skills_materials = test_input($_POST['skills_materials']);
                            $volunteer_id = test_input($_POST['volunteer_id']);
                            $finished = test_input($_POST['finished']); 
    
                            if(validate_request_inputs($job_name, $category, $location, $date, $skills_materials)){
                                $counter = rand();
                                $job_to_save = new Job($counter);
                            
                                //add the values inputted as properties of the Job object
                                $job_to_save->addData('JOB_NAME', $job_name);
                                $job_to_save->addData('CATEGORY', $category);
                                $job_to_save->addData('LOCATION', $location);
                                $job_to_save->addData('DATE', $date);
                                $job_to_save->addData('SKILLS_MATERIALS', $skills_materials);
                                $job_to_save->addData('VOLUNTEER_ID', $volunteer_id);
                                $job_to_save->addData('FINISHED', $finished);
                                $job_to_save->addData('REQUESTOR_ID', $_SESSION["user_id"]);
    
                                $job_array = array($job_to_save);
    
                                save_xml($job_array, "jobs.xml", "append");
                                echo("job saved");
                            }
    
                            //create a new Job object with a unique ID (need to change code to make counter truly unique)
                        }
    
                }
                
            }
            
            if ($found_account == 0){
                    ?>
                    <div class="process_account_container">
                        <br/><br/>
                        <p class="regular_text_sml">An account associated with the email and/or password you entered could not be found</p>
                        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Try Again</button>
                        <?php 
                            require 'signinup.php'; 
                        ?>
                    </div>
                 
                <?php
            }
    
            
    
        }
    
    }
    
?>

<?php 
    require 'footer.php'; 
?>