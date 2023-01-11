<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GiveGet Create Account</title>

    <link rel="stylesheet" href="site.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="effects.js"></script>
    <script src="validation.js"></script>
</head>

<body>
<?php
    require 'header.php';
    require 'navigation.php';
    require 'validation.php';
    require 'userclass.php';
    require 'save_xml.php';

    if(isset($_POST['create'])){
        $name = test_input($_POST['name']);
        $email = test_input($_POST['email']);
        $phone = test_input($_POST['phone']);
        $city = test_input($_POST['city']);
        $state = test_input($_POST['state']);
        $country = test_input($_POST['country']);
        $contact_preference = test_input($_POST['contact_preference']);
        $bio = test_input($_POST['comments']);
        $password = test_input($_POST['password']);
        $confirm_password = test_input($_POST['confirm_password']);
        
        if(validate_user_info($name, $email, $phone, $city, $state, $country, $contact_preference,
        $bio, $password, $confirm_password)){
            //create a new Job object with a unique ID (need to change code to make counter truly unique)
            $counter = rand();
            $user_to_save = new User($counter);
        
            //add the values inputted as properties of the Job object
            $user_to_save->addData('NAME', $name);
            $user_to_save->addData('EMAIL', $email);
            $user_to_save->addData('PHONE', $phone);
            $user_to_save->addData('CITY', $city);
            $user_to_save->addData('STATE', $state);
            $user_to_save->addData('COUNTRY', $country);
            $user_to_save->addData('CONTACT_PREFERENCE', $contact_preference);
            $user_to_save->addData('BIO', $bio);
            $user_to_save->addData('PASSWORD', $password);

            $user_array = array($user_to_save);
    
            save_xml($user_array, "users.xml", "append");

            ?>
            <div class="process_account_container">

                <h2>Success! Your account has been created.</h2>
                <div class="profile_button" onclick="document.getElementById('id01').style.display='block'" style="margin: auto;">Sign In</div>
            </div>
            <!--This is for the popup modal sign-in box-->
            <?php 
                require 'signinup.php'; 

        }    
            
    }

    require 'footer.php'; 
?>
    
</body>
</html>