<?php
require 'header.php';
require 'navigation.php';


    if(!isset($_SESSION['user_id'])){
        ?>
        <div class="page_container">
        <h1>Create Account</h1>
        <div id="account_form_container">
            <form action="processaccount.php" method="post">
                <p class="required_hint">* indicates required field</p><br/>

                <!--visible fields-->
                <label>
                    *Name: <input id="name" class="longer" type="text" name="name" placeholder="Your Name"/>
                </label><br/><br/>
                <!--break-->
                <label>
                    *Email: <input type="text" id="email" name="email"/>
                </label><br/><br/>
                <!--break-->            
                <label id="phone_label">*Phone: </label>
                <input type="text" id="phone_number" name="phone"/>
                <br/><br/>
                <!--break-->

                <!--break-->            

                <label>
                    *City: <input type="text" name="city" id="city"/>
                </label><br/><br/>
                <!--break-->
                <label>
                    *State: <input type="text" name="state" id="state"/>
                </label>
                <label>
                    *Country: <input type="text" name="country" id="country"/>
                </label>
                <!--break-->

                <h4 id="checkbox_header">*Preferred Contact Method:</h4>
                <p class="required_hint">The contact method you choose will be displayed in your public profile.</p>
                <input type="checkbox" id="phone" name="contact_preference" value="phone" onchange="phoneRequired()"/>
                <label for="phone">telephone</label><br/>
                <input type="checkbox" id="email2" name="contact_preference" value="email"/>
                <label for="email2">email</label><br/>
                <input type="checkbox" id="both" name="contact_preference" value="phone and email" onchange="phoneRequired()"/>
                <label for="both">both are acceptable</label><br/>
                <!--break-->
                
                <h4 id="comments_header">*Tell us a bit about yourself:</h4>
                <p class="required_hint">The information you share here will be displayed in your public profile.</p>
                <textarea rows="7" cols="80" id="comments" name="comments"></textarea><br/><br/>
                <!--break-->

                <label>
                    *Set Password: <input id="password" class="longer" type="password" name="password"/>
                </label>
                <br/><br/>
                <!--break-->
                <label>
                    *Confirm Password: <input id="confirm_password" class="longer" type="password" name="confirm_password"/>
                </label>
                <br/><br/>
                <!--break-->
                
                <input type="submit" class="btn" name="create" value="Create Account"/>
                <input type="reset" class="btn" value="reset"/>
            </form>
        </div>

</div>
<?php
    }else{
        ?>
        <div class="process_account_container">
            <p class="regular_text">You are already signed in to an account. Please sign out before creating a new account.</p>
            <form action="signout.php" method="get">
                <p class="regular_text_sml">Exit Account?</p>
                <input type="submit" class="regular_text_sml" name="exit_account" value="Yes"/>
            </form>
        </div>
        <?php
    }

?>



<?php 
    require 'footer.php'; 
?>
