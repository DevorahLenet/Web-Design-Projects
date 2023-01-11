<?php
require 'header.php';
require 'navigation.php';
?>

        <article class="page_container">
            <h2 class="form_header">Contact Us:</h2>

            <form action="contact_us.php" method="get">
                    <p class="select_intro">What would you like to speak with us about?</p>
                    <select name="choices" id="choices">
                        <option value="help">Get Help</option>
                        <option value="feedback">Leave Feedback</option>
                    </select>

                   <input type="submit" class="btn" id="choose_btn" name="choose" value="Choose"/>
            </form>
            <?php
                
                if(isset($_GET['choose'])){
                    $choice = $_GET['choices'];
                    if($choice == "help"){
                        //end of php block
                        ?>
                        <div id="help">
                            <form action="contact_us.php" method="post">
                                <h2 class="form_header">How can we help you?</h2>
                                <p class="required_hint">* indicates required field</p><br/>
                    
                                <!--hidden fields-->
                                <input type="hidden" name="ToAddress" value="dvsachs2@gmail.com"/>
                                <input type="hidden" name="CCAddress" value=""/>
                                <input type="hidden" name="Subject" value="Help Request from GiveGet"/>
                    
                                <!--visible fields-->
                                <label>
                                    *Name: <input id="name_help" class="longer" type="text" name="name" placeholder="Your Name"/>
                                </label>
                                <!--break-->
                                <label>
                                    *Email: <input type="text" id="email_help" name="FromAddress"/>
                                </label><br/><br/>
                                <!--break-->
                                <label id="phone_label">Phone: </label>
                                <input type="text" id="phone_number" name="phone"/>
                                <br/><br/>
                                <!--break-->
                                
                    
                                <label>
                                    Street Address: <input class="longer" type="text" name="street"/>
                                </label>
                                <label>
                                    City: <input type="text" name="city"/>
                                </label><br/><br/>
                                <!--break-->
                                <label>
                                    State: <input type="text" name="state"/>
                                </label>
                                <label>
                                    Country: <input type="text" name="country"/>
                                </label>
                                <label>
                                    Postal Code: <input type="text" name="zipcode"/>
                                </label><br/><br/>
                                <!--break-->
                    
                                <h4 id="checkbox_header">*Preferred Contact Method:</h4>
                                <input type="checkbox" id="phone" name="contactMethod" value="phone" onchange="phoneRequired()"/>
                                <label for="phone">telephone</label><br/>
                                <input type="checkbox" id="email" name="contactMethod" value="email"/>
                                <label for="four">email</label><br/>
                                <input type="checkbox" id="both" name="contactMethod" value="phone and email" onchange="phoneRequired()"/>
                                <label for="three">both are acceptable</label><br/>
                                <!--break-->
                                
                                <h4 id="comments_help_header">*Please explain your question:</h4>
                                <textarea rows="7" cols="80" id="comments_help" name="comments" placeholder="Your question here"></textarea><br/><br/>
                                <!--break-->
                                
                                <input type="submit" class="btn" name="get_help" value="Get Help"/>
                                <input type="reset" class="btn" value="reset"/>
                            </form>
                        </div>                       
                        
                    <? //starting php again
                    }else if($choice = "feedback"){
                        //ending php ?>
                        <div id="feedback">
                            <form action="contact_us.php" method="post">
                            <h2 class="form_header">We Appreciate Your Feedback!</h2>
                            <p class="required_hint">* indicates required field</p><br/>
                    
                                <!--hidden fields-->
                                <input type="hidden" name="ToAddress" value="dvsachs2@gmail.com"/>
                                <input type="hidden" name="CCAddress" value=""/>
                                <input type="hidden" name="Subject" value="Feedback from GiveGet"/>
                    
                                <!--visible fields-->
                                <label>
                                    *Name: <input class="longer" id="name_feedback" type="text" name="name" placeholder="Your Name"/>
                                </label><br/><br/>
                                <!--break-->
                                <label>
                                    *Email: <input type="text" id="email_feedback" name="FromAddress"/>
                                </label><br/><br/>
                                <!--break-->
                    
                                <label>
                                Street Address: <input class="longer" type="text" name="street"/>
                                </label>
                                <label>
                                    City: <input type="text" name="city"/>
                                </label><br/><br/>
                                <!--break-->
                                <label>
                                    State: <input type="text" name="state"/>
                                </label>
                                <label>
                                    Country: <input type="text" name="country"/>
                                </label>
                                <label>
                                    Postal Code: <input type="text" name="zipcode"/>
                                </label><br/><br/>
                                <!--break-->
                    
                                <h4>Please rate your experience on our website...</h4>
                                <input type="radio" id="five" name="rating" value="5"/>
                                <label for="five">5 - Fantastic! I'm certainly coming back</label><br/>
                                <input type="radio" id="four" name="rating" value="4"/>
                                <label for="four">4 - Good, very helpful</label><br/>
                                <input type="radio" id="three" name="rating" value="3"/>
                                <label for="three">3 - Fine</label><br/>
                                <input type="radio" id="two" name="rating" value="2"/>
                                <label for="two">2 - Ok, not great</label><br/>
                                <input type="radio" id="one" name="rating" value="1"/>
                                <label for="one">1 - Seriously needs improvement</label><br/><br/>
                                <!--break-->
                                
                                <h4 id="comments_feedback_header">...*and tell us why:</h4>
                                <textarea rows="7" cols="80" id="comments_feedback" name="comments" placeholder="Your comments here"></textarea><br/><br/>
                                <!--break-->
                                
                                <input type="submit" class="btn" name="feeditback" value="Send Feedback"/>
                                <input type="reset" class="btn" value="reset"/>
                            </form>
                        </div> 
            <?//PHP starts again
                    }
                }

                if(isset($_POST['get_help'])){
                    //end of php here?>
                    <div>
                    <?php

                        $name = test_input($_POST['name']);
                        $email = test_input($_POST['FromAddress']);
                        $phone = test_input($_POST['phone']);
                        $comments = test_input($_POST['comments']);
                        $contact_method = $_POST['contactMethod'];                        


                        if(validate_user_info($name, $email, $comments, true, $phone, $contact_method)){//no errors for user to fix. on to form creator's errors.
                            validate_hidden_info_and_send();//makes sure form presets and url are right and then sends email
                        }

                    ?>
                    </div>
                <?php
                }elseif(isset($_POST['feeditback'])){
                    ?>
                    <div>
                    <?php

                        $name = test_input($_POST['name']);
                        $email = test_input($_POST['FromAddress']);
                        $comments = test_input($_POST['comments']);

                        if(validate_user_info($name, $email, $comments, false, null, null)){
                            validate_hidden_info_and_send();
                        }

                    ?>
                    </div>
                    <?php
                }
            ?>
            <div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>
        </article>

        <?php //functions for validating and sending form information

            //validates information that user put in the form
            function validate_user_info($name, $email, $comments, $is_help_form, $phone, $contact_method){

                $msg = "<br/><h3>Error - your form still requires the following field(s):</h3>";

                if (!isset($name) || $name == "" || !preg_match("/^[a-zA-Z-' ]*$/",$name)){
                    $msg .= "<i>-valid name (should contain only letters and spaces)</i><br/>";
                }

                if (!isset($email) || $email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $msg .= "<i>-valid email (should contain @)</i><br/>";
                }

                if (!isset($comments) || $comments == ""){//?maybe do the same regex match as did with name
                    $msg .= "<i>-help question</i><br/>";
                }

                if ($is_help_form){

                    if (!isset($contact_method)){
                        $msg .= "<i>-preferred contact method (and phone number if applicable)</i><br/>";
                    }

                    if ($contact_method == "phone" || $contact_method == "phone and email"){
                        if(!isset($phone) || $phone == "" || !preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im",$phone)){
                            $msg .= "<i>-valid phone number</i><br/>";
                        }
                    }
                }


                if ($msg === "<br/><h3>Error - your form still requires the following field(s):</h3>"){
                    return true;
                } else {
                    $msg .= "<br/> You can use the back button to continue filling out your form.";
                    echo $msg;
                    return false;
                }
            }

            //validates hidden inputs preset in the form and the form URL, and then sends the message 
            function validate_hidden_info_and_send(){
                if ( !isset($_POST['ToAddress']) ) {

                    ?>

                    <br/><h1>Error</h1>

                    <p>Your form does not specify what address to send the email to.  Refer to the instructions on using this form-to-email processor in your course assignment.  Form element names must match the ones specified in the instructions, and are case sensitive.</p>

                    <?php

                    }

                    elseif ( !isset($_POST['CCAddress']) ) {

                    ?>

                    <br/><h1>Error!</h1>

                    <p>Your form does not specify what CC address to send the email to.  Refer to the instructions on using this form-to-email processor in your course assignment.  Form element names must match the ones specified in the instructions, and are case sensitive.</p>

                    <?php

                    }

                    elseif ( !isset($_POST['Subject']) ) {

                    ?>

                    <br/><h1>Error!</h1>

                    <p>Your form does not specify a subject for the email.  Refer to the instructions on using this form-to-email processor in your course assignment.  Form element names must match the ones specified in the instructions, and are case sensitive.</p>

                    <?php

                    }

                    else {

                        // Stop the form being used from an external URL
                        // Get the referring URL
                        $referer = strtolower($_SERVER['HTTP_REFERER']);
                        // Get the URL of this page
                        $this_url = "https://cdlwebsysdev.esc-atsystems.net/";
                        // If the referring URL and the URL of this page don't match then
                        // display a message and don't send the email.
                        
                        if ($this_url != substr( $referer, 0,39) ) {
                            echo "<h1>Error!</h1><p>You do not have permission to use this script from another URL.</p>";
                            echo $this_url ;
                            echo substr( $referer, 0,38);
                            exit;
                        }

                        $to = stripslashes($_POST['ToAddress']);
                        $from = stripslashes($_POST['FromAddress']);
                        $cc = stripslashes($_POST['CCAddress']);
                        $cc = stripslashes($_POST['CCAddress']);
                        $subject = stripslashes($_POST['Subject']);
                        $message = "";
                        foreach ($_POST as $key => $val) {
                            if ( is_array($val) ) {
                                $message .= "$key:\n" . join (", ", $val) . "\n\n";
                            }
                            else {
                                $message .= "$key:\n $val\n\n";
                            }
                        }
                        if ($cc == "") {
                            $addresses = "From: $from";
                        }
                        else {
                            $addresses = "From: $from \r\nCC: $cc";
                        }
                        if ( mail($to, $subject, $message, $addresses) ) {

                            // Display the thankyou message
                        echo "<div class='process_account_container'><h3>Thank you for reaching out! Your message has been sent.</h3></div>";
                        } else {
                            // Display the error message
                        echo "<br/><h1>Error!</h1><p>We're sorry but your message could not be sent.</p>";
                        }

                    }
            }

            //sanitizes inputs to prepare for final validation
            function test_input($entry) {
                $entry = trim($entry);
                $entry = stripslashes($entry);
                $entry = htmlspecialchars($entry);
                return $entry;
            }

            require 'footer.php';
        ?>


