            /* Javascript for SUNY-ESC Web Sys Dev M3 Web form validation assignment (called contact.html) */
            
            
            /*Makes sure select is set to option "select" whenever page loads again (fixes problem of chosen
            option not showing up because it was selected immediately before and hasn't "changed")*/
            window.onload = function(){
                document.getElementById("choices").selectedIndex = 0;
            }
            
            /*decides which form to show based on the select's property "selectedIndex" -
              get help has index 1, leave feedback has index 2 */
            function displayProperForm(){
                const menu = document.getElementById("choices");
                let chosen = menu.selectedIndex;
                if(chosen == 1){
                    document.getElementById("feedback").style.display = "none";
                    document.getElementById("help").style.display = "block";
                }
                else if(chosen == 2){
                    document.getElementById("help").style.display = "none";
                    document.getElementById("feedback").style.display = "block";
                }

            }

            /* Form Validation Requirements:

            for feedback form:
            -name must be filled in
            -email must be filled in and valid
            -comment must be filled in 
            
            for help form:
            -name must be filled
            -email must be filled and valid
            -(if applicable) phone must be filled and valid
            -prefered contact method must be filled (determines whether phone is required)
            -comment must be filled
             */

            /*When user submits *help* form, check to see if all necessary fields are filled in and valid,
              stop submission and alerts user if not */
            $(document).ready(function(){
                $("#help").submit(function(event){

                   /*stop submission and show error msg if email is missing or invalid*/ 
                   if (!validEmail($("#email_help").val())){
                        event.preventDefault();
                        if($("#email_help").parent().next(".error").length == 0){
                            $("#email_help").parent().after(
                                "<span class='error'>Valid email required. Email must contain @.</span>")
                        }                        
                    }

                    /*stop submission and show error msg if name is missing*/
                    if (!$.trim($("#name_help").val()).length){
                        event.preventDefault();
                        if($("#name_help").parent().next(".error").length == 0){
                            $("#name_help").parent().after(
                                "<span class='error'>Name is required</span>")
                        }
                    }

                    /*stop submission and show error msg if question is missing*/
                    if (!$.trim($("#comments_help").val()).length){
                        event.preventDefault();
                        if($("#comments_help_header").next(".error").length == 0){
                            $("#comments_help_header").after(
                                "<span class='error'>This field is required<br/></span>");
                        }
                    }  

                    /*stop submission and show error msg if no contact method was checked*/
                    if (!$("#email").prop('checked') && !$("#phone").prop('checked') && !$("#both").prop('checked')) {
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


             /*When user submits *feedback* form, check to see if all necessary fields are filled in and valid,
              stop submission and alerts user if not */
            $(document).ready(function(){
                $("#feedback").submit(function(event){

                   /*stop submission and show error msg if email is missing or invalid*/ 
                   if (!validEmail($("#email_feedback").val())){
                        event.preventDefault();

                        if($("#email_feedback").parent().next(".error").length == 0){
                            $("#email_feedback").parent().after(
                                "<span class='error'>Valid email required. Email must contain @.</span>")
                        }
                    }

                    /*stop submission and show error msg if name is missing*/
                    if (!$.trim($("#name_feedback").val()).length){
                        event.preventDefault();

                        if ($("#name_feedback").parent().next(".error").length == 0){
                                $("#name_feedback").parent().after(
                                    "<span class='error'>Name is required</span>");
                            }
                    }

                    /*stop submission and show error msg if question is missing*/
                    if (!$.trim($("#comments_feedback").val()).length){
                        event.preventDefault();
                        
                        if ($("#comments_feedback_header").next(".error").length == 0){
                            $("#comments_feedback_header").after(
                                "<span class='error'>This field is required<br/></span>");
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