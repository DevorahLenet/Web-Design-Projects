<?php

//functions to validate createaccount form
function validate_user_info($name, $email, $phone, $city, $state, $country, $contact_preference,
            $bio, $password, $confirm_password){

    $msg = "<br/><h3>Error - your form is missing the following field(s):</h3>";

    if (!letters_and_spaces($name)){
        $msg .= "<i>-valid name (should contain only letters and spaces)</i><br/>";
    }

    if (!is_valid_email($email)){
        $msg .= "<i>-valid email (should contain @)</i><br/>";
    }

    if (!isset($bio) || $bio == ""){
        $msg .= "<i>-bio paragraph</i><br/>";
    }

    if (!isset($contact_preference) || $contact_preference == ""){
        $msg .= "<i>-preferred contact method</i><br/>";
    }

    if(!isset($phone) || $phone == "" || !preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im",$phone)){
        $msg .= "<i>-valid phone number</i><br/>";
    }

    if(!letters_and_spaces($city)){
        $msg .= "<i>-valid city name</i><br/>";
    }

    if(!letters_and_spaces($state)){
        $msg .= "<i>-valid state name</i><br/>";
    }

    if(!letters_and_spaces($country)){
        $msg .= "<i>-valid country name</i><br/>";
    }

    if(!password_length($password)){
        $msg .= "<i>-password of 8 characters or more</i><br/>";
    }

    if(!isset($confirm_password) || $confirm_password == "" || $password == "" || !isset($password) || $confirm_password != $password){
        $msg .= "<i>-matching password and confirm password</i><br/>";
    }

    if ($msg === "<br/><h3>Error - your form is missing the following field(s):</h3>"){
        return true;
    }else {
        $msg .= "<br/> Please try again.";
        echo $msg;
        return false;
    }
}

//I want a function to check if account with that email already exists

//functions to validate sign-in
function validate_signin_email($in){
    $out = test_input($in);
    if (is_valid_email($out)){
        return $out;
    }
    $out = "";
    return $out;
}

function validate_signin_pwd($in){
    $out = test_input($in);
    if (password_length($out)){
        return $out;
    }
    $out = "";
    return $out;
}

//functions to validate create request
function validate_request_inputs($job_name, $category, $location, $date, $skills_materials){
    $msg = "<br/><h4>Error: </h4>";
    $skills_blank = "none";
    if(!isset($job_name) || $job_name == ""){
        $msg .= "job name is required.";
    }

    if(!isset($category) || $category == ""){
        $msg .= " job category is required.";
    }

    if(!isset($location) || $location == ""){
        $msg .= "location is required.";
    }

    if(!isset($date) || $date == ""){
        $msg .= "date is required.";
    }

    if(!isset($skills_materials) || $skills_materials == ""){
        $skills_materials = $skills_blank;
    }

    if($msg == "<br/><h4>Error: </h4>"){
        echo '<script>document.getElementById("request_form_success").innerHTML = "Job request successfully submitted."</script>';
        return true;
    }else{
        
        echo '<script>document.getElementById("request_form_error").innerHTML = "Error: job request submissions must contain job name, category, location and date."</script>';
       
        return false;
    }
}

//supplementary functions

function password_length($input){
    if (!isset($input) || strlen($input) < 8){
        return false;
    }
    return true;
}

function letters_and_spaces($name){
    if (!isset($name) || $name == "" || !preg_match("/^[a-zA-Z-' ]*$/",$name)){
        return false;
    }
    return true;
}

function is_valid_email($email) {
    if (!isset($email) || $email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true;
}

function test_input($entry) {
    $entry = trim($entry);
    $entry = stripslashes($entry);
    $entry = htmlspecialchars($entry);
    return $entry;
}

?>