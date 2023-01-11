/*Validation for create account form */
/* */
$(document).ready(function(){
    $("#account_form_container").submit(function(event){

       /*stop submission and show error msg if email is missing or invalid*/ 
       if (!validEmail($("#email").val())){
            event.preventDefault();
            if($("#email").parent().next(".error").length == 0){
                $("#email").parent().after(
                    "<span class='error'>Valid email required. Email must contain @.</span>")
            }                        
        }

        /*stop submission and show error msg if name is missing*/
        if (!$.trim($("#name").val()).length){
            event.preventDefault();
            if($("#name").parent().next(".error").length == 0){
                $("#name").parent().after(
                    "<span class='error'>Name is required</span>")
            }
        }

        /*stop submission and show error msg if city is missing*/
        if (!$.trim($("#city").val()).length){
            event.preventDefault();
            if($("#city").parent().next(".error").length == 0){
                $("#city").parent().after(
                    "<span class='error'>City is required</span>")
            }
        }

        /*stop submission and show error msg if state is missing*/
        if (!$.trim($("#state").val()).length){
            event.preventDefault();
            if($("#state").parent().next(".error").length == 0){
                $("#state").parent().after(
                    "<span class='error'>State is required</span><br/><br/>")
            }
        }

        /*stop submission and show error msg if country is missing*/
        if (!$.trim($("#country").val()).length){
            event.preventDefault();
            if($("#country").parent().next(".error").length == 0){
                $("#country").parent().after(
                    "<span class='error'>Country is required</span>")
            }
        }

        /*stop submission and show error msg if password is missing*/
        if (!$.trim($("#password").val()).length){
            event.preventDefault();
            if($("#password").parent().next(".error").length == 0){
                $("#password").parent().after(
                    "<span class='error'>Password is required</span>")
            }
        }

        /*stop submission and show error msg if confirm_password is missing*/
        if (!$.trim($("#confirm_password").val()).length){
            event.preventDefault();
            if($("#confirm_password").parent().next(".error").length == 0){
                $("#confirm_password").parent().after(
                    "<span class='error'>Password confirmation is required</span>")
            }
        }

        /*stop submission and show error msg if confirm_password does not match password*/
        /*Would like to go in and make this check automatic on the page instead of having to wait for
        submission to see if the passwords match... */
        if ($("#confirm_password").val() != $("#password").val()){
            event.preventDefault();
            if($("#confirm_password").parent().prev(".error").length == 0){
                $("#confirm_password").parent().before(
                    "<span class='error'><b>Passwords do not match</b><br/></span>")
            }
        }

        /*stop submission and show error msg if question is missing*/
        if (!$.trim($("#comments").val()).length){
            event.preventDefault();
            if($("#comments_header").next(".error").length == 0){
                $("#comments_header").after(
                    "<span class='error'>This field is required<br/></span>");
            }
        }  

        /*stop submission and show error msg if no contact method was checked*/
        if (!$("#email2").prop('checked') && !$("#phone").prop('checked') && !$("#both").prop('checked')) {
            event.preventDefault();
            if($("#checkbox_header").next(".error").length == 0){
                $("#checkbox_header").after(
                    "<span class='error'>Contact method is required<br/></span>");
            }
        }

        /*check if need phone# - if so, stop submission and show error msg if phone# missing or invalid*/
        if(phoneRequired()) {
            if (!validPhone ($("#phone_number").val())){
                event.preventDefault();
                if($("#phone_number").next(".error").length == 0){
                    $("#phone_number").after(
                        "<span class='error'>&nbspValid phone number is required.</span>")
                }
            } 
        }           
    });
});

/*Check if phone or email&phone option was selected, if so, mark phone field as required
              returns true if required, false if not*/
              function phoneRequired(){
                const phone = document.getElementById("phone");
                const both = document.getElementById("both");

                if(phone.checked || both.checked){
                    document.getElementById("phone_label").innerHTML = "*Phone:";
                    return true;
                }
                else {
                    document.getElementById("phone_label").innerHTML = "Phone:";
                    return false;
                }
            }

            /*check if email is valid
              returns true or false*/
            function validEmail(email){
                const regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                if(regex.test(email)){
                    return true;
                }
                return false;
            }

            /*check if phone# is valid
              returns true or false*/
            function validPhone(number){
                const regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
                if(regex.test(number)){
                    return true;
                }
                return false;
            }